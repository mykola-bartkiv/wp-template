$ = jQuery;
$(document).ready(function () {
    var width = document.body.clientWidth;

    $('.menu-burger').click(function () {
        $(this).toggleClass('open');
        $('.mobile-main-menu').toggleClass('open');
    });

    $('<span class="fa fa-angle-right"></span>').insertAfter($(".mobile-main-menu .menu-item-has-children > a"));
    $(".mobile-main-menu .menu-item-has-children span").click(function () {
        $(this).next().slideToggle();
        $(this).toggleClass("fa-rotate-90");
        return false;
    });

    //WPCF7
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

    //find empty paragraphs
    /*$('p').each(function() {
        var t = $(this);
        if(t.html().replace(/\s|&nbsp;/g, '').length === 0) { t.addClass('jEmpty'); }
    });*/
    
    $('img.img_svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        $.get(imgURL, function(data) {
            var $svg = jQuery(data).find('svg');

            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }


            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            $svg = $svg.removeAttr('xmlns:a');

            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            $img.replaceWith($svg);

        }, 'xml');

    });

});

$(window).on('load', function () {
    /*var swiper = new Swiper('.swiper-container', {
       spaceBetween: 30,
       pagination: {
       el: '.swiper-pagination',
       type: 'bullets',
       clickable: 'true',
     },
     navigation: {
       nextEl: '.custom-next',
       prevEl: '.custom-prev',
     },
   });*/
});
