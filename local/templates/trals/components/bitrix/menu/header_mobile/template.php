<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <div class="mobile-aside mobile-aside__nav">
        <div class="mobile-aside__nav__header">
            <div class="mobile-aside__nav__close">
                <i></i> Закрыть
            </div>
        </div>
        <nav class="mobile-aside__nav__body">
            <ul class="mobile__menu">
                <?
                $previousLevel = 0;
                foreach ($arResult

                as $arItem): ?>

                <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
                    <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
                <? endif ?>

                <? if ($arItem["IS_PARENT"]): ?>

                <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                <li class="has-children"><a href="<?= $arItem["LINK"] ?>"
                                            class="<? if ($arItem["SELECTED"]): ?>selected<? endif ?>"><?= $arItem["TEXT"] ?></a>
                    <ul class="sub-menu">
                        <? else: ?>
                        <li<? if ($arItem["SELECTED"]): ?> class="selected"<? endif ?>><a href="<?= $arItem["LINK"] ?>"
                                                                                          class="parent"><?= $arItem["TEXT"] ?></a>
                            <ul>
                                <? endif ?>

                                <? else: ?>

                                    <? if ($arItem["PERMISSION"] > "D"): ?>

                                        <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                                            <li><a href="<?= $arItem["LINK"] ?>"
                                                   class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?>root-item<? endif ?>"><?= $arItem["TEXT"] ?></a>
                                            </li>
                                        <? else: ?>
                                            <li<? if ($arItem["SELECTED"]): ?> class="item-selected"<? endif ?>><a
                                                        href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                                        <? endif ?>

                                    <? else: ?>

                                        <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                                            <li><a href=""
                                                   class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?>root-item<? endif ?>"
                                                   title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a>
                                            </li>
                                        <? else: ?>
                                            <li><a href="" class="denied"
                                                   title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a>
                                            </li>
                                        <? endif ?>

                                    <? endif ?>

                                <? endif ?>

                                <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

                                <? endforeach ?>

                                <? if ($previousLevel > 1)://close last item tags?>
                                    <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
                                <? endif ?>
                            </ul>
                        <ul class="mobile__submenu">
                            <li><a href="#" class="lnk-shipping header__top-nav-lnk"><span>Доставка</span></a></li>
                            <li><a href="#" class="lnk-warranty header__top-nav-lnk"><span>Гарантия</span></a></li>
                            <li><a href="#" class="lnk-payments header__top-nav-lnk"><span>Способы оплаты</span></a></li>
                        </ul>
        </nav>
    </div>
<? endif ?>