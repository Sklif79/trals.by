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
<div class="main__content">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <article class="articles-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="row">
                <div class="articles-list__img">
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" title="<?= $arItem['NAME'] ?>"><img
                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"></a>
                </div>
                <div class="articles-list__content">
                    <h2><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
                           title="<?= $arItem['NAME'] ?>"><?= $arItem['NAME'] ?></a></h2>
                    <p class="prew"><?= $arItem['PREVIEW_TEXT'] ?></p>
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="btn" title="">подробнее</a>
                </div>
            </div>
        </article>
    <? endforeach; ?>
    <?
    if ($arResult['NAV_STRING']) {
        echo $arResult['NAV_STRING'];
    }
    ?>
</div>