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
$arMenuSort = $arParams['arMenuSort'];
?><div class="width-25 aside mobile-filters">
    <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" id="smartfilter"
          action="<? echo $arResult["FORM_ACTION"] ?>"
          method="get" class="smartfilter">
        <input type="hidden" name="ajax" value="y">
        <div class="aside__filter accordion">
            <? foreach ($arResult["HIDDEN"] as $arItem): ?>
                <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                       value="<? echo $arItem["HTML_VALUE"] ?>"/>
            <? endforeach; ?>
            <div class="aside__filter__header">
                <div class="aside__filter__cat"><? $APPLICATION->ShowTitle(false) ?></div>
                <div class="aside__filter__close"></div>
            </div>

            <div class="hidden-desktop">
                <div class="aside__filter__item btn-wr mob-hidden">
                    <a href="javascript:void 0" class="btn submit gray" title="">Подобрать</a>
                </div>
                <div class="aside__filter__item btn-wr mobile-filter-active">
                    <a href="<?= $arResult['SECTION_PAGE_URL'] ?>" class="btn gray" title="">Очистить</a>
                    <a href="javascript:void 0" class="btn submit appruve" title=""><span>Готово</span></a>
                </div>
            </div>

            <div class="aside__filter__item aside-mob-sort">
                <div class="aside__filter__item__title accordion-item">Сначала</div>
                <div class="aside__filter__item__var data">
                    <ul class="radio">
                        <? foreach ($arMenuSort as $items) { ?>
                            <? $selected = $items['SELECTED'] ? 'checked="checked"' : ''; ?>
                            <li>
                                <label>
                                    <input onchange="location.href='<?= $items['HREF'] ?>'" id="" class=""
                                           name="sort" <?= $selected ?> value="" type="radio">
                                    <span><?= $items['NAME'] ?></span>
                                </label>
                            </li>
                        <? } ?>
                    </ul>
                </div>
            </div>
            <div class="aside__filter__item btn-wr mob-hidden">
                <a href="<?= $arResult['SECTION_PAGE_URL'] ?>" id="clear-filter" class="btn gray" title="">Очистить
                    фильтры</a>
            </div>
            <? if (!empty($arResult['ITEMS'][14])) { ?>
                <?
                $priceFilter = $arResult['ITEMS'][14];
                $minPriceF = $priceFilter['VALUES']['MIN'];
                $maxPriceF = $priceFilter['VALUES']['MAX'];
                $minPriceV = $minPriceF['HTML_VALUE'] ? $minPriceF['HTML_VALUE'] : $minPriceF['VALUE'];
                $maxPriceV = $maxPriceF['HTML_VALUE'] ? $maxPriceF['HTML_VALUE'] : $maxPriceF['VALUE'];
                if ($minPriceV != $maxPriceV) {
                    ?>
                    <div class="aside__filter__item">
                        <div class="aside__filter__item__title accordion-item">Цена, руб, за <b>1 ШТ. с НДС</b></div>
                        <div class="aside__filter__item__var data">
                            <!-- START::NEW_UI_SLIDER-->
                            <div class="filter__attrs cr-filter__price">
                                <dl class="b-filter-attr j-slider_range" from="<?= $minPriceF['VALUE'] ?>"
                                    to="<?= $maxPriceF['VALUE'] ?>">
                                    <dd class="filter-attr__value slider-input">
                                        <div class="filter__textlabel slider-input__left">
                                            <span class="dscr">от </span>
                                            <span class="g-form__inputwrap">
														<input class="g-form__text"
                                                               name="<?= $minPriceF['CONTROL_NAME'] ?>"
                                                               value="<?= (float)$minPriceV ?>" maxlength="11"
                                                               placeholder="<?= $minPriceF['VALUE'] ?>" type="text">
													</span>
                                        </div>
                                        <div class="filter__textlabel slider-input__right">
                                            <span class="dscr">до</span>
                                            <span class="g-form__inputwrap">
														<input class="g-form__text"
                                                               name="<?= $maxPriceF['CONTROL_NAME'] ?>"
                                                               value="<?= (float)$maxPriceV ?>" maxlength="11"
                                                               placeholder="<?= $maxPriceF['VALUE'] ?>" type="text">
													</span>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            <!-- END::NEW_UI_SLIDER-->
                            <!--div class="checkbox">
                                <label>
                                    <input id="" class="" name="" value="" type="checkbox">
                                    <span>Новинка</span>
                                </label>
                            </div-->
                        </div>
                    </div>
                <? } ?>
                <?
                unset($arResult['ITEMS'][14]);
                ?>
            <? } ?>
            <?
            foreach ($arResult['ITEMS'] as $arItem) {
                if (!empty($arItem['VALUES'])) {
                    switch ($arItem['DISPLAY_TYPE']) {
                        case 'L':
                        case 'F':
                            ?>
                            <div class="aside__filter__item">
                                <div class="aside__filter__item__title accordion-item"><?= $arItem['NAME'] ?></div>
                                <div class="aside__filter__item__var data">
                                    <input type="text" class="aside__filter-field" style="display: none">
                                    <ul class="checkbox">
                                        <?
                                        foreach ($arItem['VALUES'] as $value) {
                                            $CHECKED = $value['CHECKED'] == 1 ? 'checked="checked"' : '';
                                            ?>
                                            <li>
                                                <label>
                                                    <input <?= $CHECKED ?> id="<?= $value['CONTROL_ID'] ?>" class=""
                                                                           name="<?= $value['CONTROL_NAME'] ?>"
                                                                           value="<?= $value['HTML_VALUE'] ?>"
                                                                           type="checkbox">
                                                    <span><?= $value['VALUE'] ?></span>
                                                </label>
                                            </li>
                                            <?
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                            <?
                            break;
                        case 'K':
                            ?>
                            <div class="aside__filter__item">
                                <div class="aside__filter__item__title accordion-item"><?= $arItem['NAME'] ?></div>
                                <div class="aside__filter__item__var data">
                                    <ul class="radio">
                                        <?
                                        foreach ($arItem['VALUES'] as $value) {
                                            $CHECKED = $value['CHECKED'] == 1 ? 'checked="checked"' : '';
                                            ?>
                                            <li>
                                                <label>
                                                    <input <?= $CHECKED ?> id="<?= $value['CONTROL_ID'] ?>" class=""
                                                                           name="<?= $value['CONTROL_NAME_ALT'] ?>"
                                                                           value="<?= $value['HTML_VALUE_ALT'] ?>"
                                                                           type="radio">
                                                    <span><?= $value['VALUE'] ?></span>
                                                </label>
                                            </li>
                                            <?
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                            <?
                            break;
                        case 'A':
                            $priceFilter = $arItem;
                            $minPriceF = $priceFilter['VALUES']['MIN'];
                            $maxPriceF = $priceFilter['VALUES']['MAX'];
                            $minPriceV = $minPriceF['HTML_VALUE'] ? $minPriceF['HTML_VALUE'] : $minPriceF['VALUE'];
                            $maxPriceV = $maxPriceF['HTML_VALUE'] ? $maxPriceF['HTML_VALUE'] : $maxPriceF['VALUE'];
                            if ($minPriceV == $maxPriceV) {
                                continue;
                            }
                            ?>
                            <div class="aside__filter__item">
                                <div class="aside__filter__item__title accordion-item"><?= $arItem['NAME'] ?></div>
                                <div class="aside__filter__item__var data">
                                    <!-- START::NEW_UI_SLIDER-->
                                    <div class="filter__attrs cr-filter__price">
                                        <dl class="b-filter-attr j-slider_range" from="<?= $minPriceF['VALUE'] ?>"
                                            to="<?= $maxPriceF['VALUE'] ?>">
                                            <dd class="filter-attr__value slider-input">
                                                <div class="filter__textlabel slider-input__left">
                                                    <span class="dscr">от </span>
                                                    <span class="g-form__inputwrap">
														<input class="g-form__text"
                                                               name="<?= $minPriceF['CONTROL_NAME'] ?>"
                                                               value="<?= (float)$minPriceV ?>" maxlength="11"
                                                               placeholder="<?= $minPriceF ?>" type="text">
													</span>
                                                </div>
                                                <div class="filter__textlabel slider-input__right">
                                                    <span class="dscr">до</span>
                                                    <span class="g-form__inputwrap">
														<input class="g-form__text"
                                                               name="<?= $maxPriceF['CONTROL_NAME'] ?>"
                                                               value="<?= (float)$maxPriceV ?>" maxlength="11"
                                                               placeholder="<?= $maxPriceF['VALUE'] ?>" type="text">
													</span>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <?
                            break;
                    }
                }
            }
            ?>
            <div class="aside__filter__item btn-wr mob-hidden">
                <a href="javascript:void 0" class="btn submit gray" title="">Подобрать</a>
            </div>
            <div class="aside__filter__item btn-wr mobile-filter-active">
                <a href="<?= $arResult['SECTION_PAGE_URL'] ?>" class="btn gray" title="">Очистить</a>
                <a href="javascript:void 0" class="btn submit appruve" title=""><span>Готово</span></a>
            </div>
        </div>
    </form>
</div>