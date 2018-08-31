<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$arResult['MORE_PHOTO'] = array();
if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $arPhoto) {
        $arResult['MORE_PHOTO']['ORG'][$arPhoto]['src'] = CFile::GetPath($arPhoto);
        $arResult['MORE_PHOTO']['MIN'][$arPhoto] = CFile::ResizeImageGet($arPhoto, array('width' => 70, 'height' => 70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult['MORE_PHOTO']['MAX'][$arPhoto] = CFile::ResizeImageGet($arPhoto, array('width' => 430, 'height' => 430), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
}