<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sport_widget_products_filter extends Widget_Base {

    public function get_categories() {
        return array( 'sport_widgets' );
    }

    public function get_name() {
        return 'sport-products-cat';
    }

    public function get_title() {
        return esc_html__( 'Products Category', 'sport' );
    }

    public function get_icon() {
        return 'fa fa-shopping-basket';
    }

    public function get_script_depends() {
        return ['sport-elementor-custom'];
    }

    protected function _register_controls() {

        /* Start Section Query */
        $this->start_controls_section(
            'section_query',
            [
                'label' =>  esc_html__( 'Query', 'sport' )
            ]
        );

        $this->add_control(
            'product_cat',
            [
                'label'         =>  esc_html__( 'Select Category', 'sport' ),
                'type'          =>  Controls_Manager::SELECT,
                'options'       =>  sport_check_get_cat( 'product_cat' ),
                'label_block'   =>  true,
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     =>  esc_html__( 'Number of Products', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  16,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'     =>  esc_html__( 'Order By', 'sport' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'    =>  esc_html__( 'Post ID', 'sport' ),
                    'date'  =>  esc_html__( 'Date', 'sport' ),
                    'title' =>  esc_html__( 'Title', 'sport' ),
                    'rand'  =>  esc_html__( 'Random', 'sport' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'     =>  esc_html__( 'Order', 'sport' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'ASC',
                'options'   =>  [
                    'ASC'   =>  esc_html__( 'Ascending', 'sport' ),
                    'DESC'  =>  esc_html__( 'Descending', 'sport' ),
                ],
            ]
        );

        $this->end_controls_section();
        /* End Section Query */

        /* Start Section Layout */
        $this->start_controls_section(
            'section_layout',
            [
                'label' =>  esc_html__( 'Layout', 'sport' )
            ]
        );

        $this->add_control(
            'rows_number',
            [
                'label'     =>  esc_html__( 'Rows', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  2,
                'min'       =>  1,
                'max'       =>  10,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'column_number',
            [
                'label'     =>  esc_html__( 'Column', 'sport' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  4,
                'options'   =>  [
                    4   =>  esc_html__( '4 Column', 'sport' ),
                    3   =>  esc_html__( '3 Column', 'sport' ),
                    2   =>  esc_html__( '2 Column', 'sport' ),
                    1   =>  esc_html__( '1 Column', 'sport' ),
                ],
            ]
        );

        $this->end_controls_section();

        /* Options Slides */
        $this->start_controls_section(
            'section_slides',
            [
                'label' =>  esc_html__( 'Slides Options', 'sport' ),
                'tab'   =>  Controls_Manager::SECTION
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__( 'Loop Slides ?', 'sport' ),
                'label_on'      =>  esc_html__( 'Yes', 'sport' ),
                'label_off'     =>  esc_html__( 'No', 'sport' ),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         =>  esc_html__( 'Autoplay?', 'sport' ),
                'type'          =>  Controls_Manager::SWITCHER,
                'label_on'      =>  esc_html__( 'Yes', 'sport' ),
                'label_off'     =>  esc_html__( 'No', 'sport' ),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'nav',
            [
                'label'         =>  esc_html__( 'Nav?', 'sport' ),
                'type'          =>  Controls_Manager::SWITCHER,
                'label_on'      =>  esc_html__( 'Yes', 'sport' ),
                'label_off'     =>  esc_html__( 'No', 'sport' ),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );

        $this->end_controls_section();
        /* End Section Layout */

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $product_cat    =   $settings['product_cat'];
        $rows_number    =   $settings['rows_number'];
        $column_number  =   $settings['column_number'];
        $number_item    =   $rows_number * $column_number;
        $limit          =   $settings['limit'];
        $order_by       =   $settings['order_by'];
        $order          =   $settings['order'];
        $tax_query      =   $product_term  = '';

        if ( $column_number == 4 ) :
            $class_column_number = 'column-4 col-lg-3';
        elseif ( $column_number == 3 ) :
            $class_column_number = 'column-3 col-lg-4';
        elseif ( $column_number == 2 ) :
            $class_column_number = 'column-2 col-lg-6';
        else:
            $class_column_number = 'column-1 col-lg-12';
        endif;

        $product_settings =   [
            'limit'     =>  $limit,
            'order_by'  =>  $order_by,
            'order'     =>  $order
        ];

        $data_settings  =   [
            'loop'          =>  ( 'yes' === $settings['loop'] ),
            'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
            'nav'           =>  ( 'yes' === $settings['nav'] ),
        ];

        $product_cat_children = get_term_children( $product_cat, 'product_cat' );

        if ( !empty( $product_cat ) ) :

            $product_term = get_term( $product_cat, 'product_cat' );

            $tax_query = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'id',
                    'terms'    => $product_cat,
                )
            );

        endif;

        $args = array(
            'post_type'         =>  'product',
            'posts_per_page'    =>  $limit,
            'orderby'           =>  $order_by,
            'order'             =>  $order,
            'tax_query'         =>  $tax_query,
        );

        $query = new \ WP_Query( $args );

        if ( $query->have_posts() ) :

    ?>

        <div class="element-product-cat" data-settings='<?php echo esc_attr( wp_json_encode( $product_settings ) ); ?>'>
            <?php if ( !empty( $product_cat ) ) : ?>

            <h2 class="title-parent-cat text-center">
                <a href="<?php echo esc_url( get_term_link( $product_term->term_id, 'product_cat' ) ); ?>" title="<?php echo esc_attr( $product_term->name ); ?>">
                    <?php echo esc_html( $product_term->name ); ?>
                </a>
            </h2>

            <?php endif; ?>

            <div class="element-product-cat__warp">
                <?php if ( !empty( $product_cat_children ) ) : ?>

                <div class="btn-product-cat-filter d-flex align-items-end">
                    <div class="btn-list-cat">
                        <?php
                        foreach ( $product_cat_children as $item ) :

                            $term_children = get_term_by( 'id', $item, 'product_cat' );
                        ?>

                        <span class="btn-item-filter" data-id="<?php echo esc_attr( $term_children->term_id ); ?>">
                            <?php echo esc_html( $term_children->name ); ?>
                        </span>

                        <?php endforeach; ?>
                    </div>

                    <a class="link-cat-parent" href="<?php echo esc_url( get_term_link( $product_term->term_id, 'product_cat' ) ); ?>" title="<?php echo esc_attr( $product_term->name ); ?>">
                        <?php esc_html_e( 'Xem tất cả', 'sport' ); ?>
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </div>

                <?php endif; ?>

                <div class="element-product-filter__slider owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings ) ); ?>'>
                    <?php
                    $i = 1;
                    $total_posts    =   $query->post_count;
                    while ( $query->have_posts() ): $query->the_post();
                        if ( $i % $number_item == 1 ) :

                    ?>

                            <div class="menu-filter__row">
                                <div class="row">

                    <?php

                        endif;

                        sport_content_product_filter( $class_column_number );

                        if ( $i % $number_item == 0 || $i == $total_posts ) :
                    ?>

                                </div>
                            </div>

                    <?php

                        endif;

                        $i++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>

    <?php

        endif;

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sport_widget_products_filter );