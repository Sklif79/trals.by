<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?><?
if (!empty($arResult['ITEMS'])) {

    $percent = tplvar('percent');
    $strCof = '0.' . $percent;
    $cofItog = 1 - $strCof;

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
                    <li class="price"><span class="left">Прайс безнал.</span><span
                                class="right"><?=round($arItem['PROPERTIES']['PRICE']['VALUE'],2) ?> руб.</span>
                    </li>
                    <li class="price"><span class="left">Оптовая цена безнал.</span><span
                                class="right"><?= round($arItem['PROPERTIES']['PRICE']['VALUE'] * $cofItog,2) ?> руб.</span>
                    </li>
                    <li class="remainder"><span class="left">Остатки</span><span
                                class="right"><?= GetBalanceText($arItem['PROPERTIES']['BALANCE']['VALUE']) ?></span>
                    </li>
                    <? if ($arItem['PROPERTIES']['PROP_COUNT_PAC']['VALUE']) { ?>
					<li class="remainder"><span class="left">Мин. заказ:</span><span
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
    $this->SetViewTarget('section-naw-string');
    echo '<div class="main__content" >' . $arResult['NAV_STRING'] . '</div>';
    $this->EndViewTarget();
}
?>