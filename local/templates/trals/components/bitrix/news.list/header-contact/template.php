<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<ul class="header__contact">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $tel = str_replace(array(' ', ')', '(', '-'), '', $arItem["PROPERTIES"]['PHONE']['VALUE']);
        ?>
        <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="header__contact__label"><?= $arItem["PROPERTIES"]['NAME']['~VALUE'] ?></div>
            <div class="header__contact__data"><a href="tel:<?= $tel ?>"
                                                  title=""><?= $arItem["PROPERTIES"]['PHONE']['VALUE'] ?></a>
                <br><?= $arItem["PROPERTIES"]['EMAIL']['VALUE'] ?>
            </div>
        </li>
    <? endforeach; ?>
</ul>