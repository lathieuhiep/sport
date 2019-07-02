<form id="login" class="ajax-auth" action="<?php echo esc_url( get_permalink() ); ?>" method="post">
    <div class="header-form d-flex justify-content-between">
        <p class="text-sign">
            <?php esc_html_e( 'Đăng nhập' ); ?>
        </p>

        <a id="pop_signup" href="#">
            <?php esc_html_e( 'Đăng kí', 'sport' ); ?>
        </a>
    </div>

    <p class="status"></p>

    <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>

    <div class="field-item">
        <input id="username" type="text" class="required" name="username" placeholder="<?php esc_attr_e( 'Tên đăng nhập', 'sport' ); ?>">
    </div>

    <div class="field-item">
        <input id="password" type="password" class="required" name="password" placeholder="<?php esc_attr_e( 'Mật khẩu', 'sport' ); ?>">
    </div>

    <div class="d-flex align-items-center justify-content-between">
        <a class="text-link" href="<?php echo wp_lostpassword_url(); ?>">
            <?php esc_html_e( 'Quên mật khẩu', 'sport' ); ?>
        </a>

        <input class="submit_button" type="submit" value="LOGIN">
    </div>

    <a class="close" href="#">
        <i class="fas fa-times"></i>
    </a>
</form>