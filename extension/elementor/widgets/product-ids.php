<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sport_widget_products_ids extends Widget_Base {

    public function get_categories() {
        return array( 'sport_widgets' );
    }

    public function get_name() {
        return 'sport-products-ids';
    }

    public function get_title() {
        return esc_html__( 'Products Ids', 'sport' );
    }

    public function get_icon() {
        return 'fa fa-shopping-basket';
    }

    public function get_script_depends() {
        return ['sport-elementor-custom','products_filter'];
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

        $this->add_control(
            'number_item_filter',
            [
                'label'     =>  esc_html__( 'Number of Tabs', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  5,
                'min'       =>  1,
                'max'       =>  '',
                'step'      =>  1,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title_tab', [
                'label'         =>  esc_html__( 'Title', 'sport' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Sản phẩm mới' , 'sport' ),
                'label_block'   =>  true,
            ]
        );

        $repeater->add_control(
            'list_product_id',
            [
                'label'         =>  esc_html__( 'Input Product Id', 'sport' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  '',
                'label_block'   =>  true,
                'description'   =>  esc_html__( 'Ex input id post: 1,2', 'sport' ),
            ]
        );

        $this->add_control(
            'tab_list',
            [
                'label'     =>  esc_html__( 'Tab List', 'sport' ),
                'type'      =>  Controls_Manager::REPEATER,
                'fields'    =>  $repeater->get_controls(),
                'default'   =>  [
                    [
                        'title_tab'    =>  esc_html__( 'Sản phẩm bán chạy', 'sport' ),
                    ],
                ],
                'title_field' => '{{{ title_tab }}}',
            ]
        );

        $this->add_control(
            'link',
            [
                'label'         =>  esc_html__( 'Link', 'sport' ),
                'type'          =>  Controls_Manager::URL,
                'placeholder'   =>  'https://your-link.com',
                'show_external' =>  false,
                'default' => [
                    'url'   =>  '#',
                ],
            ]
        );

        $this->end_controls_section();
        /* End Section Query */

        /* Section Layout */
        $this->start_controls_section(
            'section_layout',
            [
                'label' =>  esc_html__( 'Layout Settings', 'sport' )
            ]
        );

        $this->add_control(
            'column_number',
            [
                'label'     =>  esc_html__( 'Column', 'sport' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  4,
                'options'   =>  [
                    7   =>  esc_html__( '7 Column', 'sport' ),
                    6   =>  esc_html__( '6 Column', 'sport' ),
                    5   =>  esc_html__( '5 Column', 'sport' ),
                    4   =>  esc_html__( '4 Column', 'sport' ),
                    3   =>  esc_html__( '3 Column', 'sport' ),
                    2   =>  esc_html__( '2 Column', 'sport' ),
                    1   =>  esc_html__( '1 Column', 'sport' ),
                ],
            ]
        );

        $this->add_control(
            'image_height_product',
            [
                'label'     =>  esc_html__( 'Height Image Product', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'min'       =>  1,
                'max'       =>  '',
                'step'      =>  1,
                'default'   =>  150,
                'selectors' =>  [
                    '{{WRAPPER}} .element-products .item-product .item-thumbnail a' => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Loop Slider ?', 'sport'),
                'label_off'     =>  esc_html__('No', 'sport'),
                'label_on'      =>  esc_html__('Yes', 'sport'),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__('Autoplay?', 'sport'),
                'type'          => Controls_Manager::SWITCHER,
                'label_off'     => esc_html__('No', 'sport'),
                'label_on'      => esc_html__('Yes', 'sport'),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'nav',
            [
                'label'         => esc_html__('Nav Slider', 'sport'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'sport'),
                'label_off'     => esc_html__('No', 'sport'),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->end_controls_section();

        /* Style Title Cat */
        $this->start_controls_section('style_title_cat', array(
            'label' =>  esc_html__( 'Title', '' ),
            'tab'   =>  Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'bk_title',
            [
                'label'     =>  esc_html__( 'Background Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .title-parent-cat' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .title-parent-cat a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .element-product-cat .title-parent-cat',
            ]
        );

        $this->end_controls_section();

        /* Style Filter Cat */
        $this->start_controls_section('style_filter', array(
            'label' =>  esc_html__( 'Filter', '' ),
            'tab'   =>  Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'button_filter_options',
            [
                'label'     =>  esc_html__( 'Button Filter', 'sport' ),
                'type'      =>  Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'filter_line_color',
            [
                'label'     =>  esc_html__( 'Color Line', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .btn-product-cat-filter' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filter_typography',
                'selector' => '{{WRAPPER}} .element-product-cat .btn-product-cat-filter span',
            ]
        );

        $this->start_controls_tabs( 'style_tabs_filter' );

        $this->start_controls_tab(
            'style_normal_tab_filter',
            [
                'label' => esc_html__( 'Normal', 'sport' ),
            ]
        );

        $this->add_control(
            'filter_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .btn-product-cat-filter span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'filter_bk',
            [
                'label'     =>  esc_html__( 'Background Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .btn-product-cat-filter span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_filter',
            [
                'label' => esc_html__( 'Hover', 'sport' ),
            ]
        );

        $this->add_control(
            'filter_color_hover',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .btn-product-cat-filter span.active, {{WRAPPER}} .element-product-cat .btn-product-cat-filter span:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'bk_filter_hover',
            [
                'label'     =>  esc_html__( 'Background Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .btn-product-cat-filter span.active, {{WRAPPER}} .element-product-cat .btn-product-cat-filter span:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'text_filter_all',
            [
                'label'     =>  esc_html__( 'Text All', 'sport' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_filter_typography',
                'selector' => '{{WRAPPER}} .element-product-cat .btn-product-cat-filter .link-cat-parent',
            ]
        );

        $this->add_control(
            'text_filter_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .btn-product-cat-filter .link-cat-parent' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_filter_color_hover',
            [
                'label'     =>  esc_html__( 'Color Hover', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .btn-product-cat-filter .link-cat-parent:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $order          =   $settings['order'];
        $tab_list       =   $settings['tab_list'];
        $list_id        =   $tab_list[0]['list_product_id'];
        $column_number  =   $settings['column_number'];
        $target         =   $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow       =   $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

        $data_settings_tab  = [
            'number_item'   =>  $settings['number_item_filter'],
            'margin_item'   =>  5
        ];

        $product_settings =   [
            'order'     =>  $order,
            'column'    =>  $column_number,
        ];

        $data_settings  =   [
            'loop'                  =>  ( 'yes' === $settings['loop'] ),
            'autoplay'              =>  ( 'yes' === $settings['autoplay'] ),
            'nav'                   =>  ( 'yes' === $settings['nav'] ),
        ];

        if ( !empty( $list_id ) ) :

           $product_ids = explode( ",", $list_id  );

           $args = array(
               'post_type'  =>  'product',
               'post__in'   =>  $product_ids,
               'order'      =>  $order,
           );

       else:

           $args = array(
               'post_type'  =>  'product',
               'order'      =>  $order,
           );

       endif;

       $query = new \ WP_Query( $args );

       if ( $query->have_posts() ) :

    ?>

        <div class="element-product-ids element-products"  data-settings='<?php echo esc_attr( wp_json_encode( $product_settings ) ); ?>'>
            <div class="product-tabs btn-filter-product-ids">
                <div class="row align-items-end">
                    <div class="col-12 col-md-10">
                        <div class="product-tabs-list btn-list-product-ids owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings_tab ) ); ?>'>
                            <?php
                            $i = 1;
                            foreach ( $tab_list as $item ) :

                                if ( !empty( $item['list_product_id'] ) ) :
                                    $ids = $item['list_product_id'];
                                else:
                                    $ids = 0;
                                endif;
                            ?>

                            <span class="btn-tab-product-item btn-item-filter-product-id<?php echo ( $i == 1 ? ' active' : '' ); ?>" data-ids="<?php echo esc_attr( $ids ); ?>">
                                <?php echo esc_html_e( $item['title_tab'] ); ?>
                            </span>

                            <?php $i++; endforeach; ?>
                        </div>
                    </div>

                    <div class="col-12 col-md-2 text-right">
                        <a class="btn-product-grid btn-product-grid-all-ids" href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php echo $target . $nofollow ?>>
                            <?php esc_html_e( 'Xem tất cả', 'sport' ); ?>
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="element-product-ids__slider owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings ) ); ?>'>
                <?php
                $i = 1;
                $total_posts    =   $query->post_count;

                while ( $query->have_posts() ):
                    $query->the_post();

                    if ( $i % $column_number == 1 ) :
                ?>
                    <div class="row custom_row">

                <?php
                    endif;

                    sport_content_product_filter( sport_class_col( $column_number ) );

                    if ( $i % $column_number == 0 || $i == $total_posts ) :
                ?>

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
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sport_widget_products_ids );