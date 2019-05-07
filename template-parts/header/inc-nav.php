<div class="header-nav">
    <div class="container">
        <div class="header-nav_warp">
            <div class="site-menu collapse navbar-collapse">

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
        </div>
    </div>
</div>