<?php
/*
 * Widget Filter Products by Brand
 * */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class sport_brand_filter_widget extends WP_Widget {
    /**
     * Sets up the widgets name etc
     */
    public function __construct() {

        $sport_widget_ops = array(
            'classname'     =>  'brand_filter_widget',
            'description'   =>  'Filter Products by Brand',
        );

        parent::__construct( 'brand_filter_widget', 'Filter Products by Brand', $sport_widget_ops );

    }
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        if ( is_product_category() || is_shop() ) :

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) :

            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

        endif;

        $sport_get_product_brand          =   sport_get_product_brand();
        $sport_get_product_meta_brand_ids =   array();

        if ( is_product_category() ) :

            $sport_get_product_cat_id   =   get_queried_object_id();

            foreach ( $sport_get_product_brand as $sport_get_product_brand_item ):

                $sport_get_product_meta_brand   =  get_term_meta( $sport_get_product_cat_id, 'term-brand-' . $sport_get_product_brand_item->term_id, true );

                if ( !empty( $sport_get_product_meta_brand ) ) :

                    $sport_get_product_meta_brand_ids[] .= $sport_get_product_meta_brand;

                endif;

            endforeach;

        endif;

        /* Check brand empty */
        if ( empty( $sport_get_product_meta_brand_ids ) ) :

            foreach ( $sport_get_product_brand as $sport_get_product_brand_item ):

                $sport_get_product_meta_brand_ids[] .= $sport_get_product_brand_item->term_id;

            endforeach;

        endif;

        ?>

        <div class="sidebar-filter-shop">

            <?php

            foreach ( $sport_get_product_meta_brand_ids as $sport_get_product_meta_brand_id ) :

                $sport_term_brand = get_term( $sport_get_product_meta_brand_id, 'product_brand' );

            ?>

                <div class="widget-filter-product-term__item">
                    <label>
                        <input class="product_brand_check" type="checkbox" name="<?php echo esc_attr( $sport_term_brand->slug ); ?>" value="<?php echo esc_attr( $sport_term_brand->term_id ); ?>" data-filter="product_brand" autocomplete="off" />

                        <span class="widget-filter-product-term__check"></span>

                        <span class="widget-filter-product-term__name">
                            <?php echo esc_html( $sport_term_brand->name ); ?>
                        </span>
                    </label>
                </div>

            <?php endforeach; ?>

        </div>

        <?php if ( count( $sport_get_product_meta_brand_ids ) > 7 ) : ?>

            <span class="load-more-filter-product">
                <?php esc_html_e( 'Load More', 'sport' ); ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </span>

        <?php endif; ?>

        <?php

        echo $args['after_widget'];

        endif;
    }
    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {

        ?>

        <!-- Start Title -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'wp-recent-posts-thumbs' ); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <!-- End Title -->

        <?php
    }
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title']      =   ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        return $instance;

    }
}

// Register recent posts thumbs widget
function sport_brand_filter_register_widget() {
    register_widget( 'sport_brand_filter_widget' );
}
add_action( 'widgets_init', 'sport_brand_filter_register_widget' );