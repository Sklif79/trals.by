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
<div class="header__top">
    <div class="container">
        <ul class="header__contact flex">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li  id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="header__contact__label"><?= $arItem["PROPERTIES"]['NAME']['~VALUE'] ?></div>
                    <div class="header__contact__data"><?= $arItem["PROPERTIES"]['PHONE']['VALUE'] ?> <br><a href="mailto:<?= $arItem["PROPERTIES"]['NAME']['EMAIL'] ?>" title=""><?= $arItem["PROPERTIES"]['EMAIL']['VALUE'] ?></a>
                    </div>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>