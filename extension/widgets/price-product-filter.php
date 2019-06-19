<?php
/*
 * Widget Filter Products by Brand
 * */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class sport_price_product_filter_widget extends WP_Widget {
    /**
     * Sets up the widgets name etc
     */
    public function __construct() {

        $sport_widget_ops = array(
            'classname'     =>  'product_price_filter_widget',
            'description'   =>  'Filter Products By Price',
        );

        parent::__construct( 'product_price_filter_widget', '[Sport] Lọc sẩn phẩm theo giá', $sport_widget_ops );

    }
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        if ( is_product_category() || is_shop() ) :

            var_dump( WC_Query::price_filter_meta_query() );

            echo $args['before_widget'];

            if ( ! empty( $instance['title'] ) ) :

                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

            endif;

    ?>

        <div class="sport-price-product-filter-widget">
            <div id="slider-range"></div>

            <p>
                <label for="amount">Price range:</label>
                <input type="text" id="amount">
            </p>
        </div>

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
function sport_price_product_filter_register_widget() {
    register_widget( 'sport_price_product_filter_widget' );
}
add_action( 'widgets_init', 'sport_price_product_filter_register_widget' );