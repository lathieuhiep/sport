<?php
/*
 * The Header for our theme.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="site-canvas">
    <nav class="site-menu-canvas">
        <?php
        wp_nav_menu( array(
            'theme_location'    =>  'canvas',
            'menu_class'        =>  'navbar-nav',
            'container'         =>  false,
        ) ) ;
        ?>
    </nav>

    <!--Include Loading Template-->
    <?php
    get_template_part('template-parts/inc','loading');

    get_template_part('template-parts/header/inc','header');

    get_template_part('template-parts/inc','notification');

    get_template_part('template-parts/inc','chat');
    ?>
    <!--End Loading Template-->

    <div id="back-top">
        <a href="#">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!--Start Sticky Footer-->
    <div class="sticky-footer">


