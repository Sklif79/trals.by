<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Страница не найдена");
$APPLICATION->SetTitle("404 Not Found");
?>
<!--    <div class="main__content page-404">-->
<!--        <div class="page-404__wr">-->
<!--            <div class="page-404__header">ошибка <span>404</span></div>-->
<!--            <div class="page-404__body">-->
<!--                <p class="title">Данная страница не существует или не найдена</p>-->
<!--                <div class="desc">-->
<!--                    <p>Страница на которую вы зашли не найдена или была удалена.</p>-->
<!--                    <p>Приносим свои извинения. Попробуйте перейти на другую страницу сайта</p>-->
<!--                </div>-->
<!--                <a href="--><?//= SITE_DIR ?><!--" class="btn" title="">На главную</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<div class="basket-page">
    <div class="basket-warning-wrap">
        <div class="basket-warning">
            Окончательная сумма будет рассчитана нашими менеджерами в зависимости от объема заказа.<br>
            Сумма может быть изменена нашими менеджерами только в сторону уменьшения!
        </div>
        <a href="/" class="back-catalog-btn">Вернуться к покупкам</a>
    </div>


    <table class="basket-table">
        <tr>
            <th>Товар</th>
            <th>Название</th>
            <th>EAN</th>
            <th>Количество</th>
            <th>Цена за шт</th>
            <th>Общий вес</th>
            <th>Сумма</th>
            <th></th>
        </tr>
        <tr>
            <td>
                <img src="http://trals.my-veda.ru/upload/iblock/dce/dce46ebbd123f6d0b3ddde83928e0cb5.jpg" alt="">
            </td>
            <td>
                <div class="basket-table__title">DURACELL TurboMax LR03/MX2400 2BP</div>
                <div class="basket-table__sku"><span class="label-sku"> Артикул:</span> 6546746546</div>
            </td>
            <td>
                <span class="label-mobile">EAN:</span>6546746546546
            </td>
            <td>
                <span class="label-mobile">Количество:</span>
                <div class="form-count">
                    <span class="form-count__btn form-count__btn-minus"></span>
                    <input type="text" class="form-count__value" data-max-value="1010" value="1000">
                    <span class="form-count__btn form-count__btn-plus"></span>
                </div>
            </td>
            <td>
                <span class="label-mobile">Цена за шт:</span>
                150 000 руб
            </td>
            <td>
                <span class="label-mobile">Общий вес:</span>
                3000 кг
            </td>
            <td>
                <span class="label-mobile">Сумма</span>
                100 150 000 руб
            </td>
            <td>
                <span class="label-mobile"></span>
                <div class="basket-table__del">Удалить</div>
            </td>
        </tr>
        <tr>
            <td>
                <img src="http://trals.my-veda.ru/upload/iblock/dce/dce46ebbd123f6d0b3ddde83928e0cb5.jpg" alt="">
            </td>
            <td>
                <div class="basket-table__title">DURACELL TurboMax LR03/MX2400 2BP</div>
                <div class="basket-table__sku"><span class="label-sku"> Артикул:</span> 6546746546</div>
            </td>
            <td>
                <span class="label-mobile">EAN</span>6546746546546
            </td>
            <td>
                <span class="label-mobile">Количество</span>
                <div class="form-count">
                    <span class="form-count__btn form-count__btn-minus"></span>
                    <input type="text" class="form-count__value" data-max-value="1010" value="1000">
                    <span class="form-count__btn form-count__btn-plus"></span>
                </div>
            </td>
            <td>
                <span class="label-mobile">Цена за шт</span>
                150 000 руб
            </td>
            <td>
                <span class="label-mobile">Общий вес</span>
                3000 кг
            </td>
            <td>
                <span class="label-mobile">Сумма</span>
                100 150 000 руб
            </td>
            <td>
                <span class="label-mobile"></span>
                <div class="basket-table__del">Удалить</div>
            </td>
        </tr>
    </table>

    <div class="basket-form-wrap">
        <div class="tabs-wrap">
            <div class="tabs">
                <span data-id="tab1" class="tab active">Для юридических лиц</span>
                <span data-id="tab2" class="tab">Для физических лиц</span>
            </div>

            <div class="panels">
                <div data-id="tab1" class="panel active">
                    <form action="" method="post" class="basket-form">
                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">УНП</div>
                            </div>
                            <input type="text" name="unp" class="form-field__input">
                            <div class="form-field__info">
                                Если вы уже приобретали товар у Тралс, введите только УНП и ваши остальные данные заполнятся автоматически
                            </div>
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">Наименование организации</div>
                            </div>
                            <input type="text" name="org_name" class="form-field__input">
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">Контактный телефон</div>
                            </div>
                            <input type="text" name="phone" class="form-field__input">
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">E-mail</div>
                            </div>
                            <input type="text" name="email" class="form-field__input">
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">Юридический адрес</div>
                            </div>
                            <textarea name="address" class="form-field__textarea"></textarea>
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">ОКПО</div>
                            </div>
                            <input type="text" name="okpo" class="form-field__input">
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">Расчетный счет (IBA3N)</div>
                            </div>
                            <input type="text" name="iba3n" class="form-field__input">
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">Название банка</div>
                            </div>
                            <input type="text" name="bank_title" class="form-field__input">
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">Адрес банка</div>
                            </div>
                            <input type="text" name="bank_adress" class="form-field__input">
                        </div>

                        <div class="form-field">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">Дополнительная информация</div>
                            </div>
                            <input type="text" name="add_info" class="form-field__input">
                        </div>

                        <div class="form-field-total">
                            <div class="basket-form-price">Итого: <span>115 150 000 руб</span></div>
                            <input type="submit" class="basket-form__submit" value="Оформить заказ">
                        </div>
                    </form>
                </div>
                <div data-id="tab2" class="panel">
                    <form action="" method="post" class="basket-form">
                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">ФИО</div>
                            </div>
                            <input type="text" name="fio" class="form-field__input">
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">E-mail</div>
                            </div>
                            <input type="text" name="mail" class="form-field__input">
                        </div>

                        <div class="form-field js_required">
                            <div class="form-field-title-wrap">
                                <div class="form-field__title">Контактный телефон</div>
                            </div>
                            <input type="text" name="phone" class="form-field__input">
                        </div>

                        <div class="form-field-total">
                            <div class="basket-form-price">Итого: <span>115 150 000 руб</span></div>
                            <input type="submit" class="basket-form__submit" value="Оформить заказ">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?
$APPLICATION->AddChainItem("Страница 404", "/404.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>