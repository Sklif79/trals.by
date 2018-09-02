<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$arProp = $arResult['PROPERTIES'];

$percent = tplvar('percent');
$strCof = '0.' . $percent;
$cofItog = 1 - $strCof;
?><div class="single-product">
    <div class="single-product__top row">
        <div class="width-48">
            <div class="tovar-picts">
                <div class="tovar-picts__slider-wr">
                    <? if (!empty($arResult['MORE_PHOTO'])) { ?>
                        <div class="slider-for">
                            <? foreach ($arResult['MORE_PHOTO']['ORG'] as $photoID => $Img) { ?>
                                <div>
                                    <a
                                            rel="example_group"
                                            href="<?= $Img['src'] ?>"
                                            class="js-img-modal"
                                            title="">
                                        <img src="<?= $arResult['MORE_PHOTO']['MAX'][$photoID]['src'] ?>" alt=""/>
                                    </a>
                                </div>
                            <? } ?>
                        </div>
                        <div class="slider-nav">
                            <? foreach ($arResult['MORE_PHOTO']['MIN'] as $photoID => $Img) { ?>
                                <div><img src="<?= $Img['src'] ?>" alt=""/></div>
                            <? } ?>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="width-52">
            <h1 class="mob-hidden"><?= $arResult['NAME'] ?>
            </h1>
            <div class="sku">Артикул: <span><?= $arProp['ARTNUMBER']['VALUE'] ?></span></div>
            <? /* <div class="lost">Остатки товара:
                <div class="right"><?= $arProp['BALANCE']['VALUE'] ?></div>
</div> */ ?>
            <? if ($arResult['PREVIEW_TEXT']) { ?>
                <div class="short-desc">
                    <h3>Краткое описание</h3>
                    <?= $arResult['PREVIEW_TEXT'] ?>
                </div>
            <? } ?>
            <?
            unset($arProp['ARTNUMBER'], $arProp['MORE_PHOTO']);
            ?>
            <? if (!empty($arProp)) {
                $i = 1; ?>
                <div class="options-data">
                    <h2>Характеристики товара</h2>
                    <ul class="options-data__list">
                        <? foreach ($arProp as $prop) {
                            if (in_array($prop['CODE'], ['PRICE', 'BALANCE', 'PROP_COUNT_PAC'])) continue;
                            if (!trim($prop['VALUE'])) continue;
                            if ($i <= 4) {
                                ?>
                                <li>
                                    <div class="left"><?= $prop['NAME'] ?>:</div>
                                    <div class="right"><?= $prop['VALUE'] ?></div>
                                </li>
                                <?
                                $i++;
                            }
                        } ?>
                    </ul>
                </div>
                <br>
            <? } ?>
            <div class="price">
                <h3>Цены </h3>
                <ul class="price__list">
                    <li>Розничная цена
                        <div class="right"><?= round($arProp['PRICE']['VALUE']+$arProp['PRICE']['VALUE']*0.1, 2) ?> руб.</div>
                    </li>
                    <li>Оптовая цена, безнал <!--<span>-<?= $percent ?>%--></span>
                        <div class="right"><?= round(($arProp['PRICE']['VALUE'] * $cofItog), 2) ?> руб.</div>
                    </li>
                    <li>Остатки товара
                        <div class="right"><?= GetBalanceText($arProp['BALANCE']['VALUE']) ?></div>
                    </li>
                    <? if ($arProp['PROP_COUNT_PAC']['VALUE']) { ?>
                        <li><span> Заказ кратный упаковкам</span>
                            <div class="right"><span><?= $arProp['PROP_COUNT_PAC']['VALUE'] ?></span></div>
                        </li>
                    <? } ?>
                    <li>
                        <form action="" method="post" name="" class="products-item__form price__list-count-form">
                            <div class="form-count">
                                <span class="form-count__btn form-count__btn-minus"></span>
                                <input type="text" class="form-count__value" data-max-value="1010" value="1000">
                                <span class="form-count__btn form-count__btn-plus"></span>
                            </div>
                            <input type="submit" class="form-count__submit" value="В корзину">
                        </form>
                    </li>
                </ul>
            </div>
            <?
            unset($arProp['PRICE'], $arProp['BALANCE']);
            ?>
        </div>
    </div>
    <div class="single-product__options">
        <? if ($arResult['DETAIL_TEXT']) { ?>
            <div class="long-desc">
                <h2>Описание товара</h2>
                <?= $arResult['DETAIL_TEXT'] ?>
            </div>
        <? } ?>
        <? foreach ($arProp as $code => $prop) {
            if (!$prop['VALUE']) {
                unset($arProp[$code]);
            }
        } ?>
        <? if (!empty($arProp) && count($arProp) > 4) {
            ?>
            <div class="options-data">
                <h2>Полные характеристики товара</h2>
                <ul class="options-data__list">
                    <? foreach ($arProp as $prop) {
                        if ($prop['VALUE']) {
                            ?>
                            <li>
                                <div class="left"><?= $prop['NAME'] ?>:</div>
                                <?
                                if (is_array($prop['VALUE'])) {
                                    ?>
                                    <div class="right"><? echo implode(', ', $prop['VALUE']) ?></div>
                                    <?
                                } else {
                                    ?>
                                    <div class="right"><?= $prop['VALUE'] ?></div>
                                    <?
                                } ?>
                            </li>
                            <?
                        }
                    } ?>
                </ul>
            </div>
        <? } ?>
    </div>
</div>