/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let timer_clear;

    $( document ).ready( function () {

        /* Start back top */
        $('#back-top').on( 'click', function (e) {

            e.preventDefault();
            $( 'html, body' ).animate( {
                scrollTop: 0
            }, 700 );

        } );
        /* End back top */

        /* btn mobile Start*/
        let $menu_item_has_children =   $( '.site-menu .menu-item-has-children' );

        if ( $menu_item_has_children.length ) {

            $('.site-menu .menu-item-has-children > a').after( "<span class='icon_menu_item_mobile'></span>" );

            let $icon_menu_item_mobile  =   $('.icon_menu_item_mobile');

            $icon_menu_item_mobile.each(function () {

                $(this).on( 'click', function () {

                    $(this).addClass( 'icon_menu_item_mobile_active' );
                    $(this).parents( '.menu-item-has-children' ).siblings().find( '.icon_menu_item_mobile' ).removeClass( 'icon_menu_item_mobile_active' );
                    $(this).parents( '.menu-item-has-children' ).children( '.sub-menu' ).slideDown();
                    $(this).parents( '.menu-item-has-children' ).siblings().find( '.sub-menu' ).slideUp();

                } )

            })

        }
        /* btn mobile End */

        /* Start product select search */
        let text_product_drop_down  =   $( '.product-cat-selector-search' ),
            product_cat_list        =   $( '.product-cat-list .item-product-cat' );

        if ( text_product_drop_down.length ) {

            text_product_drop_down.each( function () {

                $(this).on('show.bs.dropdown', function () {

                    $(this).find( '.product-cat-list' ).niceScroll();

                })

            } )

        }

        if ( product_cat_list.length ) {

            product_cat_list.each( function () {

                $(this).on( 'click', function () {

                    let id_product      =   $(this).data( 'cat-id' ),
                        name_product    =   $(this).text();

                    $(this).parents( '.product-cat-selector-search' ).find( '.text-product' ).text( name_product );
                    $(this).parents( '.search-form-product' ).find( '.product-cat-id' ).attr( 'value', id_product );

                } );

            } )

        }
        /* End product select search */

        /* Start Gallery Single */
        $( document ).general_owlCarousel_item( '.site-post-slides' );
        /* End Gallery Single */

        /* Start Product gallery Cat Single */
        $( document ).general_owlCarousel_item( '.product-gallery-cat-single' );
        /* End Product gallery Cat Single */

        /* Start Product Related */
        $( document ).general_owlCarousel_item( '.related-product-slider' );
        /* End Product Related */

        /* Start Blog Product */
        $( document ).general_owlCarousel_item( '.blog-product-slider' );
        /* End Blog Product */

        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                let num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.qty_button.plus, .qty_button.minus', function() {
            let $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });

        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 500,
            values: [ 75, 300 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    });

    $( window ).on( "load", function() {

        $( '#site-loadding' ).remove();

    });

    $( window ).scroll( function() {

        let scrollTop       =   $(this).scrollTop(),
            class_header    =   $( '.sticky-header' ),
            id_back_top     =   $('#back-top');

        if ( timer_clear ) clearTimeout(timer_clear);

        timer_clear = setTimeout( function() {

            /* Start scroll back top */
            if ( scrollTop > 200 ) {
                id_back_top.addClass('active_top');
            }else {
                id_back_top.removeClass('active_top');
            }
            /* End scroll back top */

        }, 100 );

        if ( class_header.length ) {

            let height_header   =   class_header.height();

            if ( scrollTop > height_header ) {
                class_header.addClass( 'header_fix' );
            } else {
                class_header.removeClass( 'header_fix' );
            }

        }

    });

    /* Start function owlCarouse item */
    $.fn.general_owlCarousel_item = function ( class_item_one ) {

        let class_element_owlCarousel   =   $( class_item_one );

        if ( class_element_owlCarousel.length ) {

            class_element_owlCarousel.each(function(){

                let $settings_slider    =   $(this).data( 'settings' ),
                    $loop_slider        =   false,
                    $autoplay           =   false,
                    $rtl_slider         =   false,
                    $active_dots        =   false,
                    $active_nav         =   false,
                    $auto_height        =   false;

                if ( $settings_slider !== undefined ) {

                    $loop_slider    =   typeof ( $settings_slider['loop'] ) !== "undefined" ? $settings_slider['loop'] : false;
                    $autoplay       =   typeof ( $settings_slider['autoplay'] ) !== "undefined" ? $settings_slider['autoplay']: false;
                    $active_dots    =   typeof ( $settings_slider['dots'] ) !== "undefined" ? $settings_slider['dots'] : false;
                    $active_nav     =   typeof ( $settings_slider['nav'] ) !== "undefined" ?  $settings_slider['nav'] : false;
                    $auto_height    =   typeof ( $settings_slider['autoHeight'] ) !== "undefined" ?  $settings_slider['autoHeight'] : false;

                }

                $( this ).owlCarousel({

                    items:1,
                    loop: $loop_slider,
                    autoplay: $autoplay,
                    rtl: $rtl_slider,
                    autoplaySpeed: 800,
                    navSpeed: 800,
                    dotsSpeed: 800,
                    nav: $active_nav,
                    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                    dots: $active_dots,
                    autoHeight:$auto_height

                });

            });

        }

    };
    /* End function owlCarouse item */

    /* Start function multi owlCarouse */
    $.fn.general_multi_owlCarouse = function ( class_item ) {

        let class_item_owlCarousel   =   $( class_item );

        if ( class_item_owlCarousel.length ) {

            class_item_owlCarousel.each(function(){

                let $settings_slider    =   $(this).data( 'settings' ),
                    $item_number        =   4,
                    $margin_item        =   15,
                    $loop_slider        =   false,
                    $autoplay           =   false,
                    $active_dots        =   false,
                    $active_nav         =   false,
                    $auto_height        =   false,
                    $item_mobile        =   1,
                    $margin_item_mobile =   0,
                    $item_tablet        =   3;

                if ( $settings_slider !== undefined ) {

                    $item_number        =   typeof ( $settings_slider['number_item'] ) !== "undefined" ? parseInt( $settings_slider['number_item'] ) : 4;
                    $margin_item        =   typeof ( $settings_slider['margin_item'] ) !== "undefined" ? parseInt( $settings_slider['margin_item'] ) : 15;
                    $loop_slider        =   typeof ( $settings_slider['loop'] ) !== "undefined" ? $settings_slider['loop'] : false;
                    $autoplay           =   typeof ( $settings_slider['autoplay'] ) !== "undefined" ? $settings_slider['autoplay']: false;
                    $active_dots        =   typeof ( $settings_slider['dots'] ) !== "undefined" ? $settings_slider['dots'] : false;
                    $active_nav         =   typeof ( $settings_slider['nav'] ) !== "undefined" ?  $settings_slider['nav'] : false;
                    $auto_height        =   typeof ( $settings_slider['autoHeight'] ) !== "undefined" ?  $settings_slider['autoHeight'] : false;
                    $item_mobile        =   typeof ( $settings_slider['item_mobile'] ) !== "undefined" ? parseInt( $settings_slider['item_mobile'] ) : 1;
                    $margin_item_mobile =   typeof ( $settings_slider['margin_item_mobile'] ) !== "undefined" ? parseInt( $settings_slider['margin_item_mobile'] ) : 0;
                    $item_tablet        =   typeof ( $settings_slider['item_tablet'] ) !== "undefined" ? parseInt( $settings_slider['item_tablet'] ) : 3;

                }

                $( this ).owlCarousel({

                    loop: $loop_slider,
                    autoplay: $autoplay,
                    margin: $margin_item,
                    nav: $active_nav,
                    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                    dots: $active_dots,
                    rtl: false,
                    autoplaySpeed: 800,
                    navSpeed: 800,
                    dotsSpeed: 800,
                    autoHeight:$auto_height,
                    responsive:{
                        0:{
                            items: $item_mobile,
                            margin: $margin_item_mobile
                        },
                        576:{
                            items:2
                        },
                        768:{
                            items: $item_tablet
                        },
                        1200:{
                            items:$item_number
                        }
                    }

                });

            });

        }

    };
    /* End function multi owlCarouse */

} )( jQuery );

new Mmenu( document.querySelector( '#menu-canvas' ),
    {
        navbar: {
            title: ''
        },
    }
);

document.addEventListener( 'click', ( evnt ) => {
    let anchor = evnt.target.closest( 'a[href^="#/"]' );
    if ( anchor ) {
        evnt.preventDefault();
    }
});
