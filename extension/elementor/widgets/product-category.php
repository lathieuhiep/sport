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
        return ['sport-elementor-custom', 'products_filter'];
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
                'max'       =>  '',
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

        $this->add_control(
            'number_item_filter',
            [
                'label'     =>  esc_html__( 'Number of Tabs', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  8,
                'min'       =>  1,
                'max'       =>  '',
                'step'      =>  1,
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

        $this->end_controls_section();

        /* Options Slides */
        $this->start_controls_section(
            'section_slides',
            [
                'label' =>  esc_html__( 'Slides Options Query', 'sport' ),
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

        /* Start Section Gallery */
        $this->start_controls_section(
            'section_gallery',
            [
                'label' =>  esc_html__( 'Gallery', 'sport' )
            ]
        );

        $this->add_control(
            'list_post_type_gallery',
            [
                'label'         =>  esc_html__( 'Select Gallery', 'sport' ),
                'type'          =>  Controls_Manager::SELECT,
                'options'       =>  sport_get_title_post_type( 'gallery' ),
                'label_block'   =>  true,
            ]
        );

        $this->add_control(
            'slider_gallery_options',
            [
                'label'     =>  esc_html__( 'Options', 'sport' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'gallery_height',
            [
                'label'     =>  esc_html__( 'Height', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'min'       =>  1,
                'max'       =>  '',
                'step'      =>  1,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .product-gallery-cat .item-gallery .item-gallery__img' => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'gallery_loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__( 'Loop Slides ?', 'sport' ),
                'label_on'      =>  esc_html__( 'Yes', 'sport' ),
                'label_off'     =>  esc_html__( 'No', 'sport' ),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );

        $this->add_control(
            'gallery_autoplay',
            [
                'label'         =>  esc_html__( 'Autoplay?', 'sport' ),
                'type'          =>  Controls_Manager::SWITCHER,
                'label_on'      =>  esc_html__( 'Yes', 'sport' ),
                'label_off'     =>  esc_html__( 'No', 'sport' ),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );

        $this->end_controls_section();
        /* End Section Gallery */

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

        /* Style Gallery */
        $this->start_controls_section('style_gallery', array(
            'label' =>  esc_html__( 'Gallery', '' ),
            'tab'   =>  Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'title_gallery_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-cat .product-gallery-cat .item-gallery .item-gallery__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_gallery_typography',
                'selector' => '{{WRAPPER}} .element-product-cat .product-gallery-cat .item-gallery .item-gallery__title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      =>  'title_gallery_border',
                'label'     =>  esc_html__( 'Border', 'sport' ),
                'selector'  =>  '{{WRAPPER}} .element-product-cat .product-gallery-cat .item-gallery .item-gallery__title',
            ]
        );

        $this->end_controls_section();

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
        $product_cat_id =   0;
        $list_gallery   =   $settings['list_post_type_gallery'];

        $product_settings =   [
            'limit'     =>  $limit,
            'order_by'  =>  $order_by,
            'order'     =>  $order,
            'rows'      =>  $rows_number,
            'column'    =>  $column_number,
        ];

        $data_settings_tab  = [
            'number_item'   =>  $settings['number_item_filter'],
            'margin_item'   =>  5
        ];

        $data_settings  =   [
            'loop'          =>  ( 'yes' === $settings['loop'] ),
            'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
            'nav'           =>  ( 'yes' === $settings['nav'] ),
        ];

        $gallery_settings  =   [
            'loop'          =>  ( 'yes' === $settings['gallery_loop'] ),
            'autoplay'      =>  ( 'yes' === $settings['gallery_autoplay'] ),
        ];

        $product_cat_children = get_term_children( $product_cat, 'product_cat' );

        if ( !empty( $product_cat ) ) :

            $product_term = get_term( $product_cat, 'product_cat' );

            if ( !empty( $product_cat_children ) ) :
                $product_cat_id = $product_cat_children[0];
            else:
                $product_cat_id = $product_cat;
            endif;

            $tax_query = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $product_cat_id,
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

        <div class="element-product-cat element-products" data-settings='<?php echo esc_attr( wp_json_encode( $product_settings ) ); ?>'>
            <?php if ( !empty( $product_cat ) ) : ?>

            <h2 class="title-parent-cat text-center">
                <a href="<?php echo esc_url( get_term_link( $product_term->term_id, 'product_cat' ) ); ?>" title="<?php echo esc_attr( $product_term->name ); ?>">
                    <?php echo esc_html( $product_term->name ); ?>
                </a>
            </h2>

            <?php endif; ?>

            <div class="element-product-cat__warp">
                <?php if ( !empty( $product_cat_children ) ) : ?>

                <div class="product-tabs btn-product-cat-filter">
                    <div class="row align-items-end">
                        <div class="col-12 col-md-10">
                            <div class="product-tabs-list btn-list-cat owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings_tab ) ); ?>'>
                                <?php
                                foreach ( $product_cat_children as $item ) :

                                    $term_children = get_term_by( 'id', $item, 'product_cat' );
                                ?>

                                <span class="btn-tab-product-item btn-item-filter<?php echo ( $product_cat_children[0] == $term_children->term_id ? ' active' : '' ); ?>" data-id="<?php echo esc_attr( $term_children->term_id ); ?>">
                                    <?php echo esc_html( $term_children->name ); ?>
                                </span>

                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 text-right">
                            <span class="btn-product-grid btn-product-grid-all-cat" data-grid-cat-id="<?php echo esc_attr( $product_cat_id ); ?>">
                                <?php esc_html_e( 'Xem tất cả', 'sport' ); ?>
                                <i class="fas fa-angle-double-right"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <?php endif; ?>

                <div class="row">
                    <div class="col-12 <?php echo esc_attr( !empty( $list_gallery ) ? 'col-md-9' : 'col-md-12' ); ?>">
                        <div class="element-product-cat__container">
                            <div class="filter-loader">
                                <span class="loader-icon"></span>
                            </div>

                            <div class="element-product-cat__data">
                                <div class="element-product-cat__slider owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings ) ); ?>'>
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

                                        sport_content_product_filter( sport_class_col( $column_number ) );

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
                    </div>

                    <?php
                    if ( !empty( $list_gallery ) ) :

                        $gallery_args = array(
                            'post_type'  =>  'gallery',
                            'post__in'   =>  array( $list_gallery ),
                        );

                        $gallery_query = new \ WP_Query( $gallery_args );

                        ?>

                        <div class="col-12 col-md-3">
                            <div class="element-product-gallery-cate product-gallery-cate owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $gallery_settings ) ); ?>'>

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

                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php

        endif;

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sport_widget_products_filter );