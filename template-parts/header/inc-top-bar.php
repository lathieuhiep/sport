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
                <a class="login" href="#">
                    <i class="fas fa-lock"></i>
                    <?php esc_html_e( 'Đăng nhập', 'sport' ); ?>
                </a>

                <a class="register" href="#">
                    <i class="fas fa-user"></i>
                    <?php esc_html_e( 'Đăng kí', 'sport' ); ?>
                </a>
            </div>
        </div>
    </div>
</div>