<div class="top-bar">
    <div class="container">
        <div class="top-bar__warp d-flex align-items-center justify-content-end">
            <?php if ( has_nav_menu('top-menu') ) : ?>

            <div class="top-menu site-menu-nav">
                <?php

                wp_nav_menu( array(
                    'theme_location' => 'top-menu',
                    'menu_class'     => '',
                    'container'      => false,
                ) ) ;

                ?>
            </div>

            <?php endif; ?>

            <div class="sign-up-bar">

                <?php if (is_user_logged_in()) : ?>

                    <a href="<?php echo wp_logout_url( home_url() ); ?>">
                        <?php esc_html_e( 'Đăng xuất', 'sport' ); ?>
                    </a>

                <?php
                else:

                get_template_part( 'template-parts/sign-form/login' );
                ?>

                    <a class="login login_button" id="show_login" href="#">
                        <i class="fas fa-lock"></i>
                        <?php esc_html_e( 'Đăng nhập', 'sport' ); ?>
                    </a>

                    <a class="register login_button" id="show_signup" href="#">
                        <i class="fas fa-user"></i>
                        <?php esc_html_e( 'Đăng kí', 'sport' ); ?>
                    </a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>