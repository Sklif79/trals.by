<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Корзина");
?>
<a href="javascript:void(0)" class="clickDelFromBasket">УДАЛИТЬ ВСЕ ТОВАРЫ ИЗ КОРЗИНЫ !</a>
<script>
    $('.clickDelFromBasket').click(function () {
        var url = '/ajax/deleteAllFromBasket.php';
        $.ajax({
            url: url,
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        })
    });
</script>
<?
$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
  array(
	"NAME" => "ASC",
	"ID" => "ASC"
  ),
  array(
	"FUSER_ID" => CSaleBasket::GetBasketUserID(),
	"LID" => SITE_ID,
	"ORDER_ID" => "NULL"
  ),
  false,
  false,
  array("*")
);
$i=0;
while ($arItems = $dbBasketItems->Fetch())
{
	$arItems = CSaleBasket::GetByID($arItems["ID"]);
	$db_props = CIBlockElement::GetProperty(1, $arItems["PRODUCT_ID"], array("sort" => "asc"), Array('ID' => Array(13, 24)));
	$res = CIBlockElement::GetByID($arItems["PRODUCT_ID"]);

	$arBasketItems[] = $arItems;
	if($obRes = $res->GetNextElement()) {
		$ar_res = $obRes->GetFields();
		$arBasketItems[$i]['FIELDS'] = $ar_res;
	}

	while($ar_props = $db_props->Fetch()) {
		$arBasketItems[$i]['PROPERTY'][] =  $ar_props;
	}
	$i++;
}
//debug($arBasketItems);
/*foreach ($arBasketItems as $arItem) {
	debug($arItem);
	$file = CFile::ResizeImageGet($arItem['PROPERTY'][0]['VALUE'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	debug($file);
	echo $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';
	echo '<br>';
	echo $arItem['NAME'];
	echo '<br>';
	echo $arItem['PROPERTY'][1]['VALUE'];
	echo '<br>';
	echo $arItem['WEIGHT'];
}*/
?>
<div class="basket-page">
    <div class="basket-warning-wrap">
        <div class="basket-warning">
            Окончательная сумма будет рассчитана нашими менеджерами в зависимости от объема заказа.<br>
            Сумма может быть изменена нашими менеджерами только в сторону уменьшения!
        </div>
        <a href="/" class="back-catalog-btn">Вернуться к покупкам</a>
    </div>

    <div class="entity-type">
        <div class="entity-type__info">Выбрать тип плательщика для расчета окончательной цены:</div>
        <div>
            <label class="radio entity-type__field">
                <input type="radio" name="entity" class="entity-type__radio" data-id="tab1">
                <span>Юридическое лицо</span>
            </label>
        </div>

        <div>
            <label class="radio entity-type__field">
                <input type="radio" name="entity" class="entity-type__radio"  data-id="tab2">
                <span>Физическое лицо</span>
            </label>
        </div>
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
		<?foreach ($arBasketItems as $arItem) {?>
<!--			debug($arItem);-->
			<?$file = CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE'], array('width'=>130, 'height'=>130), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
<!--			debug($file);-->
<!--			echo $img = '<img src="'.$file['src'].'" width="'.$file['width'].'" height="'.$file['height'].'" />';-->
<!--			echo '<br>';-->
<!--			echo $arItem['NAME'];-->
<!--			echo '<br>';-->
<!--			echo $arItem['PROPERTY'][1]['VALUE'];-->
<!--			echo '<br>';-->
<!--			echo $arItem['WEIGHT'];-->
			<tr>
				<td>
					<img src="<?=$file['src']?>">
				</td>
				<td>
					<div class="basket-table__title"><?=$arItem['NAME']?></div>
					<div class="basket-table__sku"><span class="label-sku"> Артикул:</span> 6546746546</div>
				</td>
				<td>
					<span class="label-mobile"><?=$arItem['PROPERTY'][0]['NAME']?>:</span><?=$arItem['PROPERTY'][0]['VALUE']?>
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
					<?=$arItem['WEIGHT']?> кг
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
		<?}?>

<!--
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
-->
    </table>

    <div class="basket-form-wrap">
        <div class="tabs-wrap">
            <div class="tabs">
                <span data-id="tab1" class="tab">Для юридических лиц</span>
                <span data-id="tab2" class="tab">Для физических лиц</span>
            </div>

            <div class="panels">
                <div data-id="tab1" class="panel">
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
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>
