<?php
function sport_content_product_filter( $class_column_number, $class_animate = null ) {

?>

    <div class="item-col <?php echo esc_attr( $class_animate . $class_column_number ); ?> col-md-3 col-sm-6 col-6">
        <?php sport_content_item_product(); ?>
    </div>

<?php

}

function sport_content_item_product() {

?>

    <div class="item-product">
        <div class="item-thumbnail">
<!--            --><?php //woocommerce_show_product_loop_sale_flash(); ?>

            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php
                do_action( 'woo_elementor_product_sale_flash' );

                if ( has_post_thumbnail() ) :
                    the_post_thumbnail( 'large' );
                else:
                ?>
                    <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ); ?>" alt="<?php the_title(); ?>">
                <?php endif; ?>
            </a>
        </div>

        <div class="item-detail text-center">
            <h2 class="item-title">
                <a class="item-link-product" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <div class="price-box">
                <?php woocommerce_template_loop_price(); ?>
            </div>
        </div>
    </div>

<?php

}

/* Start ajax product filter */
add_action( 'wp_ajax_sport_product_filter', 'sport_product_filter' );
add_action( 'wp_ajax_nopriv_sport_product_filter', 'sport_product_filter' );

function sport_product_filter() {

    $product_cat_id =   $_POST['product_cat_id'];
    $limit          =   $_POST['limit'];
    $order_by       =   $_POST['order_by'];
    $order          =   $_POST['order'];
    $rows           =   $_POST['rows'];
    $column         =   $_POST['column'];

    $args = array(
        'post_type'         =>  'product',
        'posts_per_page'    =>  $limit,
        'orderby'           =>  $order_by,
        'order'             =>  $order,
        'tax_query'         =>  array(
           array(
               'taxonomy' => 'product_cat',
               'field'    => 'term_id',
               'terms'    => $product_cat_id,
           )
        ),
    );

    $query = new WP_Query( $args );
    $i = 1;
    $total_posts    =   $query->post_count;
    $number_item    =   $rows * $column;

    while ( $query->have_posts() ): $query->the_post();

        if ( $i % $number_item == 1 ) :

?>

            <div class="menu-filter__row">
                <div class="row">

        <?php

        endif;

        sport_content_product_filter( $column, 'animated zoomIn ' );

        if ( $i % $number_item == 0 || $i == $total_posts ) :

        ?>
                </div>
            </div>

<?php
        endif;

        $i++;
    endwhile;
    wp_reset_postdata();

    exit();
}
/* End ajax product filter */

/* Start ajax product filter ids */
add_action( 'wp_ajax_sport_product_filter_id', 'sport_product_filter_id' );
add_action( 'wp_ajax_nopriv_sport_product_filter_id', 'sport_product_filter_id' );

function sport_product_filter_id() {

    $product_ids    =   $_POST['product_ids'];
    $order          =   $_POST['order'];

    if ( !empty( $product_ids ) ) :

        $ids = explode( ",", $product_ids  );

        $args = array(
            'post_type'  =>  'product',
            'post__in'   =>  $ids,
            'order'      =>  $order,
        );

        $query = new \ WP_Query( $args );

        while ( $query->have_posts() ):
            $query->the_post();

            sport_content_item_product();

        endwhile;
        wp_reset_postdata();

    endif;

    exit();

}
/* End ajax product filter ids */