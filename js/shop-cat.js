/**
 * shop cat js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let site_shop               =   $( '.site-shop' ),
        product_cat_id          =   site_shop.data( 'product-cat' ),
        order_by                =   site_shop.data( 'orderby' ),
        site_shop_product       =   $( '.site-shop__product' ),
        btn_product_pagination  =   $( '.btn-product-pagination' );

    $( '.product_brand_check' ).on( 'click', function () {

        let brands     =   [];

        $.each( $('input[data-filter="product_brand"]:checked'), function () {

            brands.push($(this).val());

        });

        $.ajax({

            url: load_product_cat.url,
            type: 'POST',
            data: ({

                action: 'sport_check_box_product_cat',
                product_cat_id: product_cat_id,
                order_by: order_by,
                brand_ids: brands,

            }),

            beforeSend: function () {
                // site_shop_product.find( 'ul.products' ).addClass( 'product-opacity' );
            },

            success: function( data ){

                if ( data ){

                    $( '.site-shop__product ul.products' ).append( data );

                }

                setTimeout( function() {

                    // site_shop_product.find( 'ul.products li.product' ).removeClass( 'popIn' );

                }, 800 );

            }

        });


    } );

    $( 'body' ).on( 'click', '.btn-load-product', function () {

        let $this           =   $(this),
            pagination      =   parseInt( $(this).data( 'pagination' ) ),
            limit           =   parseInt( $(this).data( 'limit' ) ),
            total_remaining =   parseInt( $(this).find( '.total-product-remaining' ).text() );

        $.ajax({

            url: load_product_cat.url,
            type: 'POST',
            data: ({

                action: 'sport_pagination_product',
                pagination: pagination,
                order_by: order_by,
                limit: limit,
                product_cat_id: product_cat_id,

            }),

            beforeSend: function () {
                btn_product_pagination.find( '.filter-loader').addClass( 'loader-show' );
            },

            success: function( data ) {

                if ( data ) {

                    let btn_load_product        =   $( '.btn-load-product' ),
                        total_remaining_product =   total_remaining - limit;

                    btn_product_pagination.find( '.filter-loader').removeClass( 'loader-show' );

                    $( '.site-shop__product ul.products' ).append( data );

                    if ( total_remaining_product > 0 ) {

                        let pagination_product_plus =   pagination + 1;

                        btn_load_product.data( {'pagination': pagination_product_plus} ).find( '.total-product-remaining' ).text(total_remaining_product);

                    }else {

                        btn_product_pagination.remove();

                    }

                }

                setTimeout( function() {

                    // site_shop_product.find( 'ul.products li.product' ).removeClass( 'popIn' );

                }, 800 );

            }

        });

    } );

    $( '.load-more-filter-product' ).on( 'click', function () {

        let widget_filter = $(this).parents('.widget').find( '.widget-filter-product-term__item:hidden' );

        widget_filter.slice(0, 7).slideDown();

        if ( widget_filter.length === 0 ) {
            $(this).fadeOut('slow');
        }

    } )

} )( jQuery );