/**
 * Element events js v1.0.0
 * Copyright 2018-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    var product_cat_btn_filter  =   $( '.btn-product-cat-filter .btn-item-filter' );

    $( document ).ready( function () {

        filter_product();

    });

    function filter_product() {

        product_cat_btn_filter.on( 'click', function () {

            var has_active      =   $(this).hasClass( 'active' );

            if ( has_active === false ) {

                $(this).parent().find('.btn-item-filter').removeClass( 'active' );
                $(this).addClass( 'active' );

                var parent_class            =   $(this).parents( '.element-product-cat' ),
                    parent_data_settings    =   parent_class.data( 'settings' ),
                    product_cat_slider      =   parent_class.find( '.element-product-cat__slider' ),
                    content_product         =   parent_class.find( '.menu-filter__row' ),
                    product_cat_id          =   parseInt( $(this).data( 'id' ) ),
                    limit                   =   parseInt( parent_data_settings['limit'] ),
                    order_by                =   parent_data_settings['order_by'],
                    order                   =   parent_data_settings['order'],
                    rows                    =   parent_data_settings['rows'],
                    column                  =   parent_data_settings['column'];

                $.ajax({

                    url: sport_products_filter_load.url,
                    type: 'POST',
                    data: ({

                        action: 'sport_product_filter',
                        product_cat_id: product_cat_id,
                        limit: limit,
                        order_by: order_by,
                        order: order,
                        rows: rows,
                        column: column

                    }),

                    beforeSend: function () {


                    },

                    success: function( data ) {

                        if ( data ) {

                            product_cat_slider.trigger('replace.owl.carousel', data).trigger('refresh.owl.carousel');

                        }

                    }

                });

            }

        } )

    }

} )( jQuery );