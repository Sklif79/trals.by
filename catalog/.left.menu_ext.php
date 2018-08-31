<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "ID" => $_REQUEST["ELEMENT_ID"],
        "IBLOCK_TYPE" => "books",
        "IBLOCK_ID" => "1",
        "DEPTH_LEVEL" => "1",
        "SECTION_URL" => "/catalog/#SECTION_CODE#/",
        "CACHE_TIME" => "3600000"
    )
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>