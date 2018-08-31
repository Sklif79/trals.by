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
if ($arResult['SECTION']['~DESCRIPTION']) {
    ?>
    <div class="catalog-page">
        <div class="main__content single-article width-80 catalog-prew">
           <?=$arResult['SECTION']['~DESCRIPTION']?>
        </div>
    </div>
<? }