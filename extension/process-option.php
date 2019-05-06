<?php
    /*
     * Method process option
     * # option 1: config font
     * # option 2: process config theme
    */
    if( !is_admin() ):

        add_action( 'wp_head','sport_config_theme' );

        function sport_config_theme() {

            if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :

                    global $sport_options;
                    $sport_favicon = $sport_options['sport_favicon_upload']['url'];

                    if( $sport_favicon != '' ) :

                        echo '<link rel="shortcut icon" href="' . esc_url( $sport_favicon ) . '" type="image/x-icon" />';

                    endif;

            endif;
        }

        // Method add custom css, Css custom add here
        // Inline css add here
        /**
         * Enqueues front-end CSS for the custom css.
         *
         * @see wp_add_inline_style()
         */

        add_action( 'wp_enqueue_scripts', 'sport_custom_css', 99 );

        function sport_custom_css() {

            global $sport_options;

            $sport_typo_selecter_1   =   $sport_options['sport_custom_typography_1_selector'];

            $sport_typo1_font_family   =   $sport_options['sport_custom_typography_1']['font-family'] == '' ? '' : $sport_options['sport_custom_typography_1']['font-family'];

            $sport_css_style = '';

            if ( $sport_typo1_font_family != '' ) :
                $sport_css_style .= ' '.esc_attr( $sport_typo_selecter_1 ).' { font-family: '.balanceTags( $sport_typo1_font_family, true ).' }';
            endif;

            if ( $sport_css_style != '' ) :
                wp_add_inline_style( 'sport-style', $sport_css_style );
            endif;

        }

    endif;
