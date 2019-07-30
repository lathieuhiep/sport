<?php

/**
 * General functions used to integrate this theme with WooCommerce.
 */

add_action('after_setup_theme', 'sport_shop_setup');

function sport_shop_setup()
{

    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

}

/* Remove description heading */
add_filter('woocommerce_product_description_heading', '__return_null');
add_filter('woocommerce_product_additional_information_heading', '__return_null');

/* Start limit product */
add_filter('loop_shop_per_page', 'sport_show_products_per_page');

function sport_show_products_per_page()
{
    global $sport_options;

    $sport_product_limit = $sport_options['sport_product_limit'];

    return $sport_product_limit;

}

/* End limit product */

/* Start Change number or products per row */
add_filter('loop_shop_columns', 'sport_loop_columns_product');

function sport_loop_columns_product()
{
    global $sport_options;

    $sport_products_per_row = $sport_options['sport_products_per_row'];

    if (!empty($sport_products_per_row)) :
        return $sport_products_per_row;
    else:
        return 4;
    endif;

}

/* End Change number or products per row */

add_filter('woocommerce_show_page_title', 'sport_woo_show_page_title');
function sport_woo_show_page_title()
{
    return false;
}

/* Start get cart */
if (!function_exists('sport_get_cart')):

    function sport_get_cart()
    {

        ?>

        <div class="cart-box d-flex align-items-center">
            <a class="cart-link" href="<?php echo wc_get_cart_url(); ?>"
               title="<?php esc_html_e('Xem giỏ hàng', 'sport'); ?>"></a>

            <div class="cart-customlocation">
                <img src="<?php echo esc_url(get_theme_file_uri('/images/cart.png')); ?>" alt="cart">

                <span class="number-cart-product">
                    <?php echo sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count()), WC()->cart->get_cart_contents_count()); ?>
                </span>
            </div>

            <span class="text-cart-product">
                <?php esc_html_e('Giỏ hàng', 'sport'); ?>
                <br/>
                <?php esc_html_e('sản phẩm', 'sport'); ?>
            </span>
        </div>

        <?php
    }

endif;

/* To ajaxify your cart viewer */
add_filter('woocommerce_add_to_cart_fragments', 'sport_add_to_cart_fragment');

if (!function_exists('sport_add_to_cart_fragment')) :

    function sport_add_to_cart_fragment($sport_fragments)
    {

        ob_start();

        do_action('sport_get_cart_item');

        $sport_fragments['.cart-box'] = ob_get_clean();

        return $sport_fragments;

    }

endif;
/* End get cart */

/* Start breadcrumbs */
if (!function_exists('sport_woo_breadcrumbs')) :

    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked sport_woo_breadcrumbs - 20
     */
    function sport_woo_breadcrumbs()
    {

        get_template_part('template-parts/inc', 'breadcrumbs');

        if (is_product_category()) {
            ?>

            <div class="title-cat-product">
                <h3 class="title">
                    <?php single_term_title(); ?>
                </h3>
            </div>

            <?php
        }

    }

endif;
/* End breadcrumbs */

/* Start archive description */
if (!function_exists('sport_woo_archive_description_open')) :

    function sport_woo_archive_description_open()
    {

        if (is_product_category()) :
            ?>

            <div class="site-term-description-scroll scrollbar-box">
                <div class="scrollbar-inner">
                    <?php
                    woocommerce_taxonomy_archive_description();
                    woocommerce_product_archive_description();
                    ?>
                </div>
            </div>

        <?php

        endif;

    }

endif;
/* End archive description */

/* Start Sidebar Shop */
if (!function_exists('sport_woo_get_sidebar')) :

    function sport_woo_get_sidebar()
    {

        if (is_active_sidebar('sport-sidebar-wc')):
            ?>

            <aside class="col-md-3">
                <?php dynamic_sidebar('sport-sidebar-wc'); ?>
            </aside>

        <?php
        endif;
    }

endif;
/* End Sidebar Shop */

/*
* Lay Out Shop
*/

if (!function_exists('sport_woo_before_main_content')) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function sport_woo_before_main_content()
    {
        global $sport_options;
        $sport_sidebar_woo_position = $sport_options['sport_sidebar_woo'];

        if (is_search()) :

            if (!empty($_GET['product_cat_id'])) :
                $sport_get_product_cat_id = $_GET['product_cat_id'];
            else:
                $sport_get_product_cat_id = 0;
            endif;

        else:

            $sport_get_product_cat_id = get_queried_object_id();

        endif;

        if (empty($_GET['orderby'])) :

            $sport_order_by_product = '';

        else:

            $sport_order_by_product = $_GET['orderby'];

        endif;

        $data_setting_shop_page = [
            'order_by_product' => $sport_order_by_product,
            'product_cat_id' => $sport_get_product_cat_id
        ];

        ?>

        <div class="site-shop" data-settings='<?php echo esc_attr(wp_json_encode($data_setting_shop_page)); ?>'>
        <div class="container">

        <?php
        sport_woo_breadcrumbs();

    sport_woo_archive_description_open()
        ?>

        <div class="row">

        <?php
        /**
         * woocommerce_sidebar hook.
         *
         * @hooked sport_woo_sidebar - 10
         */

        if ($sport_sidebar_woo_position == 'left' && !is_product()) :
            do_action('sport_woo_sidebar');
        endif;
        ?>

        <div class="<?php echo is_active_sidebar('sport-sidebar-wc') && $sport_sidebar_woo_position != 'hide' && !is_product() ? 'col-md-9' : 'col-md-12'; ?>">

        <?php

    }

endif;

if (!function_exists('sport_woo_after_main_content')) :
    /**
     * After Content
     * Closes the wrapping divs
     */
    function sport_woo_after_main_content()
    {
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

        if ($sport_sidebar_woo_position == 'right' && !is_product()) :
            do_action('sport_woo_sidebar');
        endif;
        ?>

        </div><!-- .row -->
        </div><!-- .container -->
        </div><!-- .site-shop -->

        <?php

    }

endif;

if (!function_exists('sport_woo_product_thumbnail_open')) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked sport_woo_product_thumbnail_open - 5
     */

    function sport_woo_product_thumbnail_open()
    {
        ?>
        <div class="site-shop__product--item-image">
        <?php
    }

endif;

if (!function_exists('sport_woo_product_thumbnail_close')) :
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked sport_woo_product_thumbnail_close - 15
     */

    function sport_woo_product_thumbnail_close()
    {
        ?>
        </div><!-- .site-shop__product--item-image -->

        <div class="site-shop__product--item-content">
        <?php
    }

endif;

if (!function_exists('sport_woo_get_product_title')) :
    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked sport_woo_get_product_title - 10
     */

    function sport_woo_get_product_title()
    {
        ?>
        <h2 class="woocommerce-loop-product__title">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <?php
    }
endif;

if (!function_exists('sport_woo_after_shop_loop_item_title')) :
    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked sport_woo_after_shop_loop_item_title - 15
     */
    function sport_woo_after_shop_loop_item_title()
    {
        ?>
        </div><!-- .site-shop__product--item-content -->
        <?php
    }
endif;

if (!function_exists('sport_woo_loop_add_to_cart_open')) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked sport_woo_loop_add_to_cart_open - 4
     */

    function sport_woo_loop_add_to_cart_open()
    {
        ?>
        <div class="site-shop__product-add-to-cart">
        <?php
    }

endif;

if (!function_exists('sport_woo_loop_add_to_cart_close')) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked sport_woo_loop_add_to_cart_close - 12
     */

    function sport_woo_loop_add_to_cart_close()
    {
        ?>
        </div><!-- .site-shop__product-add-to-cart -->
        <?php
    }

endif;

if (!function_exists('sport_woo_before_shop_loop_item')) :
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked sport_woo_before_shop_loop_item - 5
     */
    function sport_woo_before_shop_loop_item()
    {
        ?>

        <div class="site-shop__product--item">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php
    }
endif;

if (!function_exists('sport_woo_after_shop_loop_item')) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked sport_woo_after_shop_loop_item - 15
     */
    function sport_woo_after_shop_loop_item()
    {
        ?>
        </a>
        </div><!-- .site-shop__product--item -->

        <?php
    }
endif;

if (!function_exists('sport_woo_before_shop_loop_open')) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked sport_woo_before_shop_loop_open - 5
     */
    function sport_woo_before_shop_loop_open()
    {

        ?>

        <div class="site-shop__result-count-ordering d-flex align-items-center justify-content-between">

        <?php
    }

endif;

if (!function_exists('sport_woo_before_shop_loop_close')) :
    /**
     * Before Shop Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked sport_woo_before_shop_loop_close - 35
     */
    function sport_woo_before_shop_loop_close()
    {

        ?>

        </div><!-- .site-shop__result-count-ordering -->

        <?php
    }

endif;

if (!function_exists('sport_woo_before_shop_loop_product')) :
    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked sport_woo_before_shop_loop_product - 35
     */

    function sport_woo_before_shop_loop_product()
    {
        ?>

        <div class="site-shop__product">

        <?php
    }
endif;

if (!function_exists('sport_woo_after_shop_loop_product')) :
    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked sport_woo_after_shop_loop_product - 15
     */

    function sport_woo_after_shop_loop_product()
    {
        ?>

        </div><!-- .site-shop__product -->

        <?php
    }
endif;

if (!function_exists('sport_woo_pagination_ajax')) :

    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked sport_woo_pagination_ajax - 10
     */

    function sport_woo_pagination_ajax()
    {

        $limit = sport_show_products_per_page();
        $total_pages = wc_get_loop_prop('total_pages');
        $total_product = wc_get_loop_prop('total');

        if ($total_pages > 1) :

            $total_product_remaining = $total_product - $limit;
            ?>

            <div class="btn-product-pagination text-center">
                <div class="filter-loader">
                    <span class="loader-icon"></span>
                </div>

                <button class="btn-global btn-load-product" data-pagination="2"
                        data-limit="<?php echo esc_attr($limit); ?>">
                    <?php esc_html_e('Xem thêm', 'sport'); ?>
                    &#40;
                    <span class="total-product-remaining">
                    <?php echo esc_html($total_product_remaining); ?>
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

if (!function_exists('sport_woo_before_single_product')) :

    /**
     * Before Content Single  product
     *
     * woocommerce_before_single_product hook.
     *
     * @hooked sport_woo_before_single_product - 5
     */

    function sport_woo_before_single_product()
    {

        ?>

        <div class="site-shop-single">

        <?php

    }

endif;

if (!function_exists('sport_woo_after_single_product')) :

    /**
     * After Content Single  product
     *
     * woocommerce_after_single_product hook.
     *
     * @hooked sport_woo_after_single_product - 30
     */

    function sport_woo_after_single_product()
    {

        ?>

        </div><!-- .site-shop-single -->

        <?php

    }

endif;

if (!function_exists('sport_woo_before_single_product_summary_open_warp')) :

    /**
     * Before single product summary
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_summary_open_warp - 1
     */

    function sport_woo_before_single_product_summary_open_warp()
    {

        ?>

        <div class="site-shop-single__warp">
        <div class="row">

        <?php

    }

endif;

if (!function_exists('sport_woo_after_single_product_summary_close_warp')) :

    /**
     * After single product summary
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_woo_after_single_product_summary_close_warp - 5
     */

    function sport_woo_after_single_product_summary_close_warp()
    {

        ?>
        </div><!-- .row -->
        </div><!-- .site-shop-single__warp -->

        <?php

    }

endif;

if (!function_exists('sport_woo_before_single_product_summary_open')) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_summary_open - 5
     */

    function sport_woo_before_single_product_summary_open()
    {

        ?>
        <div class="col-12 col-md-4">
        <div class="site-shop-single__gallery-box">

        <?php

    }

endif;

if (!function_exists('sport_woo_before_single_product_summary_close')) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_summary_close - 30
     */

    function sport_woo_before_single_product_summary_close()
    {

        ?>

        </div><!-- .site-shop-single__gallery-box -->
        </div><!-- .col -->

        <?php

    }

endif;

if (!function_exists('sport_woo_before_single_product_entry_summary_open')) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_entry_summary_open - 35
     */

    function sport_woo_before_single_product_entry_summary_open()
    {

        ?>
        <div class="col-12 col-md-5">
        <?php

    }

endif;

if (!function_exists('sport_woo_before_single_product_entry_summary_close')) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_woo_before_single_product_entry_summary_close - 2
     */

    function sport_woo_before_single_product_entry_summary_close()
    {

        ?>

        </div><!-- .col -->

        <?php

    }

endif;

if (!function_exists('sport_post_type_gallery_product_cate')) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked sport_post_type_gallery_product_cate - 3
     */

    function sport_post_type_gallery_product_cate()
    {

        $product_cate = get_the_terms(get_the_ID(), 'product_cat');

        $term_values = array();

        foreach ($product_cate as $item) {

            $term_values[] = get_term_meta($item->term_id, 'type-gallery', true);

        }

        if (!empty($term_values)) :

            $gallery_settings = [
                'loop' => true,
                'autoplay' => true,
            ];

            $gallery_args = array(
                'post_type' => 'gallery',
                'post__in' => $term_values,
            );

            $gallery_query = new \ WP_Query($gallery_args);

            ?>
            <div class="col-12 col-md-3">
                <div class="product-gallery-cat-single product-gallery-cate owl-carousel owl-theme"
                     data-settings='<?php echo esc_attr(wp_json_encode($gallery_settings)); ?>'>

                    <?php
                    while ($gallery_query->have_posts()):
                        $gallery_query->the_post();

                        $sport_gallery_image = get_post_meta(get_the_ID(), 'sport_images_gallery', false);

                        foreach ($sport_gallery_image as $item) :

                            $attachment = get_post($item);
                            $title_gallery = $attachment->post_excerpt;
                            $link = $attachment->post_content

                            ?>

                            <div class="item-gallery">

                                <div class="item-gallery__img">
                                    <?php if (!empty($link)) : ?>

                                        <a class="item-gallery__link"
                                           href="<?php echo esc_url($attachment->post_content); ?>"
                                           title="<?php echo esc_attr($title_gallery); ?>"></a>

                                    <?php
                                    endif;

                                    echo wp_kses_post(wp_get_attachment_image($item, 'full'));
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

/* Start query sport related upsells */
function sport_related_upsells_item($args, $number_row, $number_column)
{

    $data_settings = [
        'loop' => false,
        'autoplay' => false,
        'nav' => true,
    ];

    $rows_number = $number_row;
    $column_number = $number_column;
    $number_item = $rows_number * $column_number;

    $query = new WP_Query($args);

    if ($query->have_posts()) :

        ?>

        <div class="related-product-slider owl-carousel owl-theme"
             data-settings='<?php echo esc_attr(wp_json_encode($data_settings)); ?>'>
            <?php
            $i = 1;
            $total_posts = $query->post_count;

            while ($query->have_posts()):
                $query->the_post();

                if ($i % $number_item == 1) :
                    ?>

                    <div class="row row-custom">

                <?php endif; ?>

                <div class="col-12 col-sm-6 col-md-3 col-lg-2 item-col item-col-custom">
                    <?php sport_content_item_product(); ?>
                </div>

                <?php if ($i % $number_item == 0 || $i == $total_posts) : ?>

                </div>

            <?php
            endif;

                $i++;
            endwhile;
            wp_reset_postdata();
            ?>
        </div>

    <?php

    endif;

}

if (!function_exists('sport_upsells_products')) :

    function sport_upsells_products()
    {

        $upsell_ids = get_post_meta(get_the_ID(), '_upsell_ids', true);

        if (!empty($upsell_ids)) :

            $args = array(
                'post_type' => 'product',
                'orderby' => 'rand',
                'order' => 'DESC',
                'post__in' => $upsell_ids
            );

            ?>

            <div class="site-single-product-upsell element-products">
                <h3 class="title title-global-sing-product text-center">
                    <?php esc_html_e('Có thể bạn thích', 'sport'); ?>
                </h3>

                <?php sport_related_upsells_item($args, 1, 6); ?>
            </div>

        <?php

        endif;
    }

endif;

if (!function_exists('sport_related_products')) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_related_products - 20
     */

    function sport_related_products()
    {

        global $sport_options;

        $limit = $sport_options['sport_single_product_related_limit'];
        $order_by = $sport_options['sport_single_product_related_order_by'];
        $order = $sport_options['sport_single_product_related_order'];
        $product_cat = get_the_terms(get_the_ID(), 'product_cat');

        if (!empty($product_cat)) :

            $product_cat_ids = array();

            foreach ($product_cat as $item) $product_cat_ids[] = $item->term_id;

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $limit,
                'orderby' => $order_by,
                'order' => $order,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $product_cat_ids,
                    )
                ),
            );
            ?>

            <div class="site-single-product-related element-products">
                <h3 class="title title-global-sing-product text-center">
                    <?php esc_html_e('Sản phẩm cùng danh mục', 'sport'); ?>
                </h3>

                <?php sport_related_upsells_item($args, 2, 6); ?>
            </div>

        <?php

        endif;

    }

endif;

if (!function_exists('sport_product_new')) :

    /**
     * woocommerce_before_shop_loop_item_title hook.
     *
     * @hooked sport_product_new - 9
     */

    function sport_product_new()
    {

        $product_new = get_post_meta(get_the_ID(), 'sport_option_product_new', true);

        if ($product_new == 1) :
            ?>

            <span class="product-new">
            <?php esc_html_e('New', 'sport'); ?>
        </span>

        <?php
        endif;

    }

endif;

if (!function_exists('sport_product_hot')) :

    /**
     * woocommerce_before_shop_loop_item_title hook.
     *
     * @hooked sport_product_hot - 10
     */

    function sport_product_hot()
    {

        $product_hot = get_post_meta(get_the_ID(), 'sport_option_product_hot', true);

        if ($product_hot == 1) :
            ?>
            <span class="product-hot">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icon_hot.gif" width="65px"
                     alt="<?php echo esc_html__('Sản phẩm Hot', 'sport'); ?>"/>
        </span>

        <?php
        endif;

    }

endif;

if (!function_exists('sport_product_only')) :

    /**
     * woocommerce_before_shop_loop_item_title hook.
     *
     * @hooked sport_product_only - 10
     */

    function sport_product_only()
    {

        $product_only = get_post_meta(get_the_ID(), 'sport_option_product_only', true);
        if ($product_only != '') :
            ?>

            <span class="product-only">

                <marquee scrollamount="5" direction="" onmouseover="this.stop();"
                         onmouseout="this.start();"><?php echo esc_html($product_only); ?></marquee>

            </span>

        <?php
        endif;

    }

endif;

if (!function_exists('sport_product_sale_info')) :

    /**
     * woocommerce_single_product_summary hook.
     *
     * @hooked sport_product_sale_info - 10
     */

    function sport_product_sale_info()
    {

        $product_info = get_post_meta(get_the_ID(), 'sport_option_product_sale_info', true);
        if ($product_info != '') :
            ?>

            <span class="product-sale-info">
            <strong><?php echo esc_html__('Khuyến mãi: ', 'sport'); ?></strong>
                <?php echo esc_html($product_info); ?>
            </span>

        <?php
        endif;

    }

endif;

if (!function_exists('sport_product_origin')) :

    /**
     * woocommerce_single_product_summary hook.
     *
     * @hooked sport_product_origin - 40
     */

    function sport_product_origin()
    {

        $product_origin = get_post_meta(get_the_ID(), 'sport_option_product_origin', true);
        $product_guarantee = get_post_meta(get_the_ID(), 'sport_option_product_guarantee', true);
        if ($product_origin != '' || $product_guarantee != '') :
            ?>
            <div class="xxbh d-flex">
                <?php if ($product_origin != '') : ?>
                <span class="product-origin">
                <strong><?php echo esc_html__('Xuất xứ: ', 'sport'); ?></strong>
                    <?php echo esc_html($product_origin); ?>
                </span>
            <?php
            endif;
            if ($product_guarantee != '') : ?>
                <span class="product-guarantee">
                <strong><?php echo esc_html__('Bảo hành: ', 'sport'); ?></strong>
                    <?php echo esc_html($product_guarantee); ?>
                </span>
            <?php endif; ?>
            </div>

        <?php
        endif;

    }

endif;

if (!function_exists('sport_product_rating')) :

    /**
     * woocommerce_single_product_summary hook.
     *
     * @hooked sport_product_rating - 10
     */

    function sport_product_rating()
    {

        $product_star = get_post_meta(get_the_ID(), 'sport_option_product_fake_star', true);
        $product_evaluate = get_post_meta(get_the_ID(), 'sport_option_product_fake_evaluate', true);
        $evaluate = '';
        if ($product_evaluate != ''):
            $evaluate .= $product_evaluate;
        endif;

        if ($product_star == 4) {
            $product_star_width = 80;
        } elseif ($product_star == 45) {
            $product_star_width = 87.5;
        } elseif ($product_star == 5) {
            $product_star_width = 100;
        } else {
            $product_star_width = '';
        }

        if ($product_star != '') :
            ?>

            <div class="woocommerce-product-rating">
                <div class="star-rating" role="img"
                     aria-label="Được xếp hạng <?php echo esc_attr($product_star); ?>.00 <?php echo esc_attr($product_star); ?> sao"><span
                            style="width:<?php echo esc_attr($product_star_width); ?>%"><strong
                                class="rating"><?php echo esc_attr($product_star); ?>
                            .00</strong> trên <?php echo esc_attr($product_star); ?>
                        dựa trên <span
                                class="rating"><?php echo esc_html($evaluate); ?></span> đánh giá</span></div>
                <p class="woocommerce-review-link">(<span class="count"><?php echo esc_html($evaluate); ?></span> đánh
                    giá)
                </p>
            </div>

        <?php
        endif;

    }

endif;

if (!function_exists('sport_product_fakecomment')) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_product_fakecomment - 25
     */
    function sport_product_fakecomment()
    {
        global $sport_options;
        $sport_fc_amount = $sport_options['sport_single_product_amount'];
        $args = array(
            'post_type' => 'fakecomment',
            'posts_per_page' => $sport_fc_amount,
            'orderby' => 'rand',
        );

        $query = new WP_Query($args);
        echo '<div class="fcomment">';

        echo '<h3>' . esc_html__('Đánh giá của khách hàng', 'sport') . '</h3>';

        echo '<div class="wrap-scroll">';
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();

                $fakecomment_star = rwmb_meta('sport_option_fakecomment_star');
                $fakecomment_date = rwmb_meta('sport_option_fakecomment_date');
                $fakecomment_like = rwmb_meta('sport_option_fakecomment_like');
                ?>

                <div class="item">
                    <div class="title d-flex">
                        <h6><?php the_title(); ?></h6>
                        <p>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/security-checked.png"
                                 width="12px" height="12px" alt="security checked"/>
                            <?php echo esc_html__('Đã mua tại Sport360.vn', 'sport'); ?>
                        </p>
                    </div>
                    <div class="comment">

                        <div class="star <?php echo esc_attr('star-') . esc_attr($fakecomment_star); ?>">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <?php if ($fakecomment_star == 45 || $fakecomment_star == 4 || $fakecomment_star == 5 || $fakecomment_star == 46): ?>
                                <i class="fa fa-star"></i>
                            <?php endif; ?>
                            <?php if ($fakecomment_star == 4): ?>
                                <i class="far fa-star"></i>
                            <?php endif; ?>
                            <?php if ($fakecomment_star == 45): ?>
                                <i class="fas fa-star-half-alt"></i>
                            <?php endif; ?>
                            <?php if ($fakecomment_star == 5 || $fakecomment_star == 46): ?>
                                <i class="fa fa-star"></i>
                            <?php endif; ?>
                        </div>
                        <?php the_content(); ?>
                    </div>
                    <div class="like">
                        <p><?php echo $fakecomment_like . esc_html__(' Lượt thích', 'sport'); ?></p>
                        <span class="dot"></span>
                        <span class="date"><?php echo date('d/m/Y', strtotime($fakecomment_date)); ?></span>
                    </div>
                </div>

            <?php

            endwhile;
            wp_reset_postdata();

        endif;
        echo '</div>';
        echo '</div>';

    }
endif;

if (!function_exists('sport_product_countdown')) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_product_countdown - 99
     */
    function sport_product_countdown()
    {
        $sport_cd_day = rwmb_meta('sport_option_product_cd_date');
        $sport_product_sold = rwmb_meta('sport_option_product_sold');
        $sport_product_total = rwmb_meta('sport_option_product_total');
        $sport_product_percent = ($sport_product_sold / $sport_product_total) * 100;
        ?>
        <?php if ($sport_cd_day != ''): ?>
        <div class="count-down">
            <div class="clock-cowndown">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Smu8.gif" alt="alarm clock"/>
                <p><?php echo esc_html__('Khuyến mãi kết thúc sau', 'sport'); ?></p>
                <div id="clock" class="twoDayDigits d-flex"
                     data-countdown-day="<?php echo esc_attr($sport_cd_day); ?>"
                ></div>
            </div>
            <?php if ($sport_product_sold != '' && $sport_product_total != ''): ?>
                <div class="sold-progress-bar">
                    <div class="sold d-flex">
                        <p><?php echo esc_html__('Đã bán ', '') ?><?php echo esc_html($sport_product_sold); ?></p>
                        <div class="progress-product"></div>
                        <style>
                            .progress-product:after {
                                width: <?php echo esc_attr($sport_product_percent); ?>%;
                            }
                        </style>
                    </div>
                    <div class="total">
                        <p><?php echo esc_html('Trên tổng số ', 'sport') . "<b>$sport_product_total</b>" . esc_html__(' sản phẩm được ưu đãi trong đợt sale này', 'sport'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>


    <?php
    endif;
    }
endif;

/* Sale flash percent */
add_filter('woocommerce_sale_flash', 'sport_change_displayed_sale_price');

function sport_change_displayed_sale_price()
{

    global $product;
    $max_percentage = '';

    if (!$product->is_on_sale()) return;

    if ($product->is_type('simple')) {

        $max_percentage = (($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100;

    } elseif ($product->is_type('variable')) {

        $max_percentage = 0;

        foreach ($product->get_children() as $child_id) {
            $variation = wc_get_product($child_id);

            $price = $variation->get_regular_price();
            $sale = $variation->get_sale_price();

            if ($price != 0 && !empty($sale)) $percentage = ($price - $sale) / $price * 100;

            if ($percentage > $max_percentage) {

                $max_percentage = $percentage;

            }
        }

    }
    if ($max_percentage > 0) echo "<span class='on-sale-percent'>-" . round($max_percentage) . "%</span>";
}

/**
 * Add a custom product data tab
 */
add_filter('woocommerce_product_tabs', 'sport_new_product_tab');
function sport_new_product_tab($tabs)
{

    // Adds the new tab
    global $sport_options;

    $sport_products_single_tab_guide = $sport_options['sport_products_single_tab_guide'];

    if (!empty($sport_products_single_tab_guide)) :

        $tabs['shopping_guide'] = array(
            'title' => esc_html__('Hướng dẫn mua hàng', 'sport'),
            'priority' => 25,
            'callback' => 'sport_new_product_tab_content'
        );

    endif;

    return $tabs;

}

function sport_new_product_tab_content()
{

    // The new tab content
    global $sport_options;

    $sport_products_single_tab_guide = $sport_options['sport_products_single_tab_guide'];

    echo wp_kses_post($sport_products_single_tab_guide);

}

if (!function_exists('sport_product_blog')) :

    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked sport_product_blog - 25
     */

    function sport_product_blog()
    {
        global $sport_options;

        $sport_products_title_blog = $sport_options['sport_products_title_blog'];
        $sport_products_check_blog = $sport_options['sport_products_check_blog'];
        $sport_product_blog_limit = $sport_options['sport_product_blog_limit'];
        $sport_product_blog_order_by = $sport_options['sport_product_blog_order_by'];
        $sport_product_blog_order = $sport_options['sport_product_blog_order'];

        $data_settings = [
            'loop' => false,
            'autoplay' => false,
            'nav' => true,
        ];

        $rows_number = 2;
        $column_number = 2;
        $number_item = $rows_number * $column_number;
        $cate = get_queried_object();
        $product_id = $cate->ID;
        $term_obj_list = get_the_terms($product_id, 'product_cat');
        foreach ($term_obj_list as $listID) {
            $listID->term_id;
        }
        $productCatMeta = get_term_meta($listID->term_id, 'select-category-link', true);
        $cat_post_ids = '';
        if ($productCatMeta != '') {
            $cat_post_ids .= $productCatMeta;
        } else {
            $cat_post_ids = NULL;
        }


        if (!empty($cat_post_ids)) :


            $args = array(
                'post_type' => 'post',
                'cat' => $cat_post_ids,
                'posts_per_page' => $sport_product_blog_limit,
                'orderby' => $sport_product_blog_order_by,
                'order' => $sport_product_blog_order,
            );

        else:

            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $sport_product_blog_limit,
                'orderby' => $sport_product_blog_order_by,
                'order' => $sport_product_blog_order,
            );

        endif;

        $query = new WP_Query($args);

        if ($query->have_posts()) :

            ?>

            <div class="blog-post-product">
                <h3 class="title title-global-sing-product text-center">
                    <?php echo esc_html($sport_products_title_blog); ?>
                </h3>

                <div class="blog-product-slider owl-carousel owl-theme"
                     data-settings='<?php echo esc_attr(wp_json_encode($data_settings)); ?>'>

                    <?php
                    $i = 1;
                    $total_posts = $query->post_count;

                    while ($query->have_posts()):
                        $query->the_post();

                        if ($i % $number_item == 1) :
                            ?>

                            <div class="row">

                        <?php endif; ?>

                        <div class="col-md-6 item-col">
                            <div class="item d-sm-flex">
                                <div class="item-thumbnail">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>

                                <div class="item-content">
                                    <h3 class="item-title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <p class="item-excerpt">
                                        <?php
                                        if (has_excerpt()) :
                                            echo wp_trim_words(get_the_excerpt(), 30, '...');
                                        else:
                                            echo wp_trim_words(get_the_content(), 30, '...');
                                        endif;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <?php if ($i % $number_item == 0 || $i == $total_posts) : ?>

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

function sport_loop_single_meta_product()
{

    $countdown_time = get_post_meta(get_the_ID(), '_sale_price_dates_to', true);

    ?>

    <div class="site-single-product__meta<?php echo(!empty($countdown_time) ? ' d-flex justify-content-between' : ''); ?>">
        <div class="left-box">
            <?php
            sport_product_rating();
            woocommerce_template_single_price();
            ?>
        </div>

    </div>

    <?php
}

add_filter('woocommerce_email_order_items_args', 'iconic_email_order_items_args', 10, 1);

function iconic_email_order_items_args($args)
{

    $args['show_image'] = true;
    $args['image_size'] = array(300, 300);

    return $args;

}

add_filter('woocommerce_order_item_name', 'sport_custom_woo_order_item_name', 10, 2);

function sport_custom_woo_order_item_name($name, $item)
{

    ?>
    <a href="<?php echo esc_url(get_permalink($item->get_product_id())); ?>">
        <?php echo esc_html($item->get_name()); ?>
    </a>
    <?php

}

if (!function_exists('sport_single_product_phone')) :

    /**
     * woocommerce_after_add_to_cart_button hook.
     *
     * @hooked sport_single_product_phone - 10
     */

    function sport_single_product_phone()
    {

        global $sport_options;

        $phone = $sport_options['sport_single_product_phone'];

        if (!empty($phone)) :

            ?>

            <div class="single-phone d-flex align-items-center">
                <div class="number-phone">
                <span>
                    <i class="fas fa-phone-volume"></i>
                </span>
                </div>

                <a href="tel:<?php echo esc_attr($phone); ?>" title="<?php esc_attr_e('Liên hệ', 'sport'); ?>">
                    <?php echo esc_html($phone); ?>
                </a>
            </div>

        <?php

        endif;
    }

endif;

