<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!is_array($arResult["arMap"]) || count($arResult["arMap"]) < 1)
    return;

$arCatalog = array();
$stop = false;

foreach ($arResult["arMap"] as $k => $arMap) {
    if (!$stop) {
        unset($arResult["arMap"][$k]);
    }
    if ($arMap['LEVEL'] == 1) {
        $arCatalog[] = $arMap;
        $stop = true;
        unset($arResult["arMap"][$k]);
    }
    if ($arMap['LEVEL'] == 0 and $stop) {
        break;
    }
}

?>
<div class="main__content site-map-page">
    <p><a href="<?= SITE_DIR ?>" title="">Главная</a></p>
    <? if (!empty($arCatalog)) { ?>
        <ul>
            <? foreach ($arCatalog as $catalog) { ?>
                <li>
                    <a href="<?= $catalog['SEARCH_PATH'] ?>" title="<?= $catalog['NAME'] ?>"><?= $catalog['NAME'] ?></a>
                </li>
            <? } ?>
        </ul>
    <? } ?>
    <? foreach ($arResult["arMap"] as $arMap) { ?>
        <p><a href="<?= $arMap['SEARCH_PATH'] ?>" title="<?= $arMap['NAME'] ?>"><?= $arMap['NAME'] ?></a></p>
    <? } ?>
</div>