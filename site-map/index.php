<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.map",
    "site",
    Array(
        "CACHE_TIME" => "3600000",
        "CACHE_TYPE" => "A",
        "COL_NUM" => "1",
        "LEVEL" => "3",
        "SET_TITLE" => "N",
        "SHOW_DESCRIPTION" => "N"
    )
);?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>