<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Батарейки, лампы, аккумуляторы по ценам от первого импортера. Большой ассортимент, гарантия, сервис.");
$APPLICATION->SetPageProperty("TITLE", "ОДО \"Тралс\" - импортер элеметов питания, аккумуляторов, ламп.");
$APPLICATION->SetPageProperty("keywords", "элементы питания, батарейки, аккумуляторы, лампы, минск, безнал, оптом,");
$APPLICATION->SetTitle("Главная");
?>
    <div class="main">
        <div class="container">
            <!-- Слайдер брендов -->
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "index_brands",
                Array(
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
                        1 => "PREVIEW_PICTURE",
                        2 => "DATE_ACTIVE_FROM",
                        3 => "",
                    ),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "2",
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
                        0 => "link",
                        1 => "",
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
                    "COMPONENT_TEMPLATE" => ".default"
                ),
                false
            ); ?>
            <!-- Текст под слайдером -->
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "index",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/includes/index.php",
                ),
                false
            ); ?>
        </div>
        <!-- Поиск -->
        <div class="gray-bg">
            <div class="container">
                <form class="search clearfix" action="/catalog/">
                    <input class="search__txt" value="" name="q" placeholder="Поиск по названию, артикулу, EAN "
                           type="search">
                    <button class="search__submit" type="submit"><span>Найти</span></button>
                </form>
            </div>
        </div>
        <!-- Категории на главной -->
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "index",
            Array(
                "ADD_SECTIONS_CHAIN" => "N",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COUNT_ELEMENTS" => "N",
                "IBLOCK_ID" => "1",
                "IBLOCK_TYPE" => "catalog",
                "SECTION_CODE" => "",
                "SECTION_FIELDS" => array(
                    0 => "NAME",
                    1 => "PICTURE",
                    2 => "",
                ),
                "SECTION_ID" => "",
                "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/",
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SHOW_PARENT_NAME" => "Y",
                "TOP_DEPTH" => "1",
                "VIEW_MODE" => "LINE",
            ),
            false
        ); ?>
    </div>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>