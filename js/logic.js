$ = jQuery;
$(document).ready(function () {
    var width = document.body.clientWidth;

    //====Burger, Mobile Menu====
    $('.menu-burger').on('click', function () {
        $(this).toggleClass('open');
        $('.mobile-main-menu').toggleClass('open');
    });

    $('<span class="fa fa-angle-right"></span>').insertAfter($(".mobile-main-menu .menu-item-has-children > a"));
    $(".mobile-main-menu .menu-item-has-children .fa-angle-right").on('click', function () {
        $(this).next().slideToggle();
        $(this).toggleClass("fa-rotate-90");
        return false;
    });
    //====End Burger, Mobile Menu====

    //====WPCF7====
    $(this).on('click', '.wpcf7-not-valid-tip', function () {
        $(this).prev().trigger('focus');
        $(this).fadeOut(500, function () {
            $(this).remove();
        });
    });

    if (!$(".woocommerce-checkout")[0]) {
        $('select').selectric({
            disableOnMobile: false,
            nativeOnMobile: false,
        });
    }

    $('select.wpcf7-form-control').each(function () {
        $(this).find('option').first().val('');
    });
    //====End WPCF7====

    //====Empty Paragraphs====
    $('p').each(function () {
        var t = $(this);
        if (t.html().replace(/\s|&nbsp;/g, '').length === 0) {
            t.addClass('jEmpty');
        }
    });
    //====End Empty Paragraphs====
    
    //====Search====
    var searchBtn = $('.search-box .search-btn');
    if (searchBtn.length > 0) {
        searchBtn.on('click', function () {
            $(this).parent().find('input').val('');
            $(this).toggleClass('fa-close');
            $(this).parent().find('.search-form').toggleClass('active');
        });
    }
    //====End Search====

    //====IMG to SVG====
    $('img.img_svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        $.get(imgURL, function (data) {
            var $svg = jQuery(data).find('svg');

            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }


            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            $svg = $svg.removeAttr('xmlns:a');

            if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            $img.replaceWith($svg);

        }, 'xml');

    });
    //====End IMG to SVG====
    
    //==== Easy Scroll (button)====
    var btn = $('a.btn');
    if (btn.length) {
        btn.on('click', function (event) {
            var id = $(this).attr('href');
            var isAnchor = id.startsWith('#') && id.length > 1;

            if (isAnchor) {
                event.preventDefault();
                var top = $(id).offset().top;
                $('body,html').animate({scrollTop: top - 50}, 1500);
            }
        });
    }
    //==== End Easy Scroll (button) ====
    
     // var swiper = new Swiper('.swiper-container', {
    //     slidesPerView: 3,
    //     spaceBetween: 30,
    //     slidesPerGroup: 3,
    //     speed: 1000,
    //     pagination: {
    //         el: '.swiper-pagination',
    //         clickable: 'true',
    //     },
    //     navigation: {
    //         nextEl: '.custom-next',
    //         prevEl: '.custom-prev',
    //     },
    //     breakpoints: {
    //         320: {
    //             slidesPerView: 2,
    //             spaceBetween: 20
    //         },
    //         480: {
    //             slidesPerView: 3,
    //             spaceBetween: 30
    //         },
    //         640: {
    //             slidesPerView: 4,
    //             spaceBetween: 40
    //         }
    //     }
    // });
});

$(window).on('load', function () {
});
