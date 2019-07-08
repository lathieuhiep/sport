<div class="header-nav">
    <div class="container">
        <div class="header-nav_warp d-flex">
            <?php get_template_part('template-parts/header/inc','canvas'); ?>

            <div class="icon-home-link d-flex align-items-center">
                <a href="<?php echo esc_url( get_home_url('/') ); ?>">
                    <i class="fas fa-home"></i>
                </a>
            </div>

            <button class="navbar-toggler" data-toggle="collapse" data-target=".site-menu">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>

            <div class="site-menu site-menu-nav collapse navbar-collapse">

                <?php

                if ( has_nav_menu('primary') ) :

                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'navbar-nav',
                        'container'      => false,
                    ) ) ;

                else:

                ?>

                    <ul class="main-menu">
                        <li>
                            <a href="<?php echo get_admin_url().'/nav-menus.php'; ?>">
                                <?php esc_html_e( 'ADD TO MENU','sport' ); ?>
                            </a>
                        </li>
                    </ul>

                <?php endif; ?>

            </div>

            <div class="search-nav">
                <span class="item-icon">
                    <i class="fas fa-search"></i>
                </span>

                <div class="search-nav__box">
                    <?php get_template_part( 'searchform', 'product' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>