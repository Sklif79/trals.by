<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Application;

/*Loader::includeSharewareModule("htc.twigintegrationmodule");
// Сброс кеша твига при обычном сбросе кеша шаблонов
$request = Application::getInstance()->getContext()->getRequest();
if ($request->getQuery("clear_cache") == "Y") {
    TwigTemplateEngine::clearCacheFiles();
}*/

function PR($o, $show = false)
{
    global $USER;
    if ($show || (is_object($USER) and $USER->isAdmin())) {
        $bt = debug_backtrace();
        $bt = $bt[0];
        $dRoot = $_SERVER["DOCUMENT_ROOT"];
        $dRoot = str_replace("/", "\\", $dRoot);
        $bt["file"] = str_replace($dRoot, "", $bt["file"]);
        $dRoot = str_replace("\\", "/", $dRoot);
        $bt["file"] = str_replace($dRoot, "", $bt["file"]);
        ?>
        <div class="pr_1">
            <div class="pr_2">
                File: <?= $bt["file"] ?> [<?= $bt["line"] ?>]
            </div>
            <pre><? print_r($o) ?></pre>
        </div>
        <?
    } else {
        return false;
    }
    return false;
}


if (!function_exists("getChilds")) {
    function getChilds($input, &$start = 0, $level = 0)
    {
        if (!$level) {
            $lastDepthLevel = 1;
            if (is_array($input)) {
                foreach ($input as $i => $arItem) {
                    if ($arItem["DEPTH_LEVEL"] > $lastDepthLevel) {
                        if ($i > 0) {
                            $input[$i - 1]["IS_PARENT"] = 1;
                        }
                    }
                    $lastDepthLevel = $arItem["DEPTH_LEVEL"];
                }
            }
        }
        $childs = array();
        $count = count($input);
        for ($i = $start; $i < $count; $i++) {
            $item = $input[$i];
            if ($level > $item['DEPTH_LEVEL'] - 1) {
                break;
            } elseif (!empty($item['IS_PARENT'])) {
                $i++;
                $item['CHILD'] = getChilds($input, $i, $level + 1);
                $i--;
            }
            $childs[] = $item;
        }
        $start = $i;
        return $childs;
    }
}

function GetBalanceText($count)
{
    $text = '';
    if (!$count) {
        $text = 'Нет на складе';
    } elseif ($count <= 50) {
        $text = '<50';
    } elseif ($count <= 100) {
        $text = '<100';
    } elseif ($count <= 300) {
        $text = '<300';
    } elseif ($count <= 500) {
        $text = '<500';
    } elseif ($count <= 1000) {
        $text = '<1000';
    } else {
        $text = '>1000';
    }
    return $text;
}

AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
function _Check404Error()
{
    if (defined('ERROR_404') && ERROR_404 == 'Y') {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/404.php';
        include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';
    }
}


include_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/TralsPriceUpdate.php';
