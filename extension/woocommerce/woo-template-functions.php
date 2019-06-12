<?php

/**
 * General functions used to integrate this theme with WooCommerce.
 */

add_action( 'after_setup_theme', 'sport_shop_setup' );

function sport_shop_setup() {

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/* Remove description heading */
add_filter( 'woocommerce_product_description_heading', '__return_null' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );

/* Start limit product */
add_filter('loop_shop_per_page', 'sport_show_products_per_page');

function sport_show_products_per_page() {
    global $sport_options;

    $sport_product_limit = $sport_options['sport_product_limit'];

    return $sport_product_limit;

}
/* End limit product */

/* Start Change number or products per row */
add_filter('loop_shop_columns', 'sport_loop_columns_product');

function sport_loop_columns_product() {
    global $sport_options;

    $sport_products_per_row = $sport_options['sport_products_per_row'];

    if ( !empty( $sport_products_per_row ) ) :
        return $sport_products_per_row;
    else:
        return 4;
    endif;

}
/* End Change number or products per row */

add_filter( 'woocommerce_show_page_title', 'sport_woo_show_page_title' );
function sport_woo_show_page_title() {
    return false;
}

/* Start get cart */
if ( ! function_exists( 'sport_get_cart' ) ):

    function sport_get_cart(){

?>

        <div class="cart-box d-flex align-items-center">
            <a class="cart-link" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_html_e('Xem giỏ hàng', 'sport'); ?>"></a>

            <div class="cart-customlocation">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/cart.png' ) ); ?>" alt="cart">

                <span class="number-cart-product">
                    <?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
                </span>
            </div>

            <span class="text-cart-product">
                <?php esc_html_e( 'Giỏ hàng', 'sport' ); ?>
                <br />
                <?php esc_html_e( 'sản phẩm', 'sport' ); ?>
            </span>
        </div>

<?php
    }

endif;

/* To ajaxify your cart viewer */
add_filter( 'woocommerce_add_to_cart_fragments', 'sport_add_to_cart_fragment' );

if ( ! function_exists( 'sport_add_to_cart_fragment' ) ) :

    function sport_add_to_cart_fragment( $sport_fragments ) {

        ob_start();

        do_action( 'sport_get_cart_item' );

        $sport_fragments['.cart-box'] = ob_get_clean();

        return $sport_fragments;

    }

endif;
/* End get cart */

/* Start Sidebar Shop */
if ( ! function_exists( 'sport_woo_get_sidebar' ) ) :

    function sport_woo_get_sidebar() {

        if( is_active_sidebar( 'sport-sidebar-wc' ) ):
    ?>

            <aside class="col-md-3">
                <?php dynamic_sidebar( 'sport-sidebar-wc' ); ?>
            </aside>

    <?php
        endif;
    }

endif;
/* End Sidebar Shop */

/*
* Lay Out Shop
*/

if ( ! function_exists( 'sport_woo_before_main_content' ) ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function sport_woo_before_main_content() {
        global $sport_options;
        $sport_sidebar_woo_position =   $sport_options['sport_sidebar_woo'];

        if ( is_search() ) :

            if ( !empty( $_GET['product_cat_id'] ) ) :
                $sport_get_product_cat_id   =   $_GET['product_cat_id'];
            else:
                $sport_get_product_cat_id   =   0;
            endif;

        else:

            $sport_get_product_cat_id   =   get_queried_object_id();

        endif;

        if ( empty( $_GET ) ) :

            $sport_order_by_product =  '';

        else:

            $sport_order_by_product     =   $_GET['orderby'];

        endif;

    ?>

        <div class="site-shop" data-orderby="<?php echo esc_attr( $sport_order_by_product ); ?>" data-product-cat="<?php echo esc_attr( $sport_get_product_cat_id ); ?>">
            <div class="container">
                <div class="row">

                <?php
                /**
                 * woocommerce_sidebar hook.
                 *
                 * @hooked sport_woo_sidebar - 10
                 */

                if ( $sport_sidebar_woo_position == 'left' && !is_product() ) :
                    do_action( 'sport_woo_sidebar' );
                endif;
                ?>

                    <div class="<?php echo is_active_sidebar( 'sport-sidebar-wc' ) && $sport_sidebar_woo_position != 'hide' && !is_product() ? 'col-md-9' : 'col-md-12'; ?>">

    <?php

    }

endif;

if ( ! function_exists( 'sport_woo_after_main_content' ) ) :
    /**
     * After Content
     * Closes the wrapping divs
     */
    function sport_woo_after_main_content() {
        global $sport_options;
        $sport_sidebar_woo_position = $sport_options['sport_sidebar_woo'];
    ?>

                    </div><!-- .col-md-9 -->

                    <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked sport_woo_sidebar - 10
                     */

                    if ( $sport_sidebar_woo_position == 'right' && !is_product() ) :
                        do_action( 'sport_woo_sidebar' );
                    endif;
                    ?>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .site-shop -->

    <?php

    }

endif;

if ( ! function_exists( 'sport_woo_product_thumbnail_open' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked sport_woo_product_thumbnail_open - 5
     */

    function sport_woo_product_thumbnail_open() {
    ?>
        <div class="site-shop__product--item-image">
    <?php
    }

endif;

if ( ! function_exists( 'sport_woo_product_thumbnail_close' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked sport_woo_product_thumbnail_close - 15
     */

    function sport_woo_product_thumbnail_close() {
    ?>
        </div><!-- .site-shop__product--item-image -->

        <div class="site-shop__product--item-content">
    <?php
    }

endif;

if ( ! function_exists( 'sport_woo_get_product_title' ) ) :
    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked sport_woo_get_product_title - 10
     */

    function sport_woo_get_product_title() {
    ?>
        <h2 class="woocommerce-loop-product__title">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
    <?php
    }
endif;

if ( ! function_exists( 'sport_woo_after_shop_loop_item_title' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked sport_woo_after_shop_loop_item_title - 15
     */
    function sport_woo_after_shop_loop_item_title() {
    ?>
        </div><!-- .site-shop__product--item-content -->
    <?php
    }
endif;

if ( ! function_exists( 'sport_woo_loop_add_to_cart_open' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked sport_woo_loop_add_to_cart_open - 4
     */

    function sport_woo_loop_add_to_cart_open() {
    ?>
        <div class="site-shop__product-add-to-cart">
    <?php
    }

endif;

if ( ! function_exists( 'sport_woo_loop_add_to_cart_close' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked sport_woo_loop_add_to_cart_close - 12
     */

    function sport_woo_loop_add_to_cart_close() {
    ?>
        </div><!-- .site-shop__product-add-to-cart -->
    <?php
    }

endif;

if ( ! function_exists( 'sport_woo_before_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked sport_woo_before_shop_loop_item - 5
     */
    function sport_woo_before_shop_loop_item() {
    ?>

        <div class="site-shop__product--item">

    <?php
    }
endif;

if ( ! function_exists( 'sport_woo_after_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked sport_woo_after_shop_loop_item - 15
     */
    function sport_woo_after_shop_loop_item() {
    ?>

        </div><!-- .site-shop__product--item -->

    <?php
    }
endif;

if ( ! function_exists( 'sport_woo_before_shop_loop_open' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked sport_woo_before_shop_loop_open - 5
     */
    function sport_woo_before_shop_loop_open() {

    ?>

        <div class="site-shop__result-count-ordering d-flex align-items-center justify-content-between">

    <?php
    }

endif;

if ( ! function_exists( 'sport_woo_before_shop_loop_close' ) ) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked sport_woo_before_shop_loop_close - 35
     */
    function sport_woo_before_shop_loop_close() {

    ?>

        </div><!-- .site-shop__result-count-ordering -->

    <?php
    }

endif;

if ( ! function_exists( 'sport_woo_before_shop_loop_product' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked sport_woo_before_shop_loop_product - 35
     */

    function sport_woo_before_shop_loop_product() {
        ?>

        <div class="site-shop__product">

        <?php
    }
endif;

if ( ! function_exists( 'sport_woo_after_shop_loop_product' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked sport_woo_after_shop_loop_product - 15
     */

    function sport_woo_after_shop_loop_product() {
        ?>

        </div><!-- .site-shop__product -->

        <?php
    }
endif;

if ( ! function_exists( 'sport_woo_pagination_ajax' ) ) :

    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked sport_woo_pagination_ajax - 10
     */

    function sport_woo_pagination_ajax() {

        $limit          =   sport_show_products_per_page();
        $total_pages    =   wc_get_loop_prop( 'total_pages' );
        $total_product  =   wc_get_loop_prop( 'total' );

        if ( $total_pages > 1 ) :

            $total_product_remaining  =   $total_product - $limit;
    ?>

        <div class="btn-product-pagination text-center">
            <div class="filter-loader">
                <span class="loader-icon"></span>
            </div>

            <button class="btn-global btn-load-product" data-pagination="2" data-limit="<?php echo esc_attr( $limit ); ?>">
                <?php esc_html_e( 'Xem thêm', 'sport' ); ?>
                &#40;
                <span class="total-product-remaining">
                    <?php echo esc_html( $total_product_remaining ); ?>
                </span>
                &#41;
            </button>
        </div>

    <?php

        endif;
    }

endif;

/*
* Single Shop
*/

if ( ! function_exists( 'sport_woo_before_single_product' ) ) :

    /**
     * Before Content Single  product
     *
     * woocommerce_before_single_product hook.
     *
     * @hooked sport_woo_before_single_product - 5
     */

    function sport_woo_before_single_product() {

    ?>

        <div class="site-shop-single">

    <?php

    }

endif;

if ( ! function_exists( 'sport_woo_after_single_product' ) ) :

    /**
     * After Content Single  product
     *
     * woocommerce_after_single_product hook.
     *
     * @hooked sport_woo_after_single_product - 30
     */

    function sport_woo_after_single_product() {

    ?>

        </div><!-- .site-shop-single -->

    <?php

    }

endif;

if ( !function_exists( 'sport_woo_before_single_product_summary_open_warp' ) ) :

    /**
     * Before single product summary
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_summary_open_warp - 1
     */

    function sport_woo_before_single_product_summary_open_warp() {

    ?>

        <div class="site-shop-single__warp">
            <div class="row">

    <?php

    }

endif;

if ( !function_exists( 'sport_woo_after_single_product_summary_close_warp' ) ) :

    /**
     * After single product summary
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_woo_after_single_product_summary_close_warp - 5
     */

    function sport_woo_after_single_product_summary_close_warp() {

    ?>
            </div><!-- .row -->
        </div><!-- .site-shop-single__warp -->

    <?php

    }

endif;

if ( ! function_exists( 'sport_woo_before_single_product_summary_open' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_summary_open - 5
     */

    function sport_woo_before_single_product_summary_open() {

    ?>
        <div class="col-12 col-md-3">
            <div class="site-shop-single__gallery-box">

    <?php

    }

endif;

if ( ! function_exists( 'sport_woo_before_single_product_summary_close' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_summary_close - 30
     */

    function sport_woo_before_single_product_summary_close() {

    ?>

            </div><!-- .site-shop-single__gallery-box -->
        </div><!-- .col -->

    <?php

    }

endif;

if ( ! function_exists( 'sport_woo_before_single_product_entry_summary_open' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_entry_summary_open - 35
     */

    function sport_woo_before_single_product_entry_summary_open() {

?>
        <div class="col-12 col-md-6">

<?php

    }

endif;

if ( ! function_exists( 'sport_woo_before_single_product_entry_summary_close' ) ) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_entry_summary_close - 2
     */

    function sport_woo_before_single_product_entry_summary_close() {

?>

        </div><!-- .col -->

<?php

    }

endif;

if ( ! function_exists( 'sport_post_type_gallery_product_cate' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_post_type_gallery_product_cate - 3
     */

    function sport_post_type_gallery_product_cate() {

        $product_cate = get_the_terms( get_the_ID(), 'product_cat' );

        $term_values   =   array();

        foreach ( $product_cate as $item ) {

            $term_values[] = get_term_meta( $item->term_id, 'type-gallery', true );

        }

        if ( !empty( $term_values ) ) :

            $gallery_settings  =   [
                'loop'          =>  true,
                'autoplay'      =>  true,
            ];

            $gallery_args = array(
                'post_type'  =>  'gallery',
                'post__in'   =>  $term_values,
            );

            $gallery_query = new \ WP_Query( $gallery_args );

?>
            <div class="col-12 col-md-3">
                <div class="product-gallery-cat-single product-gallery-cate owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $gallery_settings ) ); ?>'>

                    <?php
                    while ( $gallery_query->have_posts() ):
                        $gallery_query->the_post();

                        $sport_gallery_image = get_post_meta( get_the_ID(),'sport_images_gallery', false );

                        foreach ( $sport_gallery_image as $item) :

                            $attachment     =   get_post( $item );
                            $title_gallery  =   $attachment->post_excerpt;
                            $link           =   $attachment->post_content

                            ?>

                            <div class="item-gallery">
                                <h4 class="item-gallery__title text-center">
                                    <?php echo esc_html( $title_gallery ); ?>
                                </h4>

                                <div class="item-gallery__img">
                                    <?php if ( !empty( $link ) ) : ?>

                                        <a class="item-gallery__link" href="<?php echo esc_url( $attachment->post_content ); ?>" title="<?php echo esc_attr( $title_gallery ); ?>"></a>

                                    <?php
                                    endif;

                                    echo wp_kses_post( wp_get_attachment_image( $item, 'full' ) );
                                    ?>

                                </div>
                            </div>

                        <?php
                        endforeach;

                    endwhile;
                    wp_reset_postdata(); ?>

                </div>
            </div>

<?php
        endif;

    }

endif;

if ( ! function_exists( 'sport_related_products' ) ) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_related_products - 20
     */

    function sport_related_products() {

        $product_cat = get_the_terms( get_the_ID(), 'product_cat' );

        if ( !empty( $product_cat ) ) :

            $data_settings  =   [
                'loop'          =>  false,
                'autoplay'      =>  false,
                'nav'           =>  true,
            ];

            $rows_number    =   2;
            $column_number  =   5;
            $number_item    =   $rows_number * $column_number;

            $product_cat_ids = array();

            foreach( $product_cat as $item ) $product_cat_ids[] = $item->term_id;

            $args = array(
                'post_type'         =>  'product',
                'posts_per_page'    =>  12,
                'orderby'           =>  'id',
                'order'             =>  'DESC',
                'tax_query'         =>  array(
                    array(
                        'taxonomy'  =>  'product_cat',
                        'field'     =>  'term_id',
                        'terms'     =>  $product_cat_ids,
                    )
                ),
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) :

    ?>

            <div class="site-single-product-related element-products">
                <h3 class="title text-center">
                    <?php esc_html_e( 'Sản phẩm cùng danh mục', 'sport' ); ?>
                </h3>

                <div class="related-product-slider owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings ) ); ?>'>
                    <?php
                    $i = 1;
                    $total_posts    =   $query->post_count;

                    while ( $query->have_posts() ):
                        $query->the_post();
                        if ( $i % $number_item == 1 ) :
                    ?>

                        <div class="row">

                    <?php endif; ?>

                            <div class="col-12 col-sm-6 col-md-3 column-5 item-col">
                                <?php sport_content_item_product(); ?>
                            </div>

                    <?php if ( $i % $number_item == 0 || $i == $total_posts ) : ?>

                        </div>

                    <?php
                        endif;

                        $i++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

    <?php

            endif;

        endif;

    }

endif;

if ( !function_exists( 'sport_product_new' ) ) :

    /**
     * woocommerce_before_shop_loop_item_title hook.
     *
     * @hooked sport_product_new - 9
     */

    function sport_product_new() {

        $product_new = get_post_meta( get_the_ID(), 'sport_option_product_new', true );

        if ( $product_new == 1 ) :
    ?>

        <span class="product-new">
            <?php esc_html_e( 'New', 'sport' ); ?>
        </span>

    <?php
        endif;

    }

endif;

/* Sale flash percent */
add_filter( 'woocommerce_sale_flash', 'sport_change_displayed_sale_price' );

function sport_change_displayed_sale_price() {

    global $product;
    $max_percentage =   '';

    if ( ! $product->is_on_sale() ) return;

    if ( $product->is_type( 'simple' ) ) {

        $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;

    } elseif ( $product->is_type( 'variable' ) ) {

        $max_percentage = 0;

        foreach ( $product->get_children() as $child_id ) {
            $variation = wc_get_product( $child_id );

            $price = $variation->get_regular_price();
            $sale = $variation->get_sale_price();

            if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;

            if ( $percentage > $max_percentage ) {

                $max_percentage = $percentage;

            }
        }

    }
    if ( $max_percentage > 0 ) echo "<span class='on-sale-percent'>-" . round($max_percentage) . "%</span>";
}

/**
 * Add a custom product data tab
 */
add_filter( 'woocommerce_product_tabs', 'sport_new_product_tab' );
function sport_new_product_tab( $tabs ) {

    // Adds the new tab
    global $sport_options;

    $sport_products_single_tab_guide = $sport_options['sport_products_single_tab_guide'];

    if ( !empty( $sport_products_single_tab_guide ) ) :

        $tabs['shopping_guide'] = array(
            'title' 	=>  esc_html__( 'Hướng dẫn mua hàng', 'sport' ),
            'priority' 	=>  25,
            'callback'  =>  'sport_new_product_tab_content'
        );

    endif;

    return $tabs;

}
function sport_new_product_tab_content() {

    // The new tab content
    global $sport_options;

    $sport_products_single_tab_guide = $sport_options['sport_products_single_tab_guide'];

    echo wp_kses_post( $sport_products_single_tab_guide );

}

if ( !function_exists( 'sport_product_blog' ) ) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_product_blog - 25
     */

    function sport_product_blog() {
        global $sport_options;

        $sport_products_title_blog      =   $sport_options['sport_products_title_blog'];
        $sport_products_check_blog      =   $sport_options['sport_products_check_blog'];
        $sport_product_blog_limit       =   $sport_options['sport_product_blog_limit'];
        $sport_product_blog_order_by    =   $sport_options['sport_product_blog_order_by'];
        $sport_product_blog_order       =   $sport_options['sport_product_blog_order'];

        $data_settings  =   [
            'loop'          =>  false,
            'autoplay'      =>  false,
            'nav'           =>  true,
        ];

        $rows_number    =   2;
        $column_number  =   2;
        $number_item    =   $rows_number * $column_number;

        $cat_post_ids    =   array();

        if ( !empty( $sport_products_check_blog ) ) :

            foreach ( $sport_products_check_blog as $key => $item ):

                if ( $item == 1 ) :

                    $cat_post_ids[] .= $key;

                endif;

            endforeach;

        endif;

        if ( !empty( $cat_post_ids ) ) :


            $args = array(
                'post_type'         =>  'post',
                'cat'               =>  $cat_post_ids,
                'posts_per_page'    =>  $sport_product_blog_limit,
                'orderby'           =>  $sport_product_blog_order_by,
                'order'             =>  $sport_product_blog_order,
            );

        else:

            $args = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $sport_product_blog_limit,
                'orderby'           =>  $sport_product_blog_order_by,
                'order'             =>  $sport_product_blog_order,
            );

        endif;

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :

?>

        <div class="blog-post-product">
            <h3 class="title text-center">
                <?php echo esc_html( $sport_products_title_blog ); ?>
            </h3>

            <div class="blog-product-slider owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings ) ); ?>'>

                    <?php
                    $i = 1;
                    $total_posts    =   $query->post_count;

                    while ( $query->have_posts() ):
                        $query->the_post();

                        if ( $i % $number_item == 1 ) :
                    ?>

                        <div class="row">

                    <?php endif; ?>

                            <div class="col-md-6 item-col">
                                <div class="item d-sm-flex">
                                    <div class="item-thumbnail">
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    </div>

                                    <div class="item-content">
                                        <h3 class="item-title">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>

                                        <p class="item-excerpt">
                                            <?php
                                            if( has_excerpt() ) :
                                                echo wp_trim_words( get_the_excerpt(), 30, '...' );
                                            else:
                                                echo wp_trim_words( get_the_content(), 30, '...' );
                                            endif;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                    <?php if ( $i % $number_item == 0 || $i == $total_posts ) : ?>

                        </div>

                    <?php
                        endif;

                        $i++;
                    endwhile;
                    wp_reset_postdata(); ?>

            </div>
        </div>

<?php

        endif;

    }

endif;