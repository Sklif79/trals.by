<?php

class TralsPriceUpdate
{

    protected $IBlockID;
    protected $FilePatch;
    protected $PropKey = [];
    protected $arAdd = [];
    protected $arUpdate = [];

    public function __construct($FilePatch, $IBlockID, array $PropKey)
    {
        if (is_numeric($IBlockID) and file_exists($FilePatch)) {
            $this->IBlockID = $IBlockID;
            $this->FilePatch = $FilePatch;
            $this->PropKey = $PropKey;
        } else {
            throw new Exception('Невозможно создать объект!');
        }
    }

    public function Start()
    {

        $this->FarsettOff();
        $this->AllActiveN();
        $this->isUpdateAdd();
        $this->ELAdd();
        $this->ELUpdate();
		$this->setActiveNWithoutBlock();
        BXClearCache(true, "/catalog/");
        $this->FarsettOn();
    }

    public function FarsettOff()
    {
        if (CModule::IncludeModule('iblock')) {
            Bitrix\Iblock\PropertyIndex\Manager::DeleteIndex($this->IBlockID);
            Bitrix\Iblock\PropertyIndex\Manager::markAsInvalid($this->IBlockID);
        }
    }


    public function FarsettOn()
    {
        if (CModule::IncludeModule('iblock')) {
            $index = \Bitrix\Iblock\PropertyIndex\Manager::createIndexer($this->IBlockID);
            $index->startIndex();
            $index->continueIndex(0); // создание без ограничения по времени
            $index->endIndex();
        }
    }


    public function GetData()
    {
        return self::CsvToArray($this->FilePatch);
    }


    public function GetAllIBlock()
    {
        $arElement = [];
        if (CModule::IncludeModule("iblock")) {
            $arSelect = Array("ID", "XML_ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_11");
            $arFilter = Array("IBLOCK_ID" => $this->IBlockID);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arPropsn = [];
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                foreach ($arProps as $key => $prop) {
                    switch ($prop['PROPERTY_TYPE']) {
                        case 'S':
                            $arPropsn['PROP'][$key] = $prop['VALUE'];
                            break;
                        case 'F':
                            continue;
                            break;
                        case 'L':
                            $arPropsn['PROP'][$key] = $prop['VALUE_ENUM_ID'];
                            break;
                        case 'N':
                            $arPropsn['PROP'][$key] = $prop['VALUE'];
                            break;
                    }
                }
                $arElement[$arFields['XML_ID']] = array_merge($arFields, $arPropsn);
            }
        }
        return $arElement;
    }

    /**
     * @param $FileResult
     * @param int $line
     * @return array
     */
    static function GetLineFileCsv($FileResult, $line = 1)
    {
        $file = file($FileResult);
        $Fheader = str_getcsv($file[$line - 1], ';');
        fclose($file);
        return $Fheader;
    }

    /**
     * @param $FileResult
     * @param bool $Fheader2
     * @return bool
     */
    static function CsvToArray($FileResult, $Fheader2 = false)
    {

        if (mb_detect_encoding(file_get_contents($FileResult)) != 'UTF-8') {
            ShowError('Кодировка файла должна быть UTF-8');
            return false;
        }

        $i = -1;
        if ($Fheader2) {
            $Fheader = $Fheader2;
        } else {
            $Fheader = self::GetLineFileCsv($FileResult);
            foreach ($Fheader as &$header) {
                $header = mb_convert_encoding($header, 'UTF-8');
            }
        }
        $file = fopen($FileResult, 'r');
        $arResultCsv = false;
        $i = 0;
        while (($data = fgetcsv($file, 0, ";")) !== FALSE) {
            if ($i == 0) {
                $i++;
                continue;
            }
            foreach ($Fheader as $key => $fhl) {
                $arResultCsv[$i][$fhl] = mb_convert_encoding($data[$key], 'UTF-8');
            }
            $i++;
        }
        $arResultCsvN = [];

        foreach ($arResultCsv as $arElm) {
            $key = $arElm['IE_XML_ID'];
            $arResultCsvN[$key] = $arElm;
        }

        return $arResultCsvN;
    }


    public function isUpdateAdd()
    {
        $arCsv = $this->GetData();
        $arElement = $this->GetAllIBlock();
        foreach ($arCsv as $arElm) {
            if (isset($arElement[$arElm['IE_XML_ID']])) {
                $this->arUpdate[] = ['EL' => $arElement[$arElm['IE_XML_ID']], 'CSV' => $arElm];
            } else {
                $this->arAdd[] = $arElm;
            }
        }
    }

    public function ELAdd()
    {
        if (!empty($this->arAdd)) {
            foreach ($this->arAdd as $arElement) {
                $this->Add($arElement);
            }
        }
    }

    public function ELUpdate()
    {
        if (!empty($this->arUpdate)) {
            foreach ($this->arUpdate as $arElement) {
                $this->Update($arElement);
            }
        }
    }

    protected function Add($arFields)
    {
        $PROP = [
            'ARTNUMBER' => $arFields['IE_XML_ID'],
            'PROP_EAN' => $arFields['IP_PROP13'],
            'PRICE' => str_replace(',', '.', $arFields['IP_PROP14']),
            'BALANCE' => $arFields['IP_PROP7'],
            'PROP_COUNT_PAC' => $arFields['IP_PROP12'],
            'BRAND' => $arFields['IP_PROP8'],
            'PROP_COUNTRY' => $arFields['IP_PROP15'],
        ];
        $arLoadProductArray = Array(
            "XML_ID" => $arFields['IE_XML_ID'],
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => $this->IBlockID,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $arFields['IE_NAME'],
            "ACTIVE" => "N",
        );
        $PRODUCT_ID = false;
        $el = new CIBlockElement;
        if ($arLoadProductArray['NAME'] and $PRODUCT_ID = $el->Add($arLoadProductArray)) {
            // echo "New ID: " . $PRODUCT_ID . "\n";
        } else {
            //  echo "Error ADD: " . $el->LAST_ERROR . "<br>";
        }
        return $PRODUCT_ID;
    }

    protected function Update($arFields)
    {
        $arElement = $arFields['EL'];
        $arCsv = $arFields['CSV'];
        $el = new CIBlockElement;
        $PROP = $arElement['PROP'];
        $PROP['PROP_EAN'] = $arCsv['IP_PROP13'];
        $PROP['PRICE'] = str_replace(',', '.', $arCsv['IP_PROP14']);
        $PROP['BALANCE'] = $arCsv['IP_PROP7'];
        $PROP['PROP_COUNT_PAC'] = $arCsv['IP_PROP12'];
        $PROP['BRAND'] = $arCsv['IP_PROP8'];
        $PROP['PROP_COUNTRY'] = $arCsv['IP_PROP15'];
        unset($PROP['MORE_PHOTO']);
        $arLoadProductArray = Array(
            "NAME" => $arCsv['IE_NAME'],
            "ACTIVE" => "Y",
            "PROPERTY_VALUES" => $PROP,
        );
        $PRODUCT_ID = $arElement['ID'];
        if ($PRODUCT_ID > 0 and $el->Update($PRODUCT_ID, $arLoadProductArray)) {
            //  echo "UPDATE ID: " . $PRODUCT_ID . "\n";
        } else {
            // echo "Error UPD: " . $el->LAST_ERROR . "<br>";
        }
        return $PRODUCT_ID;

    }

    private function AllActiveN()
    {
        $tableName = 'b_iblock_element';
        global $DB;
        $strSql = "UPDATE {$tableName} SET ACTIVE='N' WHERE IBLOCK_ID='{$this->IBlockID}' ";
        $res = $DB->Query($strSql, false, 'Method: AllActiveN<br>Line:' . __LINE__);
        return $res;
	}

	//Деактивирует элементы, которым не присвоен раздел каталога, чтобы они не находились в поиске
	private function setActiveNWithoutBlock()
    {
        $tableName = 'b_iblock_element';
        global $DB;
        $strSql = "UPDATE {$tableName} SET ACTIVE='N' WHERE IBLOCK_ID='{$this->IBlockID}' AND IBLOCK_SECTION_ID IS NULL";
        $res = $DB->Query($strSql, false, 'Method: setActiveNWithoutBlock<br>Line:' . __LINE__);
        return $res;
	}
	

    public static function Agent()
    {
        $TralsPriceUpdate = new self($_SERVER['DOCUMENT_ROOT'] . '/upload/import/price.csv', 1, []);
        $TralsPriceUpdate->Start();
        return "TralsPriceUpdate::Agent();";
    }
}


