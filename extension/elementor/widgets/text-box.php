<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sport_widget_text_box extends Widget_Base {

    public function get_categories() {
        return array( 'sport_widgets' );
    }

    public function get_name() {
        return 'sport-text-box';
    }

    public function get_title() {
        return esc_html__( 'Text Box', 'sport' );
    }

    public function get_icon() {
        return 'fa fa-file-text-o';
    }

    public function get_script_depends() {
        return ['sport-elementor-custom'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'sport' ),
            ]
        );

        $this->add_control(
            'icon_image',
            [
                'label'     =>  esc_html__( 'Icon Image', 'sport' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         =>  esc_html__( 'Title', 'sport' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Title Text', 'sport' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'description',
            [
                'label'     =>  esc_html__( 'Description', 'sport' ),
                'type'      =>  Controls_Manager::TEXTAREA,
                'default'   =>  esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'sport' ),
            ]
        );

        $this->end_controls_section();

        /* Style Title */
        $this->start_controls_section('style_title', array(
            'label' =>  esc_html__( 'Title', '' ),
            'tab'   =>  Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .elementor-text-box .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-text-box .title',
            ]
        );

        $this->end_controls_section();

        /* Style Description */
        $this->start_controls_section('style_description', array(
            'label' =>  esc_html__( 'Description', '' ),
            'tab'   =>  Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'description_color',
            [
                'label'     =>  esc_html__( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .elementor-text-box .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-text-box .description',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();

    ?>

        <div class="elementor-text-box d-flex">
            <div class="icon-image">
                <?php echo wp_kses_post( wp_get_attachment_image( $settings['icon_image']['id'], 'full' ) ); ?>
            </div>

            <div class="content">
                <h4 class="title">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h4>

                <p class="description">
                    <?php echo wp_kses_post( $settings['description'] ); ?>
                </p>
            </div>
        </div>

    <?php

    }

    protected function _content_template() {

    ?>

        <div class="elementor-text-box d-flex">
            <div class="icon-image">
                <img src="{{ settings.icon_image.url }}">
            </div>

            <div class="content">
                <h4 class="title">
                    {{{ settings.title }}}
                </h4>

                <p class="description">
                    {{{ settings.description }}}
                </p>
            </div>
        </div>

    <?php

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sport_widget_text_box );