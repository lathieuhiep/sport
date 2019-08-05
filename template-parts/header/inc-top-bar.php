<div class="top-bar">
    <div class="container">
        <div class="top-bar__warp d-flex align-items-center justify-content-between justify-content-lg-end">
            <?php if ( has_nav_menu('top-menu') ) : ?>

                <nav class="navbar-expand-lg navbar-tob-bar">
                    <button class="navbar-toggler" data-toggle="collapse" data-target=".top-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>

                        <span class="nav-text">
                            <?php esc_html_e( 'Giới Thiệu', 'sport' ); ?>
                        </span>
                    </button>

                    <div id="nav-top-bar" class="top-menu site-menu-nav collapse navbar-collapse">
                        <?php

                        wp_nav_menu( array(
                            'theme_location' => 'top-menu',
                            'menu_class'     => '',
                            'container'      => false,
                        ) ) ;

                        ?>
                    </div>
                </nav>

            <?php endif; ?>

            <div class="sign-up-bar d-flex">

                <?php
                if ( is_user_logged_in() ) :

                    $sport_current_user = wp_get_current_user();

                ?>

                    <a class="site-text-login" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_attr_e( 'Tài khoản của tôi','sport' ); ?>">
                        <i class="fas fa-user-circle"></i>
                        <?php echo esc_html( $sport_current_user -> user_login ); ?>
                    </a>

                    <div class="dropdown-account-box">
                        <span class="dropdown-toggle-account" id="drop-down-my-account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-caret-down"></i>
                        </span>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="drop-down-my-acount">
                            <?php do_action( 'woocommerce_account_navigation' ); ?>
                        </div>
                    </div>

                <?php else: ?>

                    <a class="login login_button" id="show_login" href="#">
                        <i class="fas fa-lock"></i>
                        <?php esc_html_e( 'Đăng nhập', 'sport' ); ?>
                    </a>

                    <a class="register login_button" id="show_signup" href="#">
                        <i class="fas fa-user"></i>
                        <?php esc_html_e( 'Đăng kí', 'sport' ); ?>
                    </a>

                    <?php
                    get_template_part( 'template-parts/sign-form/login' );

                    get_template_part( 'template-parts/sign-form/register' );
                    ?>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>