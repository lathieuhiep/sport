<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sport_post_grid extends Widget_Base {

    public function get_categories() {
        return array( 'sport_widgets' );
    }

    public function get_name() {
        return 'sport-post-grid';
    }

    public function get_title() {
        return esc_html__( 'Posts Grid', 'sport' );
    }

    public function get_icon() {
        return 'fa fa-newspaper-o';
    }

    protected function _register_controls() {

        /* Section Layout */
        $this->start_controls_section(
            'section_layout',
            [
                'label' =>  esc_html__( 'Layout Settings', 'sport' )
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      =>  'thumbnail',
                'exclude'   =>  [ 'custom' ],
                'default'   =>  'full',
            ]
        );

        $this->add_control(
            'title_post_length',
            [
                'label'     =>  esc_html__( 'Title Post Words', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  '10',
                'condition' =>  [
                    'show_excerpt' => '1',
                ],
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label'     =>  esc_html__( 'Show excerpt', 'sport' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    '1' => [
                        'title' =>  esc_html__( 'Yes', 'sport' ),
                        'icon'  =>  'fa fa-check',
                    ],
                    '0' => [
                        'title' =>  esc_html__( 'No', 'sport' ),
                        'icon'  =>  'fa fa-ban',
                    ]
                ],
                'default' => '1'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'     =>  esc_html__( 'Excerpt Words', 'sport' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  '10',
                'condition' =>  [
                    'show_excerpt' => '1',
                ],
            ]
        );

        $this->end_controls_section();

        /* Section Query */
        $this->start_controls_section(
            'section_query',
            [
                'label' =>  esc_html__( 'Query', 'sport' )
            ]
        );

        $this->add_control(
            'input_id_post',
            [
                'label'         =>  esc_html__( 'Input Id Post', 'sport' ),
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

        /* Section style post */
        $this->start_controls_section(
            'section_style_post',
            [
                'label' => esc_html__( 'Color & Typography', 'sport' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        // Style title post
        $this->add_control(
            'title_post_options',
            [
                'label'     =>  esc_html__( 'Title Post', 'sport' ),
                'type'      =>  \Elementor\Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'title_post_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-grid .item-post__title a'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_post_color_hover',
            [
                'label'     =>  esc_html__( 'Color Hover', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-grid .item-post__title a:hover'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_post_typography',
                'selector' => '{{WRAPPER}} .element-post-grid .item-post .item-post__title',
            ]
        );

        // Style excerpt post
        $this->add_control(
            'excerpt_post_options',
            [
                'label'     =>  esc_html__( 'Excerpt Post', 'sport' ),
                'type'      =>  \Elementor\Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-grid .item-post .item-excerpt'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .element-post-grid .item-post .item-excerpt',
            ]
        );

        // Style comment post
        $this->add_control(
            'comment_post_options',
            [
                'label'     =>  esc_html__( 'Comment Post', 'sport' ),
                'type'      =>  \Elementor\Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'comment_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-grid .item-post .item-post__comment a'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'comment_typography',
                'selector' => '{{WRAPPER}} .element-post-grid .item-post .item-post__comment a',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $order_post     =   $settings['order'];
        $input_id_post  =   $settings['input_id_post'];

        if ( !empty( $input_id_post ) ) :

            $ids_post = explode( ",", $input_id_post  );

            $args = array(
                'post_type'             =>  'post',
                'post__in'              =>  $ids_post,
                'order'                 =>  $order_post,
                'ignore_sticky_posts'   =>  1,
            );

            $query = new \ WP_Query( $args );

            if ( $query->have_posts() ) :

        ?>

            <div class="element-post-grid post-grid-masory">
                <div class="row">
                    <?php
                    $i = $j = 0 ;
                    while ( $query->have_posts() ): $query->the_post();

                        $total_posts    =   $query->post_count;

                        if ( $i % 4 == 0 ) :
                            $class_column = 6;
                        else:
                            $class_column = 3;
                        endif;

                        if ( $i % 4 != 3 ) :

                    ?>

                        <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( $class_column ); ?> item-col">

                    <?php endif; ?>

                            <div class="item-post">
                                <div class="item-post__thumbnail">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>

                                            <img src="<?php echo esc_url( Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail', $settings ) ); ?>" alt="<?php the_title(); ?>">

                                        <?php else: ?>

                                            <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>" />

                                        <?php endif; ?>
                                    </a>
                                </div>

                                <p class="item-post__date d-flex align-items-center justify-content-center flex-column">
                                    <span class="day">
                                        <?php echo esc_html( get_the_date( 'd' ) ); ?>
                                    </span>

                                    <span class="month">
                                        <?php echo esc_html( get_the_date( 'Sm' ) ); ?>
                                    </span>
                                </p>

                                <div class="item-content text-center">
                                    <h3 class="item-post__title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <?php echo esc_html( wp_trim_words( get_the_title(), $settings['title_post_length'] ) ); ?>
                                        </a>
                                    </h3>

                                    <?php if ( $settings['show_excerpt'] == 1 && $i % 4 != 2 && $i % 4 != 3 ) : ?>

                                        <p class="item-excerpt">
                                            <?php
                                            if ( has_excerpt() ) :
                                                echo esc_html( wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], '[...]' ) );
                                            else:
                                                echo esc_html( wp_trim_words( get_the_content(), $settings['excerpt_length'], '[...]' ) );
                                            endif;
                                            ?>
                                        </p>

                                    <?php
                                    endif;

                                    if ( $i % 4 == 0 ) :
                                    ?>

                                        <p class="item-post__comment">
                                            <?php
                                            comments_popup_link(
                                                esc_html__( '0 Comment', 'cogito' ),
                                                esc_html__( '1 Comment', 'cogito' ),
                                                esc_html__( '% Comment(s)', 'cogito' )
                                            );
                                            ?>
                                        </p>

                                    <?php endif; ?>
                                </div>
                            </div>

                    <?php if ( $i % 4 != 2 || $j == $total_posts ) : ?>

                        </div>

                    <?php endif; ?>

                    <?php
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

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new sport_post_grid );