<?php
global $sport_options;

$sport_information_address   =   $sport_options['sport_information_address'];
$sport_information_mail      =   $sport_options['sport_information_mail'];
$sport_information_phone     =   $sport_options['sport_information_phone'];
?>

<div class="top-bar">
    <div class="container">
        <div class="sign-up-bar text-right">
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