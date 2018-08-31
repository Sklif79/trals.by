<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Страница не найдена");
$APPLICATION->SetTitle("404 Not Found");
?>
    <div class="main__content page-404">
        <div class="page-404__wr">
            <div class="page-404__header">ошибка <span>404</span></div>
            <div class="page-404__body">
                <p class="title">Данная страница не существует или не найдена</p>
                <div class="desc">
                    <p>Страница на которую вы зашли не найдена или была удалена.</p>
                    <p>Приносим свои извинения. Попробуйте перейти на другую страницу сайта</p>
                </div>
                <a href="<?= SITE_DIR ?>" class="btn" title="">На главную</a>
            </div>
        </div>
    </div>
<?
$APPLICATION->AddChainItem("Страница 404", "/404.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>