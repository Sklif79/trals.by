<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");

?>


        <ul class="pagination">

            <? if ($arResult['NavPageNomer'] != 1) {
                ?><li><a class="prev"
                     href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">
                </a></li>
            <? } ?>

            <? if ($arResult["bDescPageNumbering"] === true): ?>

                <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
                    <? if ($arResult["bSavePage"]): ?>
                        <li class=""><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><span>1</span></a>
                        </li>
                    <? else: ?>
                        <li class=""><a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><span>1</span></a>
                        </li>
                    <? endif ?>
                <? else: ?>
                    <li><span>1</span></li>
                <? endif ?>

                <?
                $arResult["nStartPage"]--;
                while ($arResult["nStartPage"] >= $arResult["nEndPage"] + 1):
                    ?>
                    <? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

                    <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                    <li><span><?= $NavRecordGroupPrint ?></span></li>
                <? else: ?>
                    <li class=""><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><span><?= $NavRecordGroupPrint ?></span></a>
                    </li>
                <? endif ?>

                    <? $arResult["nStartPage"]-- ?>
                <? endwhile ?>

                <? if ($arResult["NavPageNomer"] > 1): ?>
                    <? if ($arResult["NavPageCount"] > 1): ?>
                        <li class=""><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><span><?= $arResult["NavPageCount"] ?></span></a>
                        </li>
                    <? endif ?>
                <? else: ?>
                    <? if ($arResult["NavPageCount"] > 1): ?>
                        <li><span><?= $arResult["NavPageCount"] ?></span></li>
                    <? endif ?>
                <? endif ?>

            <? else: ?>

                <? if ($arResult["NavPageNomer"] > 1): ?>
                    <? if ($arResult["bSavePage"]): ?>
                        <li class=""><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><span>1</span></a>
                        </li>
                    <? else: ?>
                        <li class=""><a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><span>1</span></a>
                        </li>
                            <? if($arResult["NavPageNomer"] > 3): ?>
                                <li class=""><span>...</span></li>
                            <? endif ?>
                    <? endif ?>
                <? else: ?>
                    <li><span>1</span></li>
                <? endif ?>

                <?
                $arResult["nStartPage"]++;
                while ($arResult["nStartPage"] <= $arResult["nEndPage"] - 1):
                    ?>
                    <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                    <li><span><?= $arResult["nStartPage"] ?><span></li>
                <? else: ?>
                    <li class=""><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><span><?= $arResult["nStartPage"] ?></span></a>
                    </li>
                <? endif ?>
                    <? $arResult["nStartPage"]++ ?>
                <? endwhile ?>

                <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
                    <? if ($arResult["NavPageCount"] > 1): ?>
                        <? if($arResult["NavPageNomer"] < $arResult["NavPageCount"] - 2){ ?>
                            <li class=""><span>...</span></li>
                        <? } ?>
                        <li class=""><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><span><?= $arResult["NavPageCount"] ?></span></a>
                        </li>
                    <? endif ?>
                <? else: ?>
                    <? if ($arResult["NavPageCount"] > 1): ?>
                        <li><span><?= $arResult["NavPageCount"] ?><span></li>
                    <? endif ?>
                <? endif ?>
            <? endif ?>


            <? if ($arResult['NavPageNomer'] != $arResult['NavPageCount']) {
                ?><li><a class="next"
                     href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
                   </a></li>
            <? } ?>
        </ul>
