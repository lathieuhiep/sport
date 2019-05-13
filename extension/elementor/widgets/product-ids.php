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
            'title',
            [
                'label'         =>  esc_html__( 'Title', 'sport' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Top sản phẩm mới', 'sport' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'input_id_product',
            [
                'label'         =>  esc_html__( 'Input Id Product', 'sport' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  '',
                'label_block'   =>  true,
                'description'   =>  esc_html__( 'Ex input id post: 1,2', 'sport' ),
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

        $this->end_controls_section();

        /* Section Layout */
        $this->start_controls_section(
            'section_layout',
            [
                'label' =>  esc_html__( 'Layout Settings', 'sport' )
            ]
        );

        $this->add_control(
            'item',
            [
                'label'     =>  esc_html__( 'Number of Item Desktop', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  5,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'item_tablet',
            [
                'label'     =>  esc_html__( 'Number of Item Tablet', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  3,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'item_mobile',
            [
                'label'     =>  esc_html__( 'Number of Item Mobile', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  1,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'margin_item',
            [
                'label'     =>  esc_html__( 'Margin Item Desktop', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  30,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'margin_item_mobile',
            [
                'label'     =>  esc_html__( 'Margin Item Mobile', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  0,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
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
                'default'       =>  'yes',
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

        $settings           =   $this->get_settings_for_display();
        $order              =   $settings['order'];
        $input_id_product   =   $settings['input_id_product'];

        $data_settings  =   [
            'number_item'           =>  $settings['item'],
            'item_tablet'           =>  $settings['item_tablet'],
            'item_mobile'           =>  $settings['item_mobile'],
            'margin_item'           =>  $settings['margin_item'],
            'margin_item_mobile'    =>  $settings['margin_item_mobile'],
            'loop'                  =>  ( 'yes' === $settings['loop'] ),
            'autoplay'              =>  ( 'yes' === $settings['autoplay'] ),
            'nav'                   =>  ( 'yes' === $settings['nav'] ),
        ];

        $ids_product = explode( ",", $input_id_product  );

        $args = array(
            'post_type'             =>  'product',
            'post__in'              =>  $ids_product,
            'order'                 =>  $order,
        );

        $query = new \ WP_Query( $args );

        if ( $query->have_posts() ) :

        ?>

            <div class="element-product-ids element-products">
                <div class="top-header">
                    <h4 class="title">
                        <?php echo esc_html( $settings['title'] ); ?>
                    </h4>
                </div>

                <div class="element-product-ids__slider owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings ) ); ?>'>
                    <?php while ( $query->have_posts() ): $query->the_post(); ?>

                        <div class="item-product">
                            <div class="item-thumbnail">
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

                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>

        <?php

        endif;

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sport_widget_products_ids );