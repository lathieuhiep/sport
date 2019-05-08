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

        /* Start Section Filter */
        $this->start_controls_section(
            'section_filter',
            [
                'label' =>  esc_html__( 'Filter', 'sport' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'filter_list_name', [
                'label'         =>  esc_html__( 'Title', 'sport' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'New' , 'sport' ),
                'label_block'   =>  true,
            ]
        );

        $repeater->add_control(
            'filter_list_cat',
            [
                'label'         =>  esc_html__( 'Select Category', 'sport' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  sport_check_get_cat( 'product_cat' ),
                'multiple'      =>  true,
                'label_block'   =>  true,
            ]
        );

        $repeater->add_control(
            'filter_list_order_by',
            [
                'label'     =>  esc_html__( 'Order By', 'sport' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'            =>  esc_html__( 'ID', 'sport' ),
                    'date'          =>  esc_html__( 'Date', 'sport' ),
                    'total_sales'   =>  esc_html__( 'Bestsellers', 'sport' ),
                    'rating_count'  =>  esc_html__( 'Rating', 'sport' ),
                    '_featured'     =>  esc_html__( 'Featured', 'sport' ),
                    '_sale_price'   =>  esc_html__( 'Sale Price', 'sport' )
                ],
            ]
        );

        $this->add_control(
            'filter_list',
            [
                'label'     =>  esc_html__( 'Filter List', 'sport' ),
                'type'      =>  Controls_Manager::REPEATER,
                'fields'    =>  $repeater->get_controls(),
                'default'   =>  [
                    [
                        'filter_list_name'    =>  esc_html__( 'New', 'sport' ),
                    ],
                ],
                'title_field' => '{{{ filter_list_name }}}',
            ]
        );

        $this->end_controls_section();

        /* Start Section Query */
        $this->start_controls_section(
            'section_query',
            [
                'label' =>  esc_html__( 'Query', 'sport' )
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
                'label' => esc_html__( 'Slides Options', 'sport' ),
                'tab' => \Elementor\Controls_Manager::SECTION
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  \Elementor\Controls_Manager::SWITCHER,
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
                'label'         => esc_html__( 'Autoplay?', 'sport' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'sport' ),
                'label_off'     => esc_html__( 'No', 'sport' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'nav',
            [
                'label'         => esc_html__( 'Nav?', 'sport' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'sport' ),
                'label_off'     => esc_html__( 'No', 'sport' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->end_controls_section();
        /* End Section Layout */

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $rows_number    =   $settings['rows_number'];
        $column_number  =   $settings['column_number'];
        $number_item    =   $rows_number * $column_number;
        $filter_list    =   $settings['filter_list'];
        $limit          =   $settings['limit'];
        $order          =   $settings['order'];

        if ( $column_number == 4 ) :
            $class_column_number = 'column-4 col-lg-3';
        elseif ( $column_number == 3 ) :
            $class_column_number = 'column-3 col-lg-4';
        elseif ( $column_number == 2 ) :
            $class_column_number = 'column-2 col-lg-6';
        else:
            $class_column_number = 'column-1 col-lg-12';
        endif;

        $product_filter_settings =   [
            'limit'     =>  $limit,
            'order'     =>  $order
        ];

        $data_settings  =   [
            'loop'          =>  ( 'yes' === $settings['loop'] ),
            'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
            'nav'           =>  ( 'yes' === $settings['nav'] ),
        ];

        ?>


        <div class="element-product-filter" data-settings='<?php echo esc_attr( wp_json_encode( $product_filter_settings ) ); ?>'>
            <?php if ( !empty( $filter_list ) ) : ?>

                <div class="filter-block">
                    <?php
                    $i = 0;
                    foreach ( $filter_list as $item ) :

                        if ( !empty( $item['filter_list_cat'] ) ) :

                            $ids = implode( ",",$item['filter_list_cat'] );

                        else:

                            $ids = 0;

                        endif;

                        $btn_filter_settings =   [
                            'ids'       =>  $ids,
                            'order_by'  =>  $item['filter_list_order_by'],
                        ];

                        ?>

                        <button class="btn-filter-product<?php echo esc_attr( $i == 0 ? ' active' : '' ); ?>" data-settings='<?php echo esc_attr( wp_json_encode( $btn_filter_settings ) ); ?>'>
                            <?php echo esc_html( $item['filter_list_name'] ); ?>
                        </button>

                        <?php $i++; endforeach; ?>
                </div>

                <div class="element-product-filter__container">
                    <?php
                    $meta_query                 =   '';
                    $filter_list_fist           =   $filter_list[0];
                    $filter_list_fist_cat       =   $filter_list_fist['filter_list_cat'];
                    $filter_list_fist_order_by  =   $filter_list_fist['filter_list_order_by'];

                    if ( !empty( $filter_list_fist_cat ) ):

                        $tax_query = array(
                            'taxonomy'  =>  'product_cat',
                            'field'     =>  'id',
                            'terms'     =>  $filter_list_fist_cat,
                        );

                    else:

                        $tax_query = '';

                    endif;

                    if ( $filter_list_fist_order_by == 'total_sales' ) :

                        $order_by   =   'meta_value_num';

                        $meta_query =   array(
                            array(
                                'key'       =>  'total_sales',
                                'value'     =>  0,
                                'compare'   =>  '>'
                            )
                        );

                    else:

                        $order_by = $filter_list_fist_order_by;

                    endif;


                    $args = array(
                        'post_type'         =>  'product',
                        'posts_per_page'    =>  $limit,
                        'orderby'           =>  $order_by,
                        'order'             =>  $order,
                        'tax_query'         =>  $tax_query,
                        'meta_query'        =>  $meta_query
                    );

                    $query = new \ WP_Query( $args );

                    if ( $query->have_posts() ) :

                ?>

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

                    <?php endif; ?>
                </div>

            <?php endif; ?>
        </div>

        <?php


    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sport_widget_products_filter );