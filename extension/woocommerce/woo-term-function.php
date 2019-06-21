<?php



function sport_select_post_gallery() {

    $args   =   array(
        'post_type' => 'gallery'
    );

    $posts      =   array();
    $post_types =   get_posts( $args );

    foreach ( $post_types as $key => $item ):

        $posts[$item->ID]  =   $item->post_title;

    endforeach;

    return $posts;

}

// Add term page
function shoptheme_product_cat_add_new_meta_field() {
    
?>

    <div class="form-field">
        <label for="type-gallery">
            <?php esc_html_e( 'Gallery', 'shoptheme' ); ?>
        </label>

        <select id="type-gallery" name="type-gallery">
            <option value="0">
                <?php esc_html_e( 'None', 'sport' ); ?>
            </option>

            <?php foreach ( sport_select_post_gallery() as $key => $item ): ?>

                <option value="<?php echo esc_attr( $key ); ?>">
                    <?php echo esc_html( $item ); ?>
                </option>

            <?php endforeach; ?>
        </select>
    </div>

<?php

}
add_action( 'product_cat_add_form_fields', 'shoptheme_product_cat_add_new_meta_field', 10, 2 );

function sport_save_select_gallery( $term_id ){
    if( isset( $_POST['type-gallery'] ) && $_POST['type-gallery'] !== '' ){
        $select_gallery = sanitize_title( $_POST['type-gallery'] );
        add_term_meta( $term_id, 'type-gallery', $select_gallery, true );
    }
}
add_action( 'create_product_cat', 'sport_save_select_gallery', 10, 2 );

// Edit term page
function shoptheme_product_cat_edit_meta_field( $term ) {

    $args   =   array(
        'post_type' => 'gallery'
    );

    $posts      =   array();
    $post_types =   get_posts( $args );

    foreach ( $post_types as $key => $item ):

        $posts[$item->ID]  =   $item->post_title;

    endforeach;

    // get current group
    $feature_group = get_term_meta( $term->term_id, 'type-gallery', true );

?>

    <tr>
        <th>
            <label for="type-gallery">
                <?php esc_html_e( 'Gallery', 'shoptheme' ); ?>
            </label>
        </th>

        <td>
            <div class="form-field form-field__edit-cat">
                <div class="form-field__item">
                    <select id="type-gallery" name="type-gallery">
                        <option value="0">
                            <?php esc_html_e( 'None', 'sport' ); ?>
                        </option>

                        <?php foreach ( sport_select_post_gallery() as $key => $item ): ?>

                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $feature_group, $key ); ?>>
                                <?php echo esc_html( $item ); ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </td>
    </tr>

<?php

}
add_action( 'product_cat_edit_form_fields', 'shoptheme_product_cat_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function sport_update_select_gallery( $term_id ) {

    if( isset( $_POST['type-gallery'] ) &&  $_POST['type-gallery'] !=='' ){
        $select_gallery = sanitize_title( $_POST['type-gallery'] );
        update_term_meta( $term_id, 'type-gallery', $select_gallery );
    }

}
add_action( 'edited_product_cat', 'sport_update_select_gallery', 10, 2 );

/* Product New Columns */
add_filter( 'manage_product_posts_columns', 'product_column_new' );
add_action( 'manage_product_posts_custom_column', 'product_custom_column_new', 10, 2 );

function product_column_new( $defaults ) {

    $defaults['product_new'] = esc_html__( 'New', 'sport' );

    return $defaults;

}

function product_custom_column_new( $column_name, $id ) {

    if( $column_name === 'product_new' ) {

        $value = get_post_meta( $id, 'sport_option_product_new', true );

        if ( $value == 1 ) :
            echo esc_html__( 'Yes', 'sport' );
        else:
            echo esc_html__( 'No', 'sport' );
        endif;

    }

}
function sport_get_product_brand() {

    return $sport_get_product_brand = get_terms( 'product_brand',
        array(
            'hide_empty' => 0
        )
    );

};

/* Get value orderby product  */
function sport_get_orderby_product( $sport_orderby_product_value = '' ) {

    if ( !empty( $sport_orderby_product_value ) ) :

        $sport_orderby_value =  explode( '-', $sport_orderby_product_value );
        $sport_orderby       =  esc_attr( $sport_orderby_value[0] );
        $sport_order         =  ! empty( $sport_orderby_value[1] ) ? $sport_orderby_value[1] : '';

        $sport_product_ordering =   wc()->query->get_catalog_ordering_args( $sport_orderby, $sport_order );

    else:
        $sport_product_ordering =   wc()->query->get_catalog_ordering_args();
    endif;

    $sport_product_orderby         =   $sport_product_ordering['orderby'];
    $sport_product_order           =   $sport_product_ordering['order'] ;
    $sport_product_order_meta_key  =   '';

    if ( isset( $sport_product_ordering['meta_key'] ) ) {
        $sport_product_order_meta_key  =   $sport_product_ordering['meta_key'];
    }

    return array(
        'sport_product_orderby'         =>  $sport_product_orderby,
        'sport_product_order'           =>  $sport_product_order,
        'sport_product_order_meta_key'  =>  $sport_product_order_meta_key
    );

}

/* Product filter tax */
function shoptheme_product_filter_tax( $shoptheme_vendor_ids = '', $shoptheme_product_cat_id = '' ) {

    if ( !empty( $shoptheme_vendor_ids ) && !empty( $shoptheme_collection_ids ) ) :

        $shoptheme_filter_tax_query =   array(
            'relation' => 'AND',

            array(
                'taxonomy'  =>  'product_vendor',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_vendor_ids
            ),

            array(
                'taxonomy'  =>  'product_collections',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_collection_ids
            ),

        );

    elseif ( !empty( $shoptheme_vendor_ids ) && empty( $shoptheme_collection_ids ) ):

        $shoptheme_filter_tax_query =   array(

            array(
                'taxonomy'  =>  'product_vendor',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_vendor_ids
            ),

        );

    elseif( empty( $shoptheme_vendor_ids ) && !empty( $shoptheme_collection_ids ) ):

        $shoptheme_filter_tax_query =   array(

            array(
                'taxonomy'  =>  'product_collections',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_collection_ids
            ),

        );

    elseif( !empty( $shoptheme_product_cat_id ) ) :

        $shoptheme_filter_tax_query =   array(

            array(
                'taxonomy'  =>  'product_cat',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_product_cat_id
            ),

        );

    else:

        $shoptheme_filter_tax_query =   '';

    endif;

    return $shoptheme_filter_tax_query;

}

/*
* Start pagination ajax
*/
add_action( 'wp_ajax_nopriv_sport_pagination_product', 'sport_pagination_product' );
add_action( 'wp_ajax_sport_pagination_product', 'sport_pagination_product' );

function sport_pagination_product() {

    global $product;

    $pagination     =   $_POST['pagination'];
    $order_by       =   $_POST['order_by'];
    $limit          =   $_POST['limit'];
    $product_cat_id =   $_POST['product_cat_id'];

    $sport_product_ordering         =   sport_get_orderby_product( $order_by );
    $sport_product_orderby          =   $sport_product_ordering['sport_product_orderby'];
    $sport_product_order            =   $sport_product_ordering['sport_product_order'];
    $sport_product_order_meta_key   =   $sport_product_ordering['sport_product_order_meta_key'];

    if ( !empty( $product_cat_id ) ) :

        $tax_query  =  array(

            array(
                'taxonomy'  =>  'product_cat',
                'field'     =>  'term_id',
                'terms'     =>  $product_cat_id
            ),

        );

    else:

        $tax_query  =   '';

    endif;

    $args  =   array(
        'post_type'         =>  'product',
        'paged'             =>  $pagination,
        'posts_per_page'    =>  $limit,
        'orderby'           =>  $sport_product_orderby,
        'order'             =>  $sport_product_order,
        'tax_query'         =>  $tax_query
    );

    $query =   new WP_Query( $args );

    if ( $query->have_posts() ) :

        while ( $query->have_posts() ):
            $query->the_post();

            ?>

            <li <?php wc_product_class( 'animated fadeIn', $product ); ?>>
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_product_link_open - 10
                 */
                do_action( 'woocommerce_before_shop_loop_item' );

                /**
                 * Hook: woocommerce_before_shop_loop_item_title.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action( 'woocommerce_before_shop_loop_item_title' );

                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action( 'woocommerce_shop_loop_item_title' );

                /**
                 * Hook: woocommerce_after_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );

                /**
                 * Hook: woocommerce_after_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 5
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item' );
                ?>
            </li>

        <?php

        endwhile;
        wp_reset_postdata();

    endif;

    wp_die();

}

/*
* Start ajax filter product cat
*/
add_action( 'wp_ajax_nopriv_sport_check_box_product_cat', 'sport_check_box_product_cat' );
add_action( 'wp_ajax_sport_check_box_product_cat', 'sport_check_box_product_cat' );

function sport_check_box_product_cat() {

    $limit    =   sport_show_products_per_page();

    $product_cat_id =   $_POST['product_cat_id'];
    $order_by       =   $_POST['order_by'];
    $brand_ids      =   $_POST['brand_ids'];

    $sport_product_ordering         =   sport_get_orderby_product( $order_by );
    $sport_product_orderby          =   $sport_product_ordering['sport_product_orderby'];
    $sport_product_order            =   $sport_product_ordering['sport_product_order'];
    $sport_product_order_meta_key   =   $sport_product_ordering['sport_product_order_meta_key'];

    var_dump( $product_cat_id . '-' . $order_by . '-' . $brand_ids . '-' . $sport_product_orderby . '-' . $sport_product_order . '-' . $sport_product_order_meta_key );

    wp_die();

}

// advanced search functionality
add_action('pre_get_posts', 'advanced_search_query');

function advanced_search_query($query) {

    if($query->is_search()) {

        // category terms search.
        if (isset($_GET['product_cat_id']) && !empty($_GET['product_cat_id'])) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms' => array($_GET['product_cat_id']),
                )
            ));
        }
    }
    return $query;
}

//add_action( 'wp_footer', 'event_conference_font_google_script' );
// allow html in category and taxonomy descriptions
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'pre_link_description', 'wp_filter_kses' );
remove_filter( 'pre_link_notes', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );

add_filter( 'product_cat_edit_form_fields', 'event_conference_edit_cat_description', 10 , 2 );
function event_conference_edit_cat_description( $category ) {
    ?>

    <table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="description">
                    <?php esc_html_e('Description', 'event_conference'); ?>
                </label>
            </th>

            <td>
                <?php
                $settings = array('wpautop' => true, 'media_buttons' => false, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
                wp_editor(html_entity_decode($category->description , ENT_QUOTES, 'UTF-8'), 'description1', $settings);
                ?>
                <br />
                <span class="description">
                    <?php esc_html_e( 'The description is not prominent by default, however some themes may show it.', 'event_conference' ); ?>
                </span>
            </td>
        </tr>
    </table>

    <?php

}