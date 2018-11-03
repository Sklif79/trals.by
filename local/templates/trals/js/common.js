$(document).ready(function() {
	$('.goToBack').on('click',function () {
        goHistoryBack();
        return false;
    });
    function goHistoryBack() {
        history.go(-2);
        setTimeout(window.location.reload.bind(window.location), 250);
    }
    // обнуление при вводе значения всех чекбоксов.
    // $('.aside__filter-field').keyup(function () {
    //     var par = $(this).parent().find('li');
    //     var elem = par.filter((i,item) => {
    //         return $(item).hasClass('filter-el-show');
    //     });
    //     function triggerClick(elem) {
    //         $(elem).each((i, item) => {
    //             $(item).find('input').each((i,res) => {
    //                 $(res).trigger('click');
    //             })
    //         });
    //     }
    //
    //     triggerClick(elem)
    // });

    // Слайдер брендов
  $('.js-brands-slider').owlCarousel({
		stopOnHover : true,
		navigationText: ['',''],
		slideSpeed: 2000,
		navigation : true,
		items : 4,
		itemsDesktop : [1199,3],
		itemsMobile : [479,1],
        autoPlay: true

  });

// Миниатюры товара
$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: true,
	vertical: true,
  centerMode: false,
  focusOnSelect: true
});

//Кнопка "Наверх"
if(document.documentElement.clientWidth <= 480) {
	$("#back_top").hide();
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 700) {
				$('#back_top').fadeIn();
			} else {
				$('#back_top').fadeOut();
			}
		});
			$('#back_top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});
} else {
	$('#back_top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 600);
		return false;
	});
}

// Модальные окна
$(".js-open-modal").fancybox({
	wrapCSS: 'fb-modal-win',
	padding : 0,
	//width: 280,
	//height: 662,
	//fitToView: false,
	//autoSize: false,
	helpers: {
		overlay: {
			locked: false
		}
	}
});
$(".js-img-modal").fancybox({
	wrapCSS: 'fb-modal-win',
	padding : 30,
	helpers: {
		overlay: {
			locked: false
		}
	}
});

// Ползунки параметров
function SliderMinMax(selector,min,max,step,range){
	$(selector).slider({
		min: min,
		max: max,
		step: step,
		values: [min,max],
		range: range,
		stop: function(event, ui) {
			jQuery(this).parent().siblings('.slider-input').children('div').children('input.min').val(jQuery(this).slider("values",0));
			jQuery(this).parent().siblings('.slider-input').children('div').children('input.max').val(jQuery(this).slider("values",1));
		},
		slide: function(event, ui){
			jQuery(this).parent().siblings('.slider-input').children('div').children('input.min').val(jQuery(this).slider("values",0));
			jQuery(this).parent().siblings('.slider-input').children('div').children('input.max').val(jQuery(this).slider("values",1));
		}
	});
};
SliderMinMax('.factory',0.75,4,0.05,true);

// Спойлер для списков фильтра
var maxLi = 10, text = ["Скрыть", "Показать еще"];
$("ul.checkbox").each(function() {
    var li = $(this).find("li");
    if (li.length > maxLi) {
    	$(this).prev('.aside__filter-field').show();
        li = li.slice(maxLi).hide();
        var btn = $("<div>", {
            text: text[1],
            "class": "btn gray see-more",
            click: function() {
                li.stop().slideToggle(500, function() {
                    btn.text(text[+$(this).is(":hidden")])
                })
            }
        }).appendTo(this)
    }
});

// Аккордион
$('.accordion-item').click(function(){
	$(this).siblings('.data').slideToggle();
	$(this).toggleClass('close');
})

// Вызов меню слева
$(".mobile-trigger").click(function() {
	$(".bd-site").toggleClass('mob-nav-open');
	$("body").toggleClass('overflow');
});
$(".mobile-aside__nav__close").click(function() {
	$(".bd-site").toggleClass('mob-nav-open');
	$("body").toggleClass('overflow');
});

/* Контакты справа */
$(".mobile-address-trigger").click(function() {
	$(".bd-site").toggleClass('mob-contact-open');
	$("body").toggleClass('overflow');
});
$(".mobile-aside__contact__close").click(function() {
	$(".bd-site").toggleClass('mob-contact-open');
	$("body").toggleClass('overflow');
});

// Выпадающее мобильное меню
$(".mobile__menu .has-children a").click(function() {
	//$(".has-children ul").slideToggle();
	$(this).next("ul").slideToggle();
});


//выпадайка футера
	if ($(window).width() < 481) {
		$(".footer__menu .has-children a").click(function() {
			$(this).next("ul").slideToggle().toggleClass('active');
		});

		$(document).on('click', function(e){
			if (!$(e.target).closest(".footer__menu .sub-menu").length && !$(e.target).closest(".footer__menu .has-children a").length &&  $(".footer__menu .sub-menu").hasClass('active')) {
				$(".footer__menu .sub-menu").removeClass('active').slideUp();
				e.preventDefault();
			}
		});
	}



// Вызов мобильного фильтра
$(".mobile-filter-trigger").click(function() {
	$(".bd-site").toggleClass('mob-filter-open');
	$("body").toggleClass('overflow');
});

$(".mobile-filter-trigger2").click(function() {
	$(".bd-site").toggleClass('mob-filter-open');
	$("body").toggleClass('overflow');
});

$(".aside__filter__close").click(function() {
	$(".bd-site").toggleClass('mob-filter-open');
	$("body").toggleClass('overflow');
});

// Обрезаем текст для превью статей планшета
function title() {
  var elem, size, text;
  elem = document.getElementsByClassName('prew');
  text = elem.innerHTML;
  size = 180;
  for(var i = 0; i < elem.length; i++) {
    if(elem[i].innerHTML.length > size) {
      text = elem[i].innerHTML.substr(0, size);
    }
    elem[i].innerHTML = text + '...';
  }
}
if(document.documentElement.clientWidth < 1200) {
	title();
}

// Обрезаем текст каталога
function catalogPrew() {
    /*
  var elem, size, text;
  elem = document.getElementsByClassName('catalog-prew');
  text = elem.innerHTML;
  size = 250;
  for(var i = 0; i < elem.length; i++) {
    if(elem[i].innerHTML.length > size) {
      text = elem[i].innerHTML.substr(0, size);
    }
    elem[i].innerHTML = text + '...';
  }
  */
}

    function cropText(item, size) {

        item.each(function () {
            var newsText = $(this).text();
            if(newsText.length > size){
                $(this).text(newsText.slice(0, size) + '...');
            }
        });
    }


if(document.documentElement.clientWidth <= 480) {
	//catalogPrew();
    cropText($('.catalog-prew'), 250);
}


$('input.form-count__submit.toBasket').click(function () {
    if($(this).hasClass('toBasket')){
        var input = $(this).closest('form').find('.form-count__value');
        var btn = $(this);
        console.log(btn);
        var input_val = input.val();
        var product_id = input.data('id');
        var url = window.location.origin+'/ajax/add2Basket.php';
        data = {quantity: input_val, id: product_id};
        console.log(url);
        $.ajax({
            url: url,
            data: data,
            success: function (response) {
                console.log(JSON.parse(response));
                btn.val('Оформить');
                $(document).find(btn).removeClass('toBasket').addClass('toIssue').click(function () {
                    countRabbit();
                });

                // обновляем малую корзину при успешном добавлении товара.
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
    }else {
        countRabbit();
    }
    return false;
});

});