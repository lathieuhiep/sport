<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/*
 *constants
 */
if( !function_exists('sport_setup') ):

    function sport_setup() {

        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        global $content_width;
        if ( ! isset( $content_width ) )
            $content_width = 900;

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'sport', get_parent_theme_file_path( '/languages' ) );

        /**
         * Set up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support post thumbnails.
         *
         */
        add_theme_support( 'custom-header' );

        add_theme_support( 'custom-background' );

        //Enable support for Post Thumbnails
        add_theme_support('post-thumbnails');

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menu('top-menu','Top Menu');
        register_nav_menu('primary','Primary Menu');
        register_nav_menu('canvas','Canvas Menu');
        register_nav_menu('footer-menu-1','Cột 1 tìm kiếm nhiều');
        register_nav_menu('footer-menu-2','Cột 2 tìm kiếm nhiều');
        register_nav_menu('footer-menu-3','Cột 3 tìm kiếm nhiều');
        register_nav_menu('footer-menu-4','Cột 4 tìm kiếm nhiều');

        // add theme support title-tag
        add_theme_support( 'title-tag' );

        /*  Post Type   */
        add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

        /*
	    * This theme styles the visual editor to resemble the theme style,
	    * specifically font, colors, icons, and column width.
	    */
        add_editor_style( array( 'css/editor-style.css', sport_fonts_url()) );
    }

    add_action( 'after_setup_theme', 'sport_setup' );

endif;

/*
 * post formats
 * */
function sport_post_formats() {

    if( has_post_format('audio') || has_post_format('video') ):
        get_template_part( 'template-parts/post/content','video' );
    elseif ( has_post_format('gallery') ):
        get_template_part( 'template-parts/post/content','gallery' );
    else:
        get_template_part( 'template-parts/post/content','image' );
    endif;

}

/*
* Required: include plugin theme scripts
*/
require get_parent_theme_file_path( '/extension/process-option.php' );

if ( class_exists( 'ReduxFramework' ) ) {
    /*
     * Required: Redux Framework
     */
    require get_parent_theme_file_path( '/extension/option-reudx/theme-options.php' );
}

if ( class_exists( 'RW_Meta_Box' ) ) {
    /*
     * Required: Meta Box Framework
     */
    require get_parent_theme_file_path( '/extension/meta-box/meta-box-options.php' );

}

if ( ! function_exists( 'rwmb_meta' ) ) {

    function rwmb_meta( $key, $args = '', $post_id = null ) {
        return false;
    }

}

if ( did_action( 'elementor/loaded' ) ) :
    /*
     * Required: Elementor
     */
    require get_parent_theme_file_path( '/extension/elementor/elementor.php' );

    require get_parent_theme_file_path( '/extension/elementor/function-elementor.php' );

endif;

/* Require Widgets */
foreach(glob( get_parent_theme_file_path( '/extension/widgets/*.php' ) ) as $sport_file_widgets ) {
    require $sport_file_widgets;
}

/* Start Require Post type */
require get_parent_theme_file_path( '/extension/post-type/gallery.php' );
require get_parent_theme_file_path( '/extension/post-type/notification.php' );
/* End Require Post type */


if ( class_exists('Woocommerce') ) :
    /*
     * Required: Woocommerce
     */
    require get_parent_theme_file_path( '/extension/woocommerce/woo-register-tax.php' );
    require get_parent_theme_file_path( '/extension/woocommerce/woo-template-hooks.php' );
    require get_parent_theme_file_path( '/extension/woocommerce/woo-template-functions.php' );
    require get_parent_theme_file_path( '/extension/woocommerce/woo-term-function.php' );

endif;

/**
 * Register Sidebar
 */
add_action( 'widgets_init', 'sport_widgets_init');

function sport_widgets_init() {

    $sport_widgets_arr  =   array(

        'sport-sidebar-main'    =>  array(
            'name'              =>  esc_html__( 'Sidebar Main', 'sport' ),
            'description'       =>  esc_html__( 'Display sidebar right or left on all page.', 'sport' )
        ),

        'sport-sidebar-wc' =>  array(
            'name'              =>  esc_html__( 'Sidebar Woocommerce', 'sport' ),
            'description'       =>  esc_html__( 'Display sidebar on page shop.', 'sport' )
        ),

        'sport-sidebar-footer-multi-column-1'   =>  array(
            'name'              =>  esc_html__( 'Sidebar Footer Multi Column 1', 'sport' ),
            'description'       =>  esc_html__('Display footer column 1 on all page.', 'sport' )
        ),

        'sport-sidebar-footer-multi-column-2'   =>  array(
            'name'              =>  esc_html__( 'Sidebar Footer Multi Column 2', 'sport' ),
            'description'       =>  esc_html__('Display footer column 2 on all page.', 'sport' )
        ),

        'sport-sidebar-footer-multi-column-3'   =>  array(
            'name'              =>  esc_html__( 'Sidebar Footer Multi Column 3', 'sport' ),
            'description'       =>  esc_html__('Display footer column 3 on all page.', 'sport' )
        ),

        'sport-sidebar-footer-multi-column-4'   =>  array(
            'name'              =>  esc_html__( 'Sidebar Footer Multi Column 4', 'sport' ),
            'description'       =>  esc_html__('Display footer column 4 on all page.', 'sport' )
        )

    );

    foreach ( $sport_widgets_arr as $sport_widgets_id => $sport_widgets_value ) :

        register_sidebar( array(
            'name'          =>  esc_attr( $sport_widgets_value['name'] ),
            'id'            =>  esc_attr( $sport_widgets_id ),
            'description'   =>  esc_attr( $sport_widgets_value['description'] ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<h2 class="widget-title">',
            'after_title'   =>  '</h2>'
        ));

    endforeach;

}

// Remove jquery migrate
add_action( 'wp_default_scripts', 'sport_remove_jquery_migrate' );
function sport_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}

// Check deregister styles
add_action( 'wp_print_styles', 'logi_deregister_styles', 100 );
function logi_deregister_styles() {

    wp_deregister_style('font-awesome');

}

//Register Back-End script
add_action('admin_enqueue_scripts', 'sport_register_back_end_scripts');

function sport_register_back_end_scripts(){

    /* Start Get CSS Admin */
    wp_enqueue_style( 'sport-admin-styles', get_theme_file_uri( '/extension/assets/css/admin-styles.css' ) );

}

//Register Front-End Styles
add_action('wp_enqueue_scripts', 'sport_register_front_end');

function sport_register_front_end() {

    /*
    * Start Get Css Front End
    * */
    wp_enqueue_style( 'sport-fonts', sport_fonts_url(), array(), null );

    /* Start main Css */
    wp_enqueue_style( 'sport-library', get_theme_file_uri( '/css/library.min.css' ), array(), '' );
    /* End main Css */

    /*  Start Style Css   */
    wp_enqueue_style( 'sport-style', get_stylesheet_uri() );
    /*  Start Style Css   */
    wp_enqueue_style( 'hungkv-style', get_theme_file_uri( '/css/hungkv.css' ), array(), '' );
    /* Start hungkv.css */

    /* End hungkv.css */

    /*
    * End Get Css Front End
    * */

    /*
    * Start Get Js Front End
    * */

    // Load the html5 shiv.
    wp_enqueue_script( 'html5', get_theme_file_uri( '/js/html5.js' ), array(), '3.7.3' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'sport-main', get_theme_file_uri( '/js/main.min.js' ), array('jquery'), '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'mmenu', get_theme_file_uri( '/js/library/mmenu.js' ), array('jquery'), '', true );

    wp_enqueue_script( 'sport-custom', get_theme_file_uri( '/js/custom.js' ), array(), '1.0.0', true );

    /* Notification */
    wp_enqueue_script( 'notification', get_theme_file_uri( '/js/notification.js' ), array(), '1.0.0', true );

    $sport_notification_admin_url    =   admin_url( 'admin-ajax.php' );
    $sport_notification_ajax         =   array( 'url' => $sport_notification_admin_url );
    wp_localize_script( 'notification', 'load_notification', $sport_notification_ajax );

    /* Login */
    if ( !is_user_logged_in() ) :

        wp_enqueue_script( 'jquery-validate', get_theme_file_uri( '/js/library/jquery.validate.js' ), array('jquery'), '1.19.1', true );

        wp_enqueue_script( 'ajax-auth-script', get_theme_file_uri( '/js/ajax-auth-script.js' ), array(), '1.0.0', true );

        wp_localize_script( 'ajax-auth-script', 'ajax_auth_object', array(
            'ajaxurl'           =>  admin_url( 'admin-ajax.php' ),
            'redirecturl'       =>  home_url(),
            'loadingmessage'    =>  esc_html__( 'Đang gửi thông tin, vui lòng chờ...', 'sport' )
        ));

    endif;

    /* Woocommerce */
    if ( class_exists('Woocommerce') ) :

        if ( is_shop() || is_product_category() ) :

            wp_enqueue_script( 'shop-cat', get_theme_file_uri( '/js/shop-cat.js' ), array(), '1.0.0', true );

            $sport_woo_cat_admin_url    =   admin_url( 'admin-ajax.php' );
            $sport_woo_cat_ajax         =   array( 'url' => $sport_woo_cat_admin_url );
            wp_localize_script( 'shop-cat', 'load_product_cat', $sport_woo_cat_ajax );

        endif;

    endif;

    /*
   * End Get Js Front End
   * */

}

/**
 * Show full editor
 */
if ( !function_exists('sport_ilc_mce_buttons') ) :

    function sport_ilc_mce_buttons( $sport_buttons_TinyMCE ) {

        array_push( $sport_buttons_TinyMCE,
                "backcolor",
                "anchor",
                "hr",
                "sub",
                "sup",
                "fontselect",
                "fontsizeselect",
                "styleselect",
                "cleanup"
            );

        return $sport_buttons_TinyMCE;

    }

    add_filter("mce_buttons_2", "sport_ilc_mce_buttons");

endif;

// Start Customize mce editor font sizes
if ( ! function_exists( 'sport_mce_text_sizes' ) ) :

    function sport_mce_text_sizes( $sport_font_size_text ){
        $sport_font_size_text['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 17px 18px 19px 20px 21px 24px 28px 32px 36px";
        return $sport_font_size_text;
    }

    add_filter( 'tiny_mce_before_init', 'sport_mce_text_sizes' );

endif;
// End Customize mce editor font sizes

/* callback comment list */
function sport_comments( $sport_comment, $sport_comment_args, $sport_comment_depth ) {

    if ( 'div' === $sport_comment_args['style'] ) :

        $sport_comment_tag       = 'div';
        $sport_comment_add_below = 'comment';

    else :

        $sport_comment_tag       = 'li';
        $sport_comment_add_below = 'div-comment';

    endif;

?>
    <<?php echo $sport_comment_tag ?> <?php comment_class( empty( $sport_comment_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <?php if ( 'div' != $sport_comment_args['style'] ) : ?>

        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">

    <?php endif; ?>

    <div class="comment-author vcard">
        <?php if ( $sport_comment_args['avatar_size'] != 0 ) echo get_avatar( $sport_comment, $sport_comment_args['avatar_size'] ); ?>

    </div>

    <?php if ( $sport_comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation">
            <?php esc_html_e( 'Your comment is awaiting moderation.', 'sport' ); ?>
        </em>
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <div class="comment-meta-box">
             <span class="name">
                <?php comment_author_link(); ?>
            </span>
            <span class="comment-metadata">
                <?php comment_date(); ?>
            </span>

            <?php edit_comment_link( esc_html__( 'Edit ', 'sport' ) ); ?>

            <?php comment_reply_link( array_merge( $sport_comment_args, array( 'add_below' => $sport_comment_add_below, 'depth' => $sport_comment_depth, 'max_depth' => $sport_comment_args['max_depth'] ) ) ); ?>

        </div>
        <div class="comment-text-box">
            <?php comment_text(); ?>
        </div>
    </div>

    <?php if ( 'div' != $sport_comment_args['style'] ) : ?>
        </div>
    <?php endif; ?>

<?php
}
/* callback comment list */

if ( ! function_exists( 'sport_fonts_url' ) ) :

    function sport_fonts_url() {
        $sport_fonts_url = '';

        /* Translators: If there are characters in your language that are not
        * supported by Open Sans, translate this to 'off'. Do not translate
        * into your own language.
        */
        $sport_font_google = _x( 'on', 'Google font: on or off', 'sport' );

        if ( 'off' !== $sport_font_google ) {
            $sport_font_families = array();

            if ( 'off' !== $sport_font_google ) {
                $sport_font_families[] = 'Roboto:400,500,700';
            }

            $sport_query_args = array(
                'family' => urlencode( implode( '|', $sport_font_families ) ),
                'subset' => urlencode( 'latin,vietnamese' ),
            );

            $sport_fonts_url = add_query_arg( $sport_query_args, 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw( $sport_fonts_url );
    }

endif;

/*
 * Content Nav
 */

if ( ! function_exists( 'sport_comment_nav' ) ) :

    function sport_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

    ?>
            <nav class="navigation comment-navigation">
                <h2 class="screen-reader-text">
                    <?php _e( 'Comment navigation', 'sport' ); ?>
                </h2>
                <div class="nav-links">
                    <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'sport' ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'sport' ) ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->

    <?php
        endif;
    }

endif;

/*
 * TWITTER AMPERSAND ENTITY DECODE
 */
if( ! function_exists( 'sport_social_title' )):

    function sport_social_title( $sport_title ) {

        $sport_title = html_entity_decode( $sport_title );
        $sport_title = urlencode( $sport_title );

        return $sport_title;

    }

endif;

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_parent_theme_file_path( '/plugins/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'sport_register_required_plugins' );
function sport_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $sport_plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Redux Framework',
            'slug'      =>  'redux-framework',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Meta Box',
            'slug'      =>  'meta-box',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Elementor',
            'slug'      =>  'elementor',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Woocommerce',
            'slug'      =>  'woocommerce',
            'required'  =>  true,
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $sport_config = array(
        'id'           => 'sport',          // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $sport_plugins, $sport_config );
}

/* Start Social Network */
function sport_get_social_url() {

    global $sport_options;
    $sport_social_networks = sport_get_social_network();

    foreach( $sport_social_networks as $sport_social ) :
        $sport_social_url = $sport_options['sport_social_network_' . $sport_social['id']];

        if( $sport_social_url ) :
?>

        <div class="social-network-item item-<?php echo esc_attr( $sport_social['id'] ); ?>">
            <a href="<?php echo esc_url( $sport_social_url ); ?>">
                <i class="fa fa-<?php echo esc_attr( $sport_social['id'] ); ?>" aria-hidden="true"></i>
            </a>
        </div>


<?php
        endif;

    endforeach;
}

function sport_get_social_network() {
    return array(

        array('id' => 'facebook', 'title' => 'Facebook'),
        array('id' => 'twitter', 'title' => 'Twitter'),
        array('id' => 'google-plus', 'title' => 'Google Plus'),
        array('id' => 'linkedin', 'title' => 'linkedin'),
        array('id' => 'pinterest', 'title' => 'Pinterest'),
        array('id' => 'youtube', 'title' => 'Youtube'),
        array('id' => 'instagram', 'title' => 'instagram'),
        array('id' => 'vimeo', 'title' => 'Vimeo'),

    );
}
/* End Social Network */

/* Start pagination */
function sport_pagination() {

    the_posts_pagination( array(
        'type' => 'list',
        'mid_size' => 2,
        'prev_text' => esc_html__( 'Previous', 'sport' ),
        'next_text' => esc_html__( 'Next', 'sport' ),
        'screen_reader_text' => esc_html__( '&nbsp;', 'sport' ),
    ) );

}

// pagination nav query
function sport_paging_nav_query( $sport_querry ) {

    $sport_pagination_args  =   array(

        'prev_text' => '<i class="fa fa-angle-double-left"></i>' . esc_html__(' Previous', 'sport' ),
        'next_text' => esc_html__('Next', 'sport' ) . '<i class="fa fa-angle-double-right"></i>',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $sport_querry -> max_num_pages,
        'type'      => 'list',

    );

    $sport_paginate_links = paginate_links( $sport_pagination_args );

    if ( $sport_paginate_links ) :

    ?>
        <nav class="pagination">
            <?php echo $sport_paginate_links; ?>
        </nav>

    <?php

    endif;

}

/* End pagination */

// Sanitize Pagination
add_action('navigation_markup_template', 'sport_sanitize_pagination');
function sport_sanitize_pagination( $sport_content ) {
    // Remove role attribute
    $sport_content = str_replace('role="navigation"', '', $sport_content);

    // Remove h2 tag
    $sport_content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $sport_content);

    return $sport_content;
}

/* Start Get col global */
function sport_col_use_sidebar( $option_sidebar, $active_sidebar ) {

    if ( $option_sidebar != 'hide' && is_active_sidebar( $active_sidebar ) ):

        if ( $option_sidebar == 'left' ) :
            $class_position_sidebar = ' order-1';
        else:
            $class_position_sidebar = '';
        endif;

        $class_col_content = 'col-12 col-md-8 col-lg-9' . $class_position_sidebar;
    else:
        $class_col_content = 'col-md-12';
    endif;

    return $class_col_content;
}

function sport_col_sidebar() {
    $class_col_sidebar = 'col-12 col-md-4 col-lg-3';

    return $class_col_sidebar;
}
/* End Get col global */

function sport_share() {

?>

    <div class="site-post-share">
        <span>
            <?php  esc_html_e('Chia sẻ:', 'sport') ; ?>
        </span>

        <!-- Facebook Button -->
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
            <i class="fa fa-facebook"></i>
        </a>

        <a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php print sport_social_title( get_the_title() ); ?>%20-%20<?php the_permalink(); ?>">
            <i class="fa fa-twitter"></i>
        </a>

        <?php $sport_pin_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() )); ?>

        <a data-pin-do="skipLink" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url( $sport_pin_image ); ?>&description=<?php the_title(); ?>">
            <i class="fa fa-pinterest"></i>
        </a>

        <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
            <i class="fa fa-google-plus"></i>
        </a>
    </div>

<?php
}

/* Start Post Meta */
    function sport_post_meta() {
?>

        <div class="site-post-meta">
            <span class="site-post-author">
                <?php echo esc_html__('Author:','sport');?>
                <a href="<?php echo get_author_posts_url( get_the_author_meta('ID') );?>">
                    <?php the_author();?>
                </a>
            </span>

            <span class="site-post-date">
                <?php esc_html_e( 'Post date: ','sport' ); the_date(); ?>
            </span>

            <span class="site-post-comments">
                <?php
                comments_popup_link( '0 '. esc_html__('Comment','sport'),'1 '. esc_html__('Comment','sport'), '% '. esc_html__('Comments','sport') );
                ?>
            </span>
        </div>

<?php
    }
/* End Post Meta */

/* Start Link Pages */
function sport_link_page() {

    wp_link_pages( array(
        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'sport' ),
        'after'       => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
    ) );

}
/* End Link Pages */

/* Start comment */
function sport_comment_form() {

    if ( comments_open() || get_comments_number() ) :
?>

        <div class="site-comments">
            <?php comments_template( '', true ); ?>
        </div>

<?php
    endif;
}
/* End comment */

/* Start notification */
function sport_notification() {

    $args = array(
        'post_type'             =>  'notify',
        'posts_per_page'        =>  1,
        'orderby'               =>  'rand',
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) :
            $query->the_post();

            $notify_content     =   rwmb_meta( 'sport_option_notify_content' );
            $notify_time_ago    =   rwmb_meta( 'sport_option_notify_time_ago' );

    ?>

        <div class="item d-flex">
            <div class="item-thumbnail">
                <?php the_post_thumbnail( array( '90', '90' ) ); ?>
            </div>

            <div class="item-content">
                <h5 class="item-title">
                    <?php the_title(); ?>
                </h5>

                <div class="info">
                    <p class="des">
                        <?php echo esc_html( wp_trim_words( $notify_content, 15, '...' ) ); ?>
                    </p>

                    <p class="titme-ago">
                        <?php echo esc_html( $notify_time_ago ); ?>
                    </p>
                </div>
            </div>
        </div>

    <?php

        endwhile;
        wp_reset_postdata();

    endif;

}

// ajax notification
add_action( 'wp_ajax_sport_notification_ajax', 'sport_notification_ajax' );
add_action( 'wp_ajax_nopriv_sport_notification_ajax', 'sport_notification_ajax' );

function sport_notification_ajax() {

    sport_notification();

    exit();

}
/* End notification */

// Enable the user with no privileges to run ajax_login() in AJAX
add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    // Call auth_user_login
    auth_user_login( $_POST['username'], $_POST['password'], $_POST['username'] );

    die();
}

// Enable the user with no privileges to run ajax_register() in AJAX
add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
function ajax_register() {

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
    $info['user_pass'] = sanitize_text_field($_POST['password']);
    $info['user_email'] = sanitize_email( $_POST['email']);

    // Register the user
    $user_register = wp_insert_user( $info );
    if ( is_wp_error($user_register) ){
        $error  = $user_register->get_error_codes() ;

        if(in_array('empty_user_login', $error))
            echo json_encode(array('loggedin'=>false, 'message' => __($user_register->get_error_message('empty_user_login'))));
        elseif(in_array('existing_user_login',$error))
            echo json_encode( array('loggedin'=>false, 'message' => esc_html__( 'Tên người dùng này đã được đăng ký', 'sport' ) ) );
        elseif(in_array('existing_user_email',$error))
            echo json_encode(array('loggedin'=>false, 'message' =>  esc_html__('Email này đã được dùng.')));
    } else {
        auth_user_login( $info['nickname'], $info['user_pass'], 'Đăng kí tài khoản' );
    }

    die();
}

function auth_user_login( $user_login, $password, $login ) {
    $info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;

    $user_signon = wp_signon( $info, '' );

    if ( is_wp_error( $user_signon ) ) :

        echo json_encode( array( 'loggedin' => false, 'message' => esc_html__( 'Sai tên đăng nhập hoặc mật khẩu', 'sport' ) ) );

    else :

        wp_set_current_user( $user_signon->ID );

        echo json_encode( array( 'loggedin' => true, 'message' => $login . esc_html__( ' đăng nhập thành công, xin chờ...', 'sport' ) ) );

    endif;

    die();
}