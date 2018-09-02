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
});

$(window).resize(function () {
    setZeroBasketValueDesktop();
});

function setZeroBasketValueDesktop() {
    var basketZeroText = 'Корзина пуста',
        $basketValue = $('.header__basket-value');

    if ($(window).width() > 480 && $basketValue.text() === '0') {
        $basketValue.text(basketZeroText);
    } else if ($(window).width() <= 480 && $basketValue.text() === basketZeroText) {
        $basketValue.text('0');
    }
}

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

function preventEnterSubmit() {
    $(document).on('keydown', 'input[type=text]', function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
}

function countFormSubmitBtn() {
    $(document).on('mouseenter', '.form-count__submit', function () {
       $(this).val('Оформить');
    });

    $(document).on('mouseleave', '.form-count__submit', function () {
        $(this).val('В корзину');
    });
}