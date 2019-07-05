<div id="form-register" class="sign-form-popup">
    <div class="login_overlay"></div>

    <div class="form-login__box d-flex align-items-center justify-content-center">
        <form id="register" class="ajax-auth"  action="<?php echo esc_url( get_permalink() ); ?>" method="post">
            <div class="header-form d-flex justify-content-between">
                <p class="text-sign">
                    <?php esc_html_e( 'Đăng ký' ); ?>
                </p>

                <a id="pop_login" href="#">
                    <?php esc_html_e( 'Đăng nhập', 'sport' ); ?>
                </a>
            </div>

            <p class="status"></p>

            <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>

            <div class="field-item">
                <input id="signonname" type="text" name="signonname" class="required" placeholder="<?php esc_attr_e( 'Tên đăng nhập', 'sport' ); ?>">
            </div>

            <div class="field-item">
                <input id="email" type="text" class="required email" name="email" placeholder="<?php esc_attr_e( 'Địa chỉ email', 'sport' ); ?>">
            </div>

            <div class="field-item">
                <input id="signonpassword" type="password" class="required" name="signonpassword" placeholder="<?php esc_attr_e( 'Mật khẩu', 'sport' ); ?>">
            </div>

            <div class="field-item">
                <input type="password" id="password2" class="required" name="password2" placeholder="<?php esc_attr_e( 'Xác nhận mật khẩu', 'sport' ); ?>">
            </div>

            <input class="submit_button" type="submit" value="<?php esc_attr_e( 'Đăng ký', 'sport' ); ?>">

            <a class="close" href="#">
                <i class="fas fa-times"></i>
            </a>
        </form>
    </div>
</div>