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
<div class="header__top-nav mob-hidden">
    <div class="container">
        <div class="header__top-nav-left">
            <div class="header__top-nav-address">
                PБ, 220113, Минск, Логойский тракт, д.15, к.4
            </div>
            <a href="#fb-map" class="address__map js-open-modal" title=""><span>Посмотреть на карте</span></a>
        </div>
        <div class="header__top-nav-right">
            <a href="#" class="lnk-shipping header__top-nav-lnk"><span>Доставка</span></a>
            <a href="#" class="lnk-warranty header__top-nav-lnk"><span>Гарантия</span></a>
            <a href="#" class="lnk-payments header__top-nav-lnk"><span>Способы оплаты</span></a>
        </div>
    </div>
</div>
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