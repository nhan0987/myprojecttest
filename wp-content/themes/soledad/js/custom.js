jQuery(document).ready(function ($) {

    var swiper_slidershow = new Swiper('.swiper-slidershow', {
        slidesPerView: 1,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });

    var swiper_slidershow = new Swiper('.swiper-brands', {
        slidesPerView: 6,
        loop: true,
        // navigation: {
        //     nextEl: '.swiper-button-next',
        //     prevEl: '.swiper-button-prev',
        // },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
            },
            480: {
                slidesPerView: 2,
            },
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 4,
            },
            1200: {
                slidesPerView: 5,
            }
        }
    });

    var swiper_slidershow = new Swiper('.related-posts-slider', {
        slidesPerView: 5,
        loop: true,
        navigation: {
            nextEl: '.swiper-next',
            prevEl: '.swiper-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        breakpoints: {
            320: { slidesPerView: 2 },
            1280: { slidesPerView: 5 } // Hiển thị 5 cột trên màn hình lớn
        }
    });

});

jQuery(document).ready(function ($) {
    $('.module_toggle_content .title-box').click(function () {
        var hs = $(this).parent().hasClass('active');

        if (!hs) {
            // $('.module_toggle_content').removeClass('active');
            $(this).parent().addClass('active');
        } else {
            $(this).parent().removeClass('active');
        }
    });
});