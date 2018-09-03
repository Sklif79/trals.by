$(document).ready(function () {
//AJAX подгрузка каталога
    $('body').on('click', '.ajax_click_upload', function () {
        var el = $(this);
        var contener = $(el.attr('data-content'));
        var pagen = 'PAGEN_' + el.attr('data-pagen-nav');
        var data_g = {};
        data_g['AJAX_L'] = 'Y';
        data_g[pagen] = el.attr('data-pagen');
        data_g['PAGEN_NAV'] = el.attr('data-pagen-nav');
        $.get(location.href, data_g, function (data) {
            var obj = $(data);
            var obj3 = $('<div>'+data+'</div>');
            contener.append(obj);
            var NavPageCount = obj3.find('input').attr('data-NavPageCount');
            var NavPageNomer = obj3.find('input').attr('data-NavPageNomer');
            if (NavPageCount == NavPageNomer) {
                $('.ajax_click_upload').hide();
            } else {
                NavPageNomer++;
                el.attr('data-pagen', NavPageNomer);
            }
        });
    });

//закрытие фильтра подбора в мобильной версии
    $('.mobile-filter-active .submit').on('click', function () {
        $('.aside__filter__close').trigger('click');
    });
});


//кнопки очистить и подбор в верху фильтра


//фильтр подбора каталога
$(document).ready(function () {

    if($('#ajax-content-product .item').length<29){
        $('.ajax_click_upload').hide();
    }else{
        $('.ajax_click_upload').show();
    }

    if(~location.href.indexOf('SHOWALL_1=1')){
        $('.ajax_click_upload').hide();
    }

    $('body').on('click', '#smartfilter .submit', function () {
        $('#ajax-content-product').css('opacity','0.5');
        var url = $('#smartfilter').attr('action');
        var data = $('#smartfilter').serialize();
        BX.ajax.loadJSON(
            url,
            data,
            function (dt) {
                var urlF = dt.FILTER_AJAX_URL;
                $.get(urlF, {AJAX_L: 'Y'}, function (data) {
                    $('#ajax-content-product').html(data);
                    $('#ajax-content-product').css('opacity','1');
                    history.pushState('', '', urlF);
                    if($('#ajax-content-product .item').length<29){
                        $('.ajax_click_upload').hide();
                    }else{
                        $('.ajax_click_upload').show();
                    }
                });
            },
            function (dt) {
                console.log(dt);
            }
        );
    });

    /* $('body').on('click', '#clear-filter', function (e) {
         e.preventDefault();
         var urlF = $(this).attr('href');
         $('#ajax-content-product').css('opacity','0.5');
         $.get($(this).attr('href'), {AJAX_L: 'Y'}, function (data) {
             $('#ajax-content-product').html(data);
             $('#ajax-content-product').css('opacity','1');
             history.pushState('', '', urlF);
             $('#smartfilter input').prop('checked',false);
             //$('#smartfilter input').val(0);
         });
     });*/

    $('body').on('change', '#smartfilter input', function (e) {
        $('#smartfilter .mob-hidden .submit').trigger('click');
    });

    setZeroBasketValueDesktop();
    counterForm();
    preventEnterSubmit();
    countFormSubmitBtn();
    asideSmartFilter();
    orderSubmit();
    tabs();
});

$(window).resize(function () {
    setZeroBasketValueDesktop();
    tabs();
});

//подпись при нулевом значении в корзине
function setZeroBasketValueDesktop() {
    var basketZeroText = 'Корзина пуста',
        $basketValue = $('.header__basket-value');

    if ($(window).width() > 480 && $basketValue.text() === '0') {
        $basketValue.text(basketZeroText);
    } else if ($(window).width() <= 480 && $basketValue.text() === basketZeroText) {
        $basketValue.text('0');
    }
}

//счетчик
function counterForm() {
    $(document).on('click', '.form-count__btn', function () {
        var $input = $(this).parent().find('.form-count__value'),
            val = parseInt($input.val()),
            maxVal = parseInt($input.data('max-value'));

        if ($(this).hasClass('form-count__btn-minus')) {
            val -= 1;
        } else if ($(this).hasClass('form-count__btn-plus')) {
            val += 1;
        }

        if (val < 0) {
            $input.val(0);
            return;
        } else if (val > maxVal) {
            $input.val(maxVal);
            return;
        }

        $input.val(val);
    });
}

//блокировка действия по вводу
function preventEnterSubmit() {
    $(document).on('keydown', '.form-count__value', function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
}

//кнопка в корзину
function countFormSubmitBtn() {
    $(document).on('mouseenter', '.form-count__submit', function () {
       $(this).val('Оформить');
    });

    $(document).on('mouseleave', '.form-count__submit', function () {
        $(this).val('В корзину');
    });
}

//умный фильтр
function asideSmartFilter() {
    $('.aside__filter-field')
        .change(
            function (e) {
                e.stopPropagation();

                var inputValue = $(this).val(),
                    $list = $(this).next('.checkbox').find('li'),
                    $moreBtn = $(this).closest('.aside__filter__item__var').find('.see-more');

                if (inputValue.trim() !== '') {
                    $moreBtn.addClass('filter-el-hide');
                    $list.removeClass('filter-el-show').addClass('filter-el-hide');
                } else {
                    $moreBtn.removeClass('filter-el-hide');
                    $list.removeClass('filter-el-hide filter-el-show');
                    return;
                }

                $(this).next('.checkbox').find('li').filter(function () {
                    return ~$(this).find('span').text().toLowerCase().indexOf(inputValue.toLowerCase());
                }).addClass('filter-el-show');
            }
        )
        .keyup(function () {
            $(this).change();
        });
}

//отправка формы
function orderSubmit() {
    $(document).on('submit', '.basket-form', function (e) {
        var form_data;

        e.preventDefault();

        if (formOrderValid($(this))) {
            form_data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'http://trals.my-veda.ru/catalog/elementy-pitaniya/',
                data: form_data,

                success: function (response) {
                    var successHTML;

                    if (response) {
                        successHTML = $(
                            '<div class="success-page">' +
                            '<div class="success-image"><img src="/local/templates/trals/images/success.jpg" alt=""></div>' +
                            '<div class="success-info">Ваш заказ успешно создан</div>' +
                            '<div class="success-btn-wrap"><a href="/" class="success-btn">На главную</a></div>' +
                            '</div>'
                        );

                        $('.basket-page').html(successHTML);
                    }
                },

                error: function (jqXHR, exception) {
                    // Our error logic here
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }

                    alert(msg);
                }
            });
        }
    })
}

//валидация формы
function formOrderValid($form) {
    var result = true;

    $('.js_required', $form).each(function () {
        $(this).removeClass('no_valid');

        if ($(this).find('input, textarea').val().trim() === '') {
            $(this).addClass('no_valid');
            result = false;
        }
    });

    return result;
}

//табы

function tabs() {
    if ($(window).width() <= 740) {
        $('.tab').on('click', function () {
            $(this).closest('.tabs-wrap').find('.tab, .panel').removeClass('active');
            $(this).addClass('active').closest('.tabs-wrap')
                .find('div[data-id="' + $(this).attr('data-id') + '"]').addClass('active');
        });

        $('span[data-id="tab1"]').text('Для юр. лиц');
        $('span[data-id="tab2"]').text('Для физ. лиц');
    } else {
        $('.tab').off('click');
        $('span[data-id="tab1"]').text('Для юридических лиц');
        $('span[data-id="tab2"]').text('Для физических лиц');
    }
}