$ = jQuery;
$(document).ready(function () {
    var width = document.body.clientWidth;

    //====Burger, Mobile Menu====
    $('.menu-burger').on('click', function () {
        $(this).toggleClass('open');
        $('.mobile-main-menu').toggleClass('open');
    });

    var subMenuIcon = '<svg class="arrow" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class=""></path></svg>';
    $(subMenuIcon).insertAfter($('.mobile-main-menu .menu-item-has-children > a'));
    $('.mobile-main-menu .menu-item-has-children .arrow').on('click', function () {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
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
    $('img[src$=".svg"]').each(function () {
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        $.get(imgURL, function (data) {
            var $svg = $(data).find('svg');

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

        }, null, 'xml');

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
