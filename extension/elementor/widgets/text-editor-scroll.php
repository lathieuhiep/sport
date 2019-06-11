<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sport_widget_text_editor_scroll extends Widget_Base {

    public function get_categories() {
        return array( 'sport_widgets' );
    }

    public function get_name() {
        return 'sport-text-editor-scroll';
    }

    public function get_title() {
        return esc_html__( 'Text Editor Scroll', 'sport' );
    }

    public function get_icon() {
        return 'eicon-text-area';
    }

    public function get_script_depends() {
        return ['sport-elementor-custom'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_text_editor',
            [
                'label' => esc_html__( 'Text Editor', 'sport' ),
            ]
        );

        $this->add_control(
            'text_editor',
            [
                'type'      =>  Controls_Manager::WYSIWYG,
                'default'   =>  esc_html__( 'Default description', 'sport' ),
            ]
        );

        $this->add_responsive_control(
            'text_editor_height',
            [
                'label' => esc_html__( 'Height', 'sport' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .element-text-editor-scroll .boxscroll' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*STYLE TAB*/
        $this->start_controls_section('style', array(
            'label' =>  esc_html__( 'Text', '' ),
            'tab'   =>  Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'text_editor_color',
            [
                'label'     =>  __( 'Color', 'sport' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-text-editor-scroll .boxscroll' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_editor_typography',
                'selector' => '{{WRAPPER}} .element-text-editor-scroll .boxscroll',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();

        if ( !empty( $settings['text_editor'] ) ) :

    ?>

        <div class="element-text-editor-scroll">
            <div class="boxscroll">
                <?php echo wp_kses_post( $settings['text_editor'] ); ?>
            </div>
        </div>

    <?php

        endif;
    }

    protected function _content_template() {

    ?>

        <# if ( settings.text_editor !== '' ) {#>

        <div class="element-text-editor-scroll">
            <div class="boxscroll">
                {{{ settings.text_editor }}}
            </div>
        </div>

        <# } #>

    <?php

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sport_widget_text_editor_scroll );