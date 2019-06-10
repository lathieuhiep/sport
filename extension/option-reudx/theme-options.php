<?php
/**
 * ReduxFramework Config File
 */
if ( ! class_exists( 'Redux' ) ) {
    return;
}

function sport_remove_demo_mode_link() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action( 'init', 'sport_remove_demo_mode_link' );

// This is your option name where all the Redux data is stored.
$sport_opt_name = "sport_options";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * */

$sport_theme = wp_get_theme(); // For use with some settings. Not necessary.

$sport_opt_args = array(

    'opt_name'             => $sport_opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $sport_theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $sport_theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => false,
    // Show the sections below the admin menu item or not
    'menu_title'           => $sport_theme->get( 'Name' ) . esc_html__(' Options', 'sport'),
    'page_title'           => $sport_theme->get( 'Name' ) . esc_html__(' Options', 'sport'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,

    // OPTIONAL -> Give you extra features
    'page_priority'        => 2,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'             =>  array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     =>  array(
            'color'     => 'red',
            'shadow'    =>  true,
            'rounded'   =>  false,
            'style'     =>  '',
        ),
        'tip_position'  =>  array(
            'my'        =>  'top left',
            'at'        =>  'bottom right',
        ),
        'tip_effect'    =>  array(
            'show'      =>  array(
                'effect'    =>  'slide',
                'duration'  =>  '500',
                'event'     =>  'mouseover',
            ),
            'hide'  =>  array(
                'effect'    =>  'slide',
                'duration'  =>  '500',
                'event'     =>  'click mouseleave',
            ),
        ),
    )
);
Redux::setArgs( $sport_opt_name, $sport_opt_args );
/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */

$sport_opt_tabs = array(
    array(
        'id'        =>  'redux-help-tab-1',
        'title'     =>  esc_html__( 'Theme Information 1', 'sport' ),
        'content'   =>  esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'sport' )
    ),
    array(
        'id'        =>  'redux-help-tab-2',
        'title'     =>  esc_html__( 'Theme Information 2', 'sport' ),
        'content'   =>  esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'sport' )
    )
);
Redux::setHelpTab( $sport_opt_name, $sport_opt_tabs );

// Set the help sidebar
$sport_opt_content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'sport' );
Redux::setHelpSidebar( $sport_opt_name, $sport_opt_content );


/*
 * <--- END HELP TABS
 */

/*
 *
 * ---> START SECTIONS
 *
 */

// -> START option background

Redux::setSection( $sport_opt_name, array(
    'id'                =>   'sport_theme_option',
    'title'             =>   $sport_theme->get( 'Name' ).' '.$sport_theme->get( 'Version' ),
    'customizer_width'  =>   '400px',
    'icon'              =>   '',
));

// -> END option background

/* Start General Options */

Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( 'General Options', 'sport' ),
    'id'                =>  'sport_general',
    'desc'              =>  esc_html__( 'General all config', 'sport' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-th-large',
));

// Favicon Config
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Favicon', 'sport' ),
    'id'            =>  'sport_favicon_config',
    'desc'          =>  esc_html__( '', 'sport' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'sport_favicon_upload',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload Favicon Image', 'sport' ),
            'subtitle'  =>  esc_html__( 'Favicon image for your website', 'sport' ),
            'desc'      =>  esc_html__( '', 'sport' ),
            'default'   =>  false,
        ),
    )
));

//Loading config
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Loading config', 'sport' ),
    'id'            =>  'sport_general_loading',
    'desc'          =>  esc_html__( '', 'sport' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'sport_general_show_loading',
            'type'      =>  'switch',
            'title'     =>  esc_html__( 'Loading On/Off', 'sport' ),
            'default'   =>  false,
        ),
        array(
            'id'        =>  'sport_general_image_loading',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload image loading', 'sport' ),
            'subtitle'  =>  esc_html__( 'Upload image .gif', 'sport' ),
            'default'   =>  '',
            'required'  =>  array( 'sport_general_show_loading', '=', true ),
        ),
    )
));

//Background Options
Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( 'Background', 'sport' ),
    'id'                =>  'sport_background',
    'desc'              =>  esc_html__( 'Background all config', 'sport' ),
    'customizer_width'  =>  '400px',
    'subsection'        => true,
    'fields'            => array(
        array(
            'id'        =>  'sport_background_body',
            'output'    =>  'body',
            'type'      =>  'background',
            'clone'     =>  'true',
            'title'     =>  esc_html__( 'Body background', 'sport' ),
            'subtitle'  =>  esc_html__( 'Body background with image, color, etc.', 'sport' ),
            'hint'      =>  array(
                'content'   =>  'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
            )
        ),
    ),
));

/* End General Options */

/* Start Header Options */
Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( 'Header Options', 'sport' ),
    'id'                =>  'sport_header',
    'desc'              =>  esc_html__( 'Header all config', 'sport' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-arrow-up',
));

//Logo Config
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Logo', 'sport' ),
    'id'            =>  'sport_logo_config',
    'desc'          =>  esc_html__( '', 'sport' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'sport_logo_image',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload logo', 'sport' ),
            'subtitle'  =>  esc_html__( 'logo image for your website', 'sport' ),
            'desc'      =>  esc_html__( '', 'sport' ),
            'default'   =>  false,
        ),

        array(
            'id'                => 'sport_logo_images_size',
            'type'              => 'dimensions',
            'units'             => array( 'em', 'px', '%' ),
            'title'             => esc_html__( 'Set width/height for logo', 'sport' ),
            'subtitle'          => esc_html__( '', 'sport' ),
            'units_extended'    => 'true',
            'default'           => array(
                'width'     =>  '',
                'height'    =>  '',
            ),
            'output'         => array('.site-logo img'),
        ),
    )
));

// information
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Contact Us', 'sport' ),
    'id'            =>  'sport_contact_us',
    'desc'          =>  esc_html__( '', 'sport' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'sport_contact_us_phone',
            'type'      =>  'multi_text',
            'title'     =>  esc_html__( 'Phone', 'sport' ),
            'validate'  =>  'not_empty',
        ),

        array(
            'id'        =>  'sport_contact_us_mail',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Mail', 'sport' ),
            'default'   =>  'thethao360.sale@gmail.com',
        ),

        array(
            'id'        =>  'sport_contact_us_zalo',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Zalo Chat', 'sport' ),
            'default'   =>  '0984.187.697',
        ),

    )
));

/* End Header Options */

/* Start Blog Option */
Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( 'Blog Options', 'sport' ),
    'id'                =>  'sport_blog_option',
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-blogger',
    'fields'            =>  array(

        array(
            'id'        =>  'sport_blog_sidebar_archive',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Sidebar Archive', 'sport' ),
            'desc'      =>  esc_html__( 'Use for archive, index, page search', 'sport' ),
            'default'   =>  'right',
            'options'   =>  array(
                'hide' =>  array(
                    'alt'   =>  'None Sidebar',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' =>  array(
                    'alt'   =>  'Sidebar Left',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' =>  array(
                    'alt'   =>  'Sidebar Right',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

        array(
            'id'        =>  'sport_blog_sidebar_single',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Sidebar Single', 'sport' ),
            'default'   =>  'right',
            'options'   =>  array(
                'hide' =>  array(
                    'alt'   =>  'None Sidebar',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' =>  array(
                    'alt'   =>  'Sidebar Left',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' =>  array(
                    'alt'   =>  'Sidebar Right',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

        array(
            'id'        =>  'sport_on_off_share_single',
            'type'      =>  'switch',
            'title'     =>  esc_html__( 'On/Off Share Post Single', 'sport' ),
            'default'   =>  true,
        ),

    )
));
/* End Blog Option */

/* Start Social Network */
Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( 'Social Network', 'sport' ),
    'id'                =>  'sport_social_network',
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-globe-alt',
    'fields'            =>  array(
        array(
            'id'        =>  'sport_social_network_facebook',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Facebook', 'sport' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sport_social_network_twitter',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Twitter', 'sport' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sport_social_network_google-plus',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Google Plus', 'sport' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sport_social_network_linkedin',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Linkedin', 'sport' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sport_social_network_pinterest',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Pinterest', 'sport' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sport_social_network_youtube',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Youtube', 'sport' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sport_social_network_instagram',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Instagram', 'sport' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sport_social_network_vimeo',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Vimeo', 'sport' ),
            'default'   =>  '#',
        ),

    )
));
/* End Social Network */

/* Start Shop */
Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( 'Shop', 'sport' ),
    'id'                =>  'sport_shop_woo',
    'desc'              =>  esc_html__( 'Settings WooCommerce', 'sport' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-shopping-cart',
    'fields'            =>  array(
        array(
            'id'            =>  'sport_product_limit',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Product Limit Page Shop', 'sport' ),
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  250,
            'default'       =>  12,
            'display_value' => 'text'
        ),

        array(
            'id'        =>  'sport_products_per_row',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Products Per Row', 'sport' ),
            'default'   =>  4,
            'options'   =>  array(
                3   =>  '3 Column',
                4   =>  '4 Column',
                5   =>  '5 Column',
            )
        ),

        array(
            'id'        =>  'sport_sidebar_woo',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Position Sidebar Woocommerce', 'sport' ),
            'desc'          =>  esc_html__( 'Position Sidebar Woocommerce', 'sport' ),
            'default'   =>  'left',
            'options'   =>  array(
                'left'  =>  'Left',
                'right' =>  'Right',
                'hide'  =>  'Hide',
            )
        ),

        array(
            'id'        =>  'sport_products_single_tab_guide',
            'type'      =>  'editor',
            'title'     =>  esc_html__( 'Shopping Guide Tab', 'sport' ),
            'default'   =>  '',
            'args'          =>  array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'teeny'         => false,
                'quicktags'     => true,
            )
        ),
    )
));
/* End Shop */

/* Start Typography Options */
Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( 'Typography', 'sport' ),
    'id'                =>  'sport_typography',
    'desc'              =>  esc_html__( 'Typography all config', 'sport' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-fontsize'
));

// Body font
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Body Typography', 'sport' ),
    'id'            =>  'sport_body_typography',
    'desc'          =>  esc_html__( '', 'sport' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'sport_body_typography_font',
            'type'      =>  'typography',
            'output'    =>  array( 'body' ),
            'title'     =>  esc_html__( 'Body Font', 'sport' ),
            'subtitle'  =>  esc_html__( 'Specify the body font properties.', 'sport' ),
            'google'    =>  true,
            'default'   =>  array(
                'color'         =>  '',
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
            ),
        ),

        array(
            'id'        =>  'sport_link_color',
            'type'      =>  'link_color',
            'output'    =>  array( 'a' ),
            'title'     =>  esc_html__( 'Link Color', 'sport' ),
            'subtitle'  =>  esc_html__( 'Controls the color of all text links.', 'sport' ),
            'default'   =>  ''
        ),
    )
));

// Header font
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Custom Typography', 'sport' ),
    'id'            =>  'sport_custom_typography',
    'desc'          =>  esc_html__( '', 'sport' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'sport_custom_typography_1',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 1 Typography', 'sport' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 1.', 'sport' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
        ),

        //selector custom typo 1
        array(
            'id'        =>  'sport_custom_typography_1_selector',
            'type'      =>  'textarea',
            'title'     =>  esc_html__( 'Selectors 1', 'sport' ),
            'desc'      =>  esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'sport' ),
            'default'   =>  ''
        ),

        array(
            'id'        =>  'sport_custom_typography_2',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 2 Typography', 'sport' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 2.', 'sport' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
        ),

        //selector custom typo 2
        array(
            'id'        => 'sport_custom_typography_2_selector',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Selectors 2', 'sport' ),
            'desc'      => esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'sport' ),
            'default'   => ''
        ),

        array(
            'id'        =>  'sport_custom_typography_3',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 3 Typography', 'sport' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 3.', 'sport' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
            'output'    =>  '',
        ),

        //selector custom typo 3
        array(
            'id'        =>  'sport_custom_typography_3_selector',
            'type'      =>  'textarea',
            'title'     =>  esc_html__( 'Selectors 3', 'sport' ),
            'desc'      =>  esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'sport' ),
            'default'   =>  ''
        ),

    )
));

/* End Typography Options */

/* Start 404 Options */
Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( '404 Options', 'sport' ),
    'id'                =>  'sport_404',
    'desc'              =>  esc_html__( '404 page all config', 'sport' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-warning-sign',
    'fields'            =>  array(

        array(
            'id'        =>  'sport_404_background',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( '404 Background', 'sport' ),
            'default'   =>  false,
        ),

        array(
            'id'        =>  'sport_404_title',
            'type'      =>  'text',
            'title'     =>  esc_html__( '404 Title', 'sport' ),
            'default'   =>  'Awww...Do Not Cry',
        ),

        array(
            'id'        =>  'sport_404_editor',
            'type'      =>  'editor',
            'title'     =>  esc_html__( '404 Content', 'sport' ),
            'default'   =>  esc_html__( 'It is just a 404 Error! What you are looking for may have been misplaced in Long Term Memory.', 'sport' ),
            'args'          =>  array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'teeny'         => false,
                'quicktags'     => true,
            )
        ),

    )
));
/* End 404 Options */

/* Start Footer Options */
Redux::setSection( $sport_opt_name, array(
    'title'             =>  esc_html__( 'Footer Options', 'sport' ),
    'id'                =>  'sport_footer',
    'desc'              =>  esc_html__( 'Footer all config', 'sport' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-arrow-down'
));

// Footer Top
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Footer Top', 'sport' ),
    'id'            =>  'sport_footer_top',
    'desc'          =>  esc_html__( 'Option for footer top', 'sport' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'            =>  'sport_footer_top_desc',
            'type'          =>  'editor',
            'title'         =>  esc_html__( 'Enter content footer top desc', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  'Quy trình mua hàng trên  Gym360  hoặc để nhanh nhất và tiết kiệm nhất hãy gọi cho chúng tôi qua : Hotline: 0984.187.697 - 0246.292.1887',
        ),

        // step 1
        array(
            'id'            =>  'sport_footer_top_step1_icon',
            'type'          =>  'media',
            'title'         =>  esc_html__( 'Step 1 icon', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  '',
        ),

        array(
            'id'            =>  'sport_footer_top_step1_text',
            'type'          =>  'text',
            'title'         =>  esc_html__( 'Step 1 text', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  'Khách hàng đặt trên Gym 360',
        ),

        // step 2
        array(
            'id'            =>  'sport_footer_top_step2_icon',
            'type'          =>  'media',
            'title'         =>  esc_html__( 'Step 2 icon', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  '',
        ),

        array(
            'id'            =>  'sport_footer_top_step2_text',
            'type'          =>  'text',
            'title'         =>  esc_html__( 'Step 2 text', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  'Khách hàng nhập thông tin',
        ),

        // step 3
        array(
            'id'            =>  'sport_footer_top_step3_icon',
            'type'          =>  'media',
            'title'         =>  esc_html__( 'Step 3 icon', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  '',
        ),

        array(
            'id'            =>  'sport_footer_top_step3_text',
            'type'          =>  'text',
            'title'         =>  esc_html__( 'Step 3 text', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  'Thanh toán',
        ),

        // step 4
        array(
            'id'            =>  'sport_footer_top_step4_icon',
            'type'          =>  'media',
            'title'         =>  esc_html__( 'Step 4 icon', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  '',
        ),

        array(
            'id'            =>  'sport_footer_top_step4_text',
            'type'          =>  'text',
            'title'         =>  esc_html__( 'Step 4 text', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  'Gym360 xác nhận và vận chuyển',
        ),

        // step 5
        array(
            'id'            =>  'sport_footer_top_step5_icon',
            'type'          =>  'media',
            'title'         =>  esc_html__( 'Step 5 icon', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  '',
        ),

        array(
            'id'            =>  'sport_footer_top_step5_text',
            'type'          =>  'text',
            'title'         =>  esc_html__( 'Step 5 text', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  'Khách hàng xác nhận',
        ),
    )
));


// Footer Sidebar Multi Column
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Sidebar Footer Multi Column', 'sport' ),
    'id'            =>  'sport_footer_sidebar_multi_column',
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'sport_footer_multi_column',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Number of Footer Columns', 'sport' ),
            'subtitle'  =>  esc_html__( 'Controls the number of columns in the footer', 'sport' ),
            'default'   =>  4,
            'options'   =>  array(
                0 =>  array(
                    'alt'   =>  'No Footer',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/no-footer.png' )
                ),

                1 =>  array(
                    'alt'   =>  '1 Columnn',
                    'img'   =>  get_theme_file_uri(  '/extension/assets/images/1column.png' )
                ),

                2 =>  array(
                    'alt'   =>  '2 Columnn',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/2column.png' )
                ),
                3 =>  array(
                    'alt'   =>  '3 Columnn',
                    'img'   =>  get_theme_file_uri(   '/extension/assets/images/3column.png' )
                ),
                4 =>  array(
                    'alt'   =>  '4 Columnn',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/4column.png' )
                ),
            ),
        ),

        array(
            'id'            =>  'sport_footer_multi_column_1',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 1', 'sport' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'sport' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'sport' ),
            'default'       =>  3,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'sport_footer_multi_column', 'equals','1', '2', '3', '4' ),
                array( 'sport_footer_multi_column', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'sport_footer_multi_column_2',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 2', 'sport' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'sport' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'sport' ),
            'default'       =>  3,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'sport_footer_multi_column', 'equals', '2', '3', '4' ),
                array( 'sport_footer_multi_column', '!=', '1' ),
                array( 'sport_footer_multi_column', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'sport_footer_multi_column_3',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 3', 'sport' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'sport' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'sport' ),
            'default'       =>  3,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'sport_footer_multi_column', 'equals', '3', '4' ),
                array( 'sport_footer_multi_column', '!=', '1' ),
                array( 'sport_footer_multi_column', '!=', '2' ),
                array( 'sport_footer_multi_column', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'sport_footer_multi_column_4',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 4', 'sport' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'sport' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'sport' ),
            'default'       =>  3,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'sport_footer_multi_column',  'equals', '4' ),
                array( 'sport_footer_multi_column', '!=', '1' ),
                array( 'sport_footer_multi_column', '!=', '2' ),
                array( 'sport_footer_multi_column', '!=', '3' ),
                array( 'sport_footer_multi_column', '!=', '0' ),
            )
        ),
    )

));

//Copyright
Redux::setSection( $sport_opt_name, array(
    'title'         =>  esc_html__( 'Copyright', 'sport' ),
    'id'            =>  'sport_footer_copyright',
    'desc'          =>  esc_html__( '', 'sport' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'            =>  'sport_footer_copyright_editor',
            'type'          =>  'editor',
            'title'         =>  esc_html__( 'Enter content copyright', 'sport' ),
            'full_width'    =>  true,
            'default'       =>  'Copyright &amp; DiepLK',
            'args'          =>  array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'teeny'         => false,
                'quicktags'     => true,
            )
        ),
    )
));

/* End Footer Options */


/*
 * <--- END SECTIONS
 */

// Function to test the compiler hook and demo CSS output.
add_filter('redux/options/' . $sport_opt_name . '/compiler', 'compiler_action', 10, 3);

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
if ( ! function_exists( 'compiler_action' ) ) {
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        print_r($options); //Option values
        print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }
}
