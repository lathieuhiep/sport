/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

(function ($) {

    "use strict";

    let timer_clear;

    $(document).ready(function () {

        /* Start back top */
        $('#back-top').on('click', function (e) {

            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 700);

        });
        /* End back top */

        /* btn mobile Start*/
        let $menu_item_has_children = $('.site-menu .menu-item-has-children');

        if ($menu_item_has_children.length) {

            $('.site-menu .menu-item-has-children > a').after("<span class='icon_menu_item_mobile'></span>");

            let $icon_menu_item_mobile = $('.icon_menu_item_mobile');

            $icon_menu_item_mobile.each(function () {

                $(this).on('click', function () {

                    $(this).addClass('icon_menu_item_mobile_active');
                    $(this).parents('.menu-item-has-children').siblings().find('.icon_menu_item_mobile').removeClass('icon_menu_item_mobile_active');
                    $(this).parents('.menu-item-has-children').children('.sub-menu').slideDown();
                    $(this).parents('.menu-item-has-children').siblings().find('.sub-menu').slideUp();

                })

            })

        }
        /* btn mobile End */

        /* Start product select search */
        let text_product_drop_down = $('.product-cat-selector-search'),
            product_cat_list = $('.product-cat-list .item-product-cat');

        if (text_product_drop_down.length) {

            text_product_drop_down.each(function () {

                $(this).on('show.bs.dropdown', function () {

                    $(this).find('.product-cat-list').niceScroll();

                })

            })

        }

        if (product_cat_list.length) {

            product_cat_list.each(function () {

                $(this).on('click', function () {

                    let id_product = $(this).data('cat-id'),
                        name_product = $(this).text();

                    $(this).parents('.product-cat-selector-search').find('.text-product').text(name_product);
                    $(this).parents('.search-form-product').find('.product-cat-id').attr('value', id_product);

                });

            })

        }
        /* End product select search */

        /* Start icon nav search */
        let search_nav_icon = $('.search-nav .item-icon');

        if (search_nav_icon.length) {

            search_nav_icon.on('click', function () {

                $(this).parent().find('.search-nav__box').toggleClass('is-active');

            })

        }
        /* End icon nav search*/

        /* Start Gallery Single */
        $(document).general_owlCarousel_item('.site-post-slides');
        /* End Gallery Single */

        /* Start Product gallery Cat Single */
        $(document).general_owlCarousel_item('.product-gallery-cat-single');
        /* End Product gallery Cat Single */

        /* Start Product Related */
        $(document).general_owlCarousel_item('.related-product-slider');
        /* End Product Related */

        /* Start Blog Product */
        $(document).general_owlCarousel_item('.blog-product-slider');
        /* End Blog Product */

        if (!String.prototype.getDecimals) {
            String.prototype.getDecimals = function () {
                let num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if (!match) {
                    return 0;
                }
                return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
            }
        }
        // Quantity "plus" and "minus" buttons
        $(document.body).on('click', '.qty_button.plus, .qty_button.minus', function () {
            let $qty = $(this).closest('.quantity').find('.qty'),
                currentVal = parseFloat($qty.val()),
                max = parseFloat($qty.attr('max')),
                min = parseFloat($qty.attr('min')),
                step = $qty.attr('step');

            // Format values
            if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
            if (max === '' || max === 'NaN') max = '';
            if (min === '' || min === 'NaN') min = 0;
            if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

            // Change the value
            if ($(this).is('.plus')) {
                if (max && (currentVal >= max)) {
                    $qty.val(max);
                } else {
                    $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                }
            } else {
                if (min && (currentVal <= min)) {
                    $qty.val(min);
                } else if (currentVal > 0) {
                    $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                }
            }

            // Trigger change event
            $qty.trigger('change');
        });

        /* Start scrollbar description */
        let site_term_description_scroll = $('.scrollbar-box .scrollbar-inner');

        if (site_term_description_scroll.length) {

            site_term_description_scroll.each(function () {

                $(this).scrollbar({
                    scrollStep: 0
                });

            })

        }
        /* End scrollbar description */

        /* Start countdown product sale */
        let countdown_sale_product = $('.site-single-product__countdown-sale');

        if (countdown_sale_product.length) {

            countdown_sale_product.each(function () {
                let finalDate = $(this).data('countdown');

                $(this).countdown(finalDate, function (event) {
                    let $this = $(this).html(event.strftime(''
                        + '<div class="box-count"><span class="text">Ngày</span><span class="number">%D</span></div>'
                        + '<div class="box-count"><span class="text">Giờ</span><span class="number">%H</span></div>'
                        + '<div class="box-count"><span class="text">Phút</span><span class="number">%M</span></div>'
                        + '<div class="box-count"><span class="text">Giây</span><span class="number">%S</span></div>'
                        )
                    );
                });

            })

        }
        /* End countdown product sale */

        /* Start form login register */
        let form_login = $('#form-login'),
            form_register = $('#form-register');

        $('#pop_login, #pop_signup').on('click', function (e) {

            let formToFadeOut = form_register,
                formtoFadeIn = form_login;

            if ($(this).attr('id') === 'pop_signup') {
                formToFadeOut = form_login;
                formtoFadeIn = form_register;
            }

            formToFadeOut.fadeOut(500, function () {
                formtoFadeIn.fadeIn();
            });

            return false;
        });

        // Show the login/signup popup on click
        $('#show_login, #show_signup').on('click', function (e) {

            e.preventDefault();

            if ($(this).attr('id') === 'show_login')
                form_login.fadeIn(500);
            else
                form_register.fadeIn(500);

        });

        // Close popup
        $('.login_overlay, .close').on('click', function () {

            $('#form-login, #form-register').fadeOut(500);

            return false;

        });
        /* Start form login register */

        let wpgs_nav = $('.site-shop-single__gallery-box .wpgs-nav');

        if (wpgs_nav.length) {

            wpgs_nav.parents('.site-shop-single__gallery-box').find('.on-sale-percent').addClass('on-sale-wpgs-nav')

        }

    });

    $(window).on("load", function () {

        $('#site-loadding').remove();

    });

    $(window).scroll(function () {

        let scrollTop = $(this).scrollTop(),
            id_back_top = $('#back-top');

        if (timer_clear) clearTimeout(timer_clear);

        timer_clear = setTimeout(function () {

            /* Start scroll back top */
            if (scrollTop > 200) {
                id_back_top.addClass('active_top');
            } else {
                id_back_top.removeClass('active_top');
            }
            /* End scroll back top */

        }, 100);

        let height_header = $('.header').height(),
            nav_menu = $('.nav-menu');

        if (scrollTop >= height_header) {
            nav_menu.addClass('nav-menu-sticky');
        } else {
            nav_menu.removeClass('nav-menu-sticky');
        }

    });

    /* Start function owlCarouse item */
    $.fn.general_owlCarousel_item = function (class_item_one) {

        let class_element_owlCarousel = $(class_item_one);

        if (class_element_owlCarousel.length) {

            class_element_owlCarousel.each(function () {

                let $settings_slider = $(this).data('settings'),
                    $loop_slider = false,
                    $autoplay = false,
                    $rtl_slider = false,
                    $active_dots = false,
                    $active_nav = false,
                    $auto_height = false;

                if ($settings_slider !== undefined) {

                    $loop_slider = typeof ($settings_slider['loop']) !== "undefined" ? $settings_slider['loop'] : false;
                    $autoplay = typeof ($settings_slider['autoplay']) !== "undefined" ? $settings_slider['autoplay'] : false;
                    $active_dots = typeof ($settings_slider['dots']) !== "undefined" ? $settings_slider['dots'] : false;
                    $active_nav = typeof ($settings_slider['nav']) !== "undefined" ? $settings_slider['nav'] : false;
                    $auto_height = typeof ($settings_slider['autoHeight']) !== "undefined" ? $settings_slider['autoHeight'] : false;

                }

                $(this).owlCarousel({

                    items: 1,
                    loop: $loop_slider,
                    autoplay: $autoplay,
                    rtl: $rtl_slider,
                    autoplaySpeed: 800,
                    navSpeed: 800,
                    dotsSpeed: 800,
                    nav: $active_nav,
                    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                    dots: $active_dots,
                    autoHeight: $auto_height

                });

            });

        }

    };
    /* End function owlCarouse item */

    /* Start function multi owlCarouse */
    $.fn.general_multi_owlCarouse = function (class_item) {

        let class_item_owlCarousel = $(class_item);

        if (class_item_owlCarousel.length) {

            class_item_owlCarousel.each(function () {

                let $settings_slider = $(this).data('settings'),
                    $item_number = 4,
                    $margin_item = 15,
                    $loop_slider = false,
                    $autoplay = false,
                    $active_dots = false,
                    $active_nav = false,
                    $auto_height = false,
                    $item_mobile = 1,
                    $margin_item_mobile = 0,
                    $item_tablet = 3;

                if ($settings_slider !== undefined) {

                    $item_number = typeof ($settings_slider['number_item']) !== "undefined" ? parseInt($settings_slider['number_item']) : 4;
                    $margin_item = typeof ($settings_slider['margin_item']) !== "undefined" ? parseInt($settings_slider['margin_item']) : 15;
                    $loop_slider = typeof ($settings_slider['loop']) !== "undefined" ? $settings_slider['loop'] : false;
                    $autoplay = typeof ($settings_slider['autoplay']) !== "undefined" ? $settings_slider['autoplay'] : false;
                    $active_dots = typeof ($settings_slider['dots']) !== "undefined" ? $settings_slider['dots'] : false;
                    $active_nav = typeof ($settings_slider['nav']) !== "undefined" ? $settings_slider['nav'] : false;
                    $auto_height = typeof ($settings_slider['autoHeight']) !== "undefined" ? $settings_slider['autoHeight'] : false;
                    $item_mobile = typeof ($settings_slider['item_mobile']) !== "undefined" ? parseInt($settings_slider['item_mobile']) : 1;
                    $margin_item_mobile = typeof ($settings_slider['margin_item_mobile']) !== "undefined" ? parseInt($settings_slider['margin_item_mobile']) : 0;
                    $item_tablet = typeof ($settings_slider['item_tablet']) !== "undefined" ? parseInt($settings_slider['item_tablet']) : 3;

                }

                $(this).owlCarousel({

                    loop: $loop_slider,
                    autoplay: $autoplay,
                    margin: $margin_item,
                    nav: $active_nav,
                    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                    dots: $active_dots,
                    rtl: false,
                    autoplaySpeed: 800,
                    navSpeed: 800,
                    dotsSpeed: 800,
                    autoHeight: $auto_height,
                    responsive: {
                        0: {
                            items: $item_mobile,
                            margin: $margin_item_mobile
                        },
                        576: {
                            items: 2
                        },
                        768: {
                            items: $item_tablet
                        },
                        1200: {
                            items: $item_number
                        }
                    }

                });

            });

        }

    };
    /* End function multi owlCarouse */

    let toggleNav = function () {

        let site_canvas = $('.site-canvas'),
            close_canvas = $('.close-canvas');

        if (site_canvas.hasClass('site-canvas--active')) {
            // Nav Close
            site_canvas.removeClass('site-canvas--active');
            close_canvas.removeClass('close-canvas--active');
        } else {
            // Nav Open
            site_canvas.addClass('site-canvas--active');
            close_canvas.addClass('close-canvas--active');
        }
    };

    // Toggle Nav on Click
    $('.toggle-nav, .close-canvas').click(function (event) {
        event.preventDefault();
        toggleNav();
    });

    if ($('#clock').length)         // use this if you are using class to check
    {

        // Set the date we're counting down to
        var countDownDays = $('#clock').data('countdown-day'),
            countDownDate = new Date(countDownDays).getTime();




    // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;


            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("clock").innerHTML = days + "<p>Ngày</p> " + hours + "<p>Giờ</p>"
                + minutes + "<p>Phút</p>" + seconds + "<p>Giây</p>";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("clock").innerHTML = "Hết thời gian khuyến mãi";
            }
        }, 1000);
        // it exists
    }


})(jQuery);