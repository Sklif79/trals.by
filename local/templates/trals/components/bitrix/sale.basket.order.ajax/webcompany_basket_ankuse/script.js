(function (window) {
    $(document).ready(function () {

        /* Без выбора чекбокса цену не показываем, а при выборе и смене чекбокса меняем цену за шт*/
        $(document).find("span[id='tab1']").css('display', 'none');
        $(document).find("span[id='tab2']").css('display', 'none');

        /* Функция принимает 2 аргумента, первый показывает, второй скрывает */
        function hideOneOfPrice(tab1, tab2) {
            $(document).find(`span[id=${tab1}]`).css('display', 'block').attr('data-current-price', 'current-price');
            $(document).find(`span[id=${tab2}`).css('display', 'none').attr('data-current-price', '');
        }

        $('.entity-type__radio').on('click', function () {
            /*показываем цену за шт и сумму у строки (товара)*/
            var tab = $($('.tab[data-id="' + $(this).data('id') + '"]').get(0)).data('id');
            var showPriceForOne = $('span[id="' + tab + '"]');
            if( tab === 'tab1') {
                showPriceForOne.each((i, e) => {
                    hideOneOfPrice('tab1', 'tab2');
                    sumOneItem(e)
                })
            } else {
                showPriceForOne.each((i, e) => {
                    hideOneOfPrice('tab2', 'tab1');
                    sumOneItem(e)
                })
            }
            setItogoPrice();
        });



        // функция принимает элемент и устанавливает цену для этого элемента.
        function sumOneItem (e) {
            var priceforItem = Number($(e).data('price-oneitem'));
            var quantity = Number($(e).closest("tr").find('input').val());
            var sum = priceforItem * quantity;
            $(e).closest('tr').find('.sumOneItem').text(Number(sum).toFixed(2));
        }

        // при клике на кнопки плюс и минус узнаем стоимость товара умножением.
        $(document).on('click', '.form-count__btn', function () {
            var $input = $(this).parent().find('.form-count__value'),
                val = parseInt($input.val()),
                weight = $(this).closest('tr').find('.weightOneProduct').data('weight'),
                checkTab = $("input:checked").data('id'),
                showPriceForOne = $('span[id="' + checkTab + '"]'),
                pr = $(this).closest('tr').find(showPriceForOne).data('price-oneitem'),
                sumValPer = val * pr;
            $(this).closest('tr').find('.sumOneItem').text(sumValPer.toFixed(2));
            var weightFixed =  val*weight;
            $(this).closest('tr').find('.weightOneProduct').text(weightFixed.toFixed(2));

            // обновляем кол-во заказа в корзине.
            var input = $(this).closest('.form-count').find('.form-count__value');
            var input_val = input.val();
            var product_id = input.data('id');
            var url = window.location.origin+'/ajax/updateBasket.php';
            data = {quantity: input_val, id: product_id};
            $.ajax({
                url: url,
                data: data,
                success: function (response) {
                    console.log(JSON.parse(response));
                },
                error: function (error) {
                    console.log(error);
                }
            });
            setItogoPrice();
            return false;
        });

        function setItogoPrice() {
            var sumItog = [];
            $('.sumOneItem').each((i, e) => {
                sumItog.push(e.innerHTML);
            });
            var sumStatic = 0;
            for(let i=0;i<sumItog.length;i++){
                sumStatic += Number(sumItog[i]);
            }
            var sumItogo =  Number(sumStatic.toFixed(2));
            $('.basket-form-price>span:nth-child(1)').text(sumItogo);
            // console.log($($('.basket-form-price>span:nth-child(1)').eq(0)[0]).text());
        }

        // удаляем товар из корзины.
        $('.basket-table__del').click(function () {
            var id = $(this).data('id');
            var quantity = 0;
            var url = window.location.origin+'/ajax/deleteItemFromBasket.php';
            data = {quantity: quantity, id: id};
            $.ajax({
                url: url,
                data: data,
                success: function (response) {
                    var resp = JSON.parse(response);
                    var lastRemove = $(`tr[data-id]`);
                    var trremove = $(`[data-id=${resp.id}]`);
                    console.log(lastRemove.length);
                    if(lastRemove.length === 1) {
                        $('.basket-page').remove();
                        $('.appendIfBasketEmpty').append('<p>"К сожалению, ваша корзина пуста !"</p>');
                    }
                    trremove.remove();

                    var urltocount = window.location.origin+'/ajax/countProductsInBasket.php';
                    $.ajax({
                        url: urltocount,
                        data: data,
                        success: function (response) {
                            var resp = JSON.parse(response);
                            if($('.header__basket-value_no_red').hasClass('header__basket-value_no_red')) {
                                $('.header__basket-value_no_red').wrap("<div class='wraper_bck'></div>");
                                $('.header__basket-value_no_red').removeClass('header__basket-value_no_red').addClass('header__basket-value');
                                $('.header__basket-value').text(resp.length);
                                $(".wraper_bck").before('Корзина');
                            } else {
                                $('.header__basket-value').text(resp.length);
                            }

                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
            return false;
        });


        // добавляем элемент в инфоблок при клике на кнопку оформить заказ.
        $('.basket-form__submit').click(function () {
            var url = window.location.origin+'/ajax/addElement2Infoblock.php';
            var unp = $('input[name="unp"]').val();
            var company_name = $('input[name="org_name"]').val();
            var contact_phone = $('input[name="phone"]').val();
            var email = $('input[name="email"]').val();
            var ur_adress = $('textarea[name="address"]').val();
            var okpo = $('input[name="okpo"]').val();
            var iba3n = $('input[name="iba3n"]').val();
            var bank_name = $('input[name="bank_title"]').val();
            var bank_adress = $('input[name="bank_adress"]').val();
            var more_info = $('input[name="add_info"]').val();

            // для физ.
            var fio = $('input[name="fio"]').val();
            var fiz_phone = $('input[name="fiz_phone"]').val();
            var mail = $('input[name="mail"]').val();
            var fiz_adress = $('input[name="fiz-adress"]').val();


            data = {
                unp: unp,
                company_name: company_name,
                contact_phone: contact_phone,
                email: email,
                ur_adress: ur_adress,
                okpo: okpo,
                iba3n: iba3n,
                bank_name: bank_name,
                bank_adress: bank_adress,
                more_info: more_info,
                fio: fio,
                fiz_phone: fiz_phone,
                mail: mail,
                fiz_adress: fiz_adress
            };
            // добавляем заказ в систему ЗАКАЗЫ, в случае успешного добавления удаляем все товары из корзины.
            // вызываем вызов успшеного заказа -> orderSubmit.
            $.ajax({
                url: url,
                data: data,
                success: function (response) {
                    var url2 = window.location.origin+'/ajax/addOrder2System.php';
                    var person_type_id = $("input:checked").data('person-type-id');
                    var userId = $("input:checked").data('user-id');
                    var sum = $($('.basket-form-price>span:nth-child(1)').eq(0)[0]).text();
                    // todo: добаить price
                    var data2 = {
                        personTypeId:person_type_id,
                        userId: userId,
                        sum: sum,
                        unp: unp,
                        company_name: company_name,
                        contact_phone: contact_phone,
                        email: email,
                        ur_adress: ur_adress,
                        okpo: okpo,
                        iba3n: iba3n,
                        bank_name: bank_name,
                        bank_adress: bank_adress,
                        more_info: more_info,
                        fio: fio,
                        fiz_phone: fiz_phone,
                        mail: mail,
                        fiz_adress: fiz_adress
                    };
                    $.ajax({
                        url: url2,
                        data: data2,
                        success: function (response) {
                            console.log(response);
                            var url3 = window.location.origin+'/ajax/deleteAllFromBasket.php';
                            $.ajax({
                                url: url3,
                                success: function (response) {
                                    console.log(response);
                                },
                                error: function (e) {
                                    console.log(e);
                                }
                            });
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });

                    orderSubmit();
                },
                error: function (error) {
                    console.log(error);
                }
            });
            //return false;
        });


        // делаем автозаполнение из базы всех полей для юр. лиц.
        var dataFromBack = {};
        $('input[name="unp"]').on('keyup', function (e) {
            var url = window.location.origin+'/ajax/findUnpInSystem.php';
            $.ajax({
                url: url,
                data: {data: e.target.value},
                success: function (response) {
                    var resp = JSON.parse(response);
                    dataFromBack = resp;
                    if(resp !== null) {
                        $('.add_all_info').css('display', 'block');
                        var company_name = dataFromBack.COMPANY_NAME,
                            contact_phone = dataFromBack.CONTACT_PHONE,
                            email = dataFromBack.EMAIL,
                            ur_adress = dataFromBack.UR_ADRESS,
                            okpo = dataFromBack.OKPO,
                            iba3n = dataFromBack.IBA3N,
                            bank_name = dataFromBack.BANK_NAME,
                            bank_adress = dataFromBack.BANK_ADRESS,
                            more_info = dataFromBack.MORE_INFO;
                        $('input[name="org_name"]').val(company_name);
                        $('input[name="phone"]').val(contact_phone);
                        $('input[name="email"]').val(email);
                        $('textarea[name="address"]').val(ur_adress);
                        $('input[name="okpo"]').val(okpo);
                        $('input[name="iba3n"]').val(iba3n);
                        $('input[name="bank_title"]').val(bank_name);
                        $('input[name="bank_adress"]').val(bank_adress);
                        $('input[name="add_info"]').val(more_info);
                    } else {
                        $('.add_all_info').css('display', 'none');
                        $('input[name="org_name"]').val('');
                        $('input[name="phone"]').val('');
                        $('input[name="email"]').val('');
                        $('textarea[name="address"]').val('');
                        $('input[name="okpo"]').val('');
                        $('input[name="iba3n"]').val('');
                        $('input[name="bank_title"]').val('');
                        $('input[name="bank_adress"]').val('');
                        $('input[name="add_info"]').val('');
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
            return false;
        });


    });
})(window);
