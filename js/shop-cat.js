/**
 * shop cat js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let site_shop           =   $( '.site-shop' ),
        product_cat_id      =   site_shop.data( 'product-cat' ),
        order_by             =   site_shop.data( 'orderby' ),
        site_shop_product   =   $( '.site-shop__product' );

    $( 'body' ).on( 'click', '.btn-load-product', function () {

        let pagination      =   parseInt( $(this).data( 'pagination' ) ),
            limit           =   parseInt( $(this).data( 'limit' ) ),
            total_remaining =   parseInt( $(this).find( '.total-product-remaining' ).text() );

        console.log( pagination + '-' + limit + '-' + total_remaining + '-' + order_by + '-' + product_cat_id );

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
                // site_shop_pagination.find( '.loader-ajax').removeClass( 'loader-hide' );
            },

            success: function( data ) {

                if ( data ) {

                    $( '.site-shop__product ul.products' ).append( data );

                    // let btn_load_product        =   $( '.btn-load-product' ),
                    //     total_remaining_product =   remaining_product - limit_product;
                    //
                    // site_shop_pagination.find( '.loader-ajax').addClass( 'loader-hide' );
                    //
                    // $( '.site-shop__product ul.products' ).append(data);
                    //
                    // if ( total_remaining_product > 0 ) {
                    //
                    //     let pagination_product_plus =   pagination_product + 1;
                    //
                    //     btn_load_product.data( {'pagination': pagination_product_plus, 'remaining-product' :total_remaining_product} ).find( '.total-product-remaining' ).empty().append( '(' + total_remaining_product + ')' );
                    //
                    // }else {
                    //
                    //     site_shop_pagination.remove();
                    //
                    // }

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