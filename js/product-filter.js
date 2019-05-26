/**
 * Element events js v1.0.0
 * Copyright 2018-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let product_cat_btn_filter  =   $( '.btn-product-cat-filter .btn-item-filter' ),
        product_id_btn_filter   =   $( '.btn-list-product-ids .btn-item-filter-product-id' );

    $( document ).ready( function () {

        filter_product();

        filter_product_ids();

        filter_product_grid_ids();

        filter_product_grid_cat_id();

    });

    function filter_product() {

        product_cat_btn_filter.on( 'click', function () {

            let has_active      =   $(this).hasClass( 'active' );

            if ( has_active === false ) {

                $(this).parent().find('.btn-item-filter').removeClass( 'active' );
                $(this).addClass( 'active' );

                let parent_class            =   $(this).parents( '.element-product-cat' ),
                    parent_data_settings    =   parent_class.data( 'settings' ),
                    product_cat_slider      =   parent_class.find( '.element-product-cat__slider' ),
                    item_col                =   parent_class.find( '.item-col' ),
                    product_cat_id          =   parseInt( $(this).data( 'id' ) ),
                    limit                   =   parseInt( parent_data_settings['limit'] ),
                    order_by                =   parent_data_settings['order_by'],
                    order                   =   parent_data_settings['order'],
                    rows                    =   parent_data_settings['rows'],
                    column                  =   parent_data_settings['column'];

                parent_class.find( '.btn-product-grid-all-cat' ).data( 'grid-cat-id', product_cat_id );

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

                        item_col.addClass('animated fadeOut');

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

    function filter_product_ids() {

        product_id_btn_filter.on( 'click', function () {

            let has_active      =   $(this).hasClass( 'active' );

            if ( has_active === false ) {

                $(this).parent().find('.btn-item-filter-product-id').removeClass( 'active' );
                $(this).addClass( 'active' );

                let parent_class            =   $(this).parents( '.element-product-ids' ),
                    parent_data_settings    =   parent_class.data( 'settings' ),
                    product_ids_slider      =   parent_class.find( '.element-product-ids__slider' ),
                    item_col                =   parent_class.find( '.item-col' ),
                    order                   =   parent_data_settings['order'],
                    column                  =   parent_data_settings['column'],
                    product_ids             =   $(this).data( 'ids' );

                parent_class.find( '.btn-product-grid-all-ids' ).data( 'grid-ids', product_ids );

                $.ajax({

                    url: sport_products_filter_load.url,
                    type: 'POST',
                    data: ({

                        action: 'sport_product_filter_id',
                        product_ids: product_ids,
                        order: order,
                        column: column

                    }),

                    beforeSend: function () {

                        item_col.addClass('animated fadeOut');

                    },

                    success: function( data ) {

                        if ( data ) {

                            product_ids_slider.trigger('replace.owl.carousel', data).trigger('refresh.owl.carousel');

                        }

                    }

                });

            }

        } )

    }
    
    function filter_product_grid_ids() {

        $( '.btn-product-grid-all-ids' ).on( 'click', function () {

            let parent_class            =   $(this).parents( '.element-products' ),
                parent_data_settings    =   parent_class.data( 'settings' ),
                product_ids_slider      =   parent_class.find( '.element-product-ids__slider' ),
                item_col                =   parent_class.find( '.item-col' ),
                product_grid_ids        =   $(this).data( 'grid-ids' ),
                order                   =   parent_data_settings['order'],
                column                  =   parent_data_settings['column'];

            $.ajax({

                url: sport_products_filter_load.url,
                type: 'POST',
                data: ({

                    action: 'sport_product_style_grid_ids',
                    product_ids: product_grid_ids,
                    order: order,
                    column: column

                }),

                beforeSend: function () {

                    item_col.addClass('animated fadeOut');

                },

                success: function( data ) {

                    if ( data ) {

                        product_ids_slider.trigger('replace.owl.carousel', data).trigger('refresh.owl.carousel');

                    }

                }

            });

        } )

    }

    function filter_product_grid_cat_id() {

        $( '.btn-product-grid-all-cat' ).on( 'click', function () {

            let parent_class            =   $(this).parents( '.element-product-cat' ),
                parent_data_settings    =   parent_class.data( 'settings' ),
                product_cat_id_slider   =   parent_class.find( '.element-product-cat__slider' ),
                item_col                =   parent_class.find( '.item-col' ),
                product_grid_cat_id     =   $(this).data( 'grid-cat-id' ),
                limit                   =   parseInt( parent_data_settings['limit'] ),
                order_by                =   parent_data_settings['order_by'],
                order                   =   parent_data_settings['order'],
                column                  =   parent_data_settings['column'];

            $.ajax({

                url: sport_products_filter_load.url,
                type: 'POST',
                data: ({

                    action: 'sport_product_style_grid_cat',
                    product_cat_id: product_grid_cat_id,
                    limit: limit,
                    order_by: order_by,
                    order: order,
                    column: column

                }),

                beforeSend: function () {

                    item_col.addClass('animated fadeOut');

                },

                success: function( data ) {

                    if ( data ) {

                        product_cat_id_slider.trigger('replace.owl.carousel', data).trigger('refresh.owl.carousel');

                    }

                }

            });

        } )

    }

} )( jQuery );