<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?><?

$percent = tplvar('percent');
$strCof = '0.' . $percent;
$cofItog = 1 - $strCof;

if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $arItem) {
        ?>
        <div class="item">
            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="products-item">
                <div class="products-item__pic">
                    <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                         alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                </div>
                <h2 class="products-item__title"><?= $arItem['NAME'] ?></h2>
                <ul class="products-item__options">
                    <li class="price"><span class="left">Розничная цена.</span><span
						class="right"><?= round($arItem['PROPERTIES']['PRICE']['VALUE']+$arItem['PROPERTIES']['PRICE']['VALUE']*0.1,2) ?> руб</span>
                    </li>
                    <li class="price"><span class="left">Оптовая цена</span><span
                                class="right"><?=round( $arItem['PROPERTIES']['PRICE']['VALUE']*$cofItog,2) ?> руб</span>
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