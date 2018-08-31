<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
global $USER, $URL,$APPLICATION;
$URL = $APPLICATION->GetCurPage(false);
$is_main = 'N';
if ($URL == SITE_DIR) {
    $is_main = 'Y';
}
define('IS_MAIN', $is_main);
//CAjax::Init(); // подключаем ajax;
CJSCore::Init(array('ajax'));
?>    <!DOCTYPE html>
    <!--[if lt IE 7]>
    <html lang="<?=LANGUAGE_ID?>" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
    <!--[if IE 7]>
    <html lang="<?=LANGUAGE_ID?>" class="lt-ie9 lt-ie8"><![endif]-->
    <!--[if IE 8]>
    <html lang="<?=LANGUAGE_ID?>" class="lt-ie9"><![endif]-->
    <!--[if gt IE 8]><!-->
<html lang="<?= LANGUAGE_ID ?>">
    <!--<![endif]-->
    <head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-65775906-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-65775906-1');
</script>
        <? $APPLICATION->ShowHead(); ?>
        <title><? $APPLICATION->ShowTitle(); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.png">
        <!-- style include -->
        <?
        //CSS
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/libs/font-awesome-4.2.0/css/font-awesome.min.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/libs/owl-carousel/assets/owl.carousel.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/libs/easy-responsive-tabs-to-accordion/easy-responsive-tabs.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/libs/slick-1.8.0/slick/slick.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/libs/slick-1.8.0/slick/slick-theme.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/fonts.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/style.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/media.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/luiwadjogs.css");
        ?>
        <!--[if lt IE 9]>
        <script src="<?=SITE_TEMPLATE_PATH?>/libs/html5shiv/es5-shim.min.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/libs/html5shiv/html5shiv.min.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/libs/html5shiv/html5shiv-printshiv.min.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/libs/respond/respond.min.js"></script>
        <![endif]-->

        <script src="https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU"
                type="text/javascript"></script>
        <script type="text/javascript">
            ymaps.ready(init);
            var myMap,
                myPlacemark;

            function init() {
                myMap = new ymaps.Map("ya-map", {
                    center: [53.9443346, 27.6099203],
                    zoom: 17
                });
                myMap.controls.add(
                    new ymaps.control.ZoomControl()
                );
                var myPlacemark = new ymaps.Placemark([53.9443346, 27.6099203], {
                    hintContent: 'Тралс',
                    balloonContent: 'Минск, Логойский тракт, 15 корпус 4'
                }, {
                    iconImageHref: '<?=SITE_TEMPLATE_PATH?>/images/i/baloon_map.png',
                    iconImageSize: [23, 30],
                    iconImageOffset: [-12, -30]
                });
                myMap.geoObjects.add(myPlacemark);
            }
        </script>
        <!-- scrits include -->
        <?
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/libs/jquery/jquery-1.7.1.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/libs/jquery/jquery-migrate-1.2.1.min.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/libs/owl-carousel/owl.carousel.min.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.pack.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/libs/jquery/jquery-ui-1.8.11.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/libs/easy-responsive-tabs-to-accordion/easyResponsiveTabs.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/libs/slick-1.8.0/slick/slick.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/custom-ui-slider.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.ui.touch-punch.min.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/common.js", true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/luiwadjogs.js", true);
        ?>
    </head>
<body>
    <div id="panel">
        <? $APPLICATION->ShowPanel(); ?>
    </div>
    <!-- -->
<div class="bd-site">
    <div class="b-fixed-footer">
    <div class="b-footer-padding">
    <!-- // -->
    <!-- Мобильное меню -->
<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "header_mobile",
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
    <!-- Мобильные контакты -->
    <div class="mobile-aside mobile-aside__contact">
        <div class="mobile-aside__contact__header">
            <div class="mobile-aside__contact__close">
                <i></i> Закрыть
            </div>
        </div>
        <div class="mobile-aside__contact__body">
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "header-contact",
                array(
                    "ACTIVE_DATE_FORMAT" => "j F Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "NAME",
                        1 => "",
                    ),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "6",
                    "IBLOCK_TYPE" => "Content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "EMAIL",
                        1 => "PHONE",
                        2 => "NAME",
                        3 => "",
                        4 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "header-top"
                ),
                false
            ); ?>
            <div class="header__address address">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/includes/header1.php",
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>

    <header class="header">
        <!-- Шапка верх -->
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "header-top",
            array(
                "ACTIVE_DATE_FORMAT" => "j F Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "NAME",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "6",
                "IBLOCK_TYPE" => "Content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "EMAIL",
                    1 => "PHONE",
                    2 => "NAME",
                    3 => "",
                    4 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "header-top"
            ),
            false
        ); ?>
        <!-- Шапка низ + меню -->
        <div class="header__center clearfix">
            <div class="container">
                <div class="flex">
                    <div class="mobile-trigger">
                        <i></i><span>Меню</span>
                    </div>
                    <a href="/" class="header__logo" title="">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/i/pic-logo.png" alt="">
                    </a>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "header",
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
                    <div class="header__address address">
                        <div class="mobile-address-trigger">
                            <i></i>
                        </div>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/includes/header2.php",
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
<? if (IS_MAIN == 'N') { ?>
    <div class="main">
    <div class="container">
    <!-- Хлебные крошки -->
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "site",
        Array(
            "PATH" => "",
            "SITE_ID" => SITE_ID,
            "START_FROM" => 0,
        ),
        false
    );
    $noH1=array('/contacts/','/404.php');
    if(!in_array($URL,$noH1)){?>
        <h1><? $APPLICATION->ShowTitle(false) ?></h1>
    <?}
    ?>
<? } ?>