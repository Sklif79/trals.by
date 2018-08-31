<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?

foreach ($arResult as &$arMenu){
    if($arMenu['LINK']=='/catalog/'){
        $arMenu['LINK']='javascript:void 0';
    }
}
?>