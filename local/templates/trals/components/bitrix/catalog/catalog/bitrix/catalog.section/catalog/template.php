<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?><?

$percent = tplvar('percent');
$strCof = '0.' . $percent;
$cofItog = 1 - $strCof;

if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $arItem) {
        ?>
        <div class="item">
            <!--    добавить класс product-item_sale для товаров по акции       -->
            <div class="products-item product-item_sale">
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                    <div class="products-item__pic">
                        <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                             alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                        <div class="label-sale">Акция</div>
                    </div>
                    <h2 class="products-item__title"><?= $arItem['NAME'] ?></h2>
                    <ul class="products-item__options">
                        <li class="price"><span class="left">Оптовая цена <b>за шт</b></span><span class="right">
                                <span class="right__old-price">299 руб</span>
                                <?= round($arItem['PROPERTIES']['PRICE']['VALUE'] * $cofItog, 2) ?> руб</span>
                        </li>
                        <li class="price"><span class="left">Розничная цена. <b>за шт</b></span><span class="right">
                                <?= round($arItem['PROPERTIES']['PRICE']['VALUE'] + $arItem['PROPERTIES']['PRICE']['VALUE'] * 0.1, 2) ?>руб</span>
                        </li>
                        <li class="remainder"><span class="left">Остатки</span><span
                                    class="right"><?= GetBalanceText($arItem['PROPERTIES']['BALANCE']['VALUE']) ?></span>
                        </li>
                        <? if ($arItem['PROPERTIES']['PROP_COUNT_PAC']['VALUE']) { ?>
                            <li class="remainder red"><span class="left">Мин. заказ</span><span
                                        class="right"><?= $arItem['PROPERTIES']['PROP_COUNT_PAC']['VALUE'] ?></span>
                            </li>
                        <? } ?>
                    </ul>
                </a>
                <form action="" method="post" name="" class="products-item__form">
                    <div class="form-count">
                        <span class="form-count__btn form-count__btn-minus"></span>
                        <input type="text" class="form-count__value" data-max-value="1010" value="1000">
                        <span class="form-count__btn form-count__btn-plus"></span>
                    </div>
                    <input type="submit" class="form-count__submit" value="В корзину">
                </form>
            </div>
        </div>
    <? } ?>
<? } else { ?>
    <div class="no-item">Нет товаров в категории</div>
<? } ?>

<?

if ($arResult['NAV_STRING']) {
    $NAV_RESULT = $arResult['NAV_RESULT'];
    ?>
    <input
            type="hidden"
            data-NavPageNomer="<?= $NAV_RESULT->NavPageNomer; ?>"
            data-NavPageCount="<?= $NAV_RESULT->NavPageCount ?>"
            value="<?= $NAV_RESULT->PAGEN ?>"
    >
<? } ?>