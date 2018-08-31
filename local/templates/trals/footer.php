<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?><? if (IS_MAIN == 'N') { ?>
    </div>
    </div>
<? } ?>
<!-- -->
</div>
</div>
<!-- // -->

<footer class="footer">
    <!-- Подвал верх -->
    <div class="footer__top">
        <div class="container">
            <div id="back_top" class="back_top"></div>
            <div class="row">
                <div class="width-28">
                    <a href="/" class="mob-hidden footer__logo" title="">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/i/pic-logo.png" alt="">
                    </a>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/includes/footer1.php",
                        ),
                        false
                    ); ?>
                </div>
                <div class="width-72">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600000",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "COMPONENT_TEMPLATE" => "header"
                        ),
                        false
                    ); ?>
                    <ul class="footer__contact flex">
                        <li class="address">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/includes/footer2.php",
                                ),
                                false
                            ); ?>
                        </li>
                        <li>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/includes/footer3.php",
                                ),
                                false
                            ); ?>
                        </li>
                        <li>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/includes/footer4.php",
                                ),
                                false
                            ); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Подвал копирайт -->
    <div class="footer__copyright">
        <div class="container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/includes/footer5.php",
                    ),
                    false
                ); ?>
        </div>
    </div>
</footer>

<!-- -->
</div>
<!-- // -->

<!-- Модальная карта -->
<div id="fb-map" class="g-modal-win" style="display: none;">
    <div class="g-modal-win__content">
        <div class="modal__address"><span>Адрес:</span> Республика Беларусь, индекс 220113, г.Минск, Логойский тракт,
            д.15, корп.4			
        </div>
        <div id="ya-map" class="ya-map"></div>
        <div class="clearfix">
            <div class="modal__phone">
                <div class="title">Номера телефонов:</div>
                <p>Отдел элементов питания: <span><a href="tel:+37517312693133"
                                                     title="">+375 (17) 269-31-33</a></span> <br class="mob-hidden">Отдел
                    герметичных аккумулятор: <span><a href="tel:+375172693155" title="">+375 (17) 269-31-55</a></span>
                    <br class="mob-hidden">
                    Отдел светотехники: <span><a href="tel:+375172693144"
                                                            title="">+375 (17) 269-31-44</a></span> <br
                            class="mob-hidden">Общий номер: <span><a href="tel:+375172693132" title="">+375 (17) 269-31-32</a></span>
                </p>
            </div>
            <div class="modal__time">
                <div class="title">Время работы:</div>
                <p>понедельник — пятница: <span>с 9:00 до 17:00</span><br>суббота, воскресенье:
                    <span>выходной</span></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>