<?php

global $sport_options;

$sport_chat_tel     =   $sport_options['sport_chat_tel'];
$sport_chat_face    =   $sport_options['sport_chat_face'];
$sport_chat_zalo    =   $sport_options['sport_chat_zalo'];

?>

<div class="sprot-chat">
    <a class="item" href="tel:<?php echo esc_attr( $sport_chat_tel ); ?>" target="_blank">
        <img src="<?php echo esc_url( get_theme_file_uri( '/images/call-hotline.png' ) ); ?>" alt="call-hotline">

        <span>
            <?php esc_html_e( 'GỌI HOTLINE', 'sport' ); ?>
        </span>
    </a>

    <a class="item" href="<?php echo esc_url( $sport_chat_face ); ?>" target="_blank">
        <img src="<?php echo esc_url( get_theme_file_uri( '/images/facebook-chat.png' ) ); ?>" alt="facebook">

        <span>
            <?php esc_html_e( 'Chat FB', 'sport' ); ?>
        </span>
    </a>

    <a class="item" href="<?php echo esc_url( $sport_chat_zalo ); ?>" target="_blank">
        <img src="<?php echo esc_url( get_theme_file_uri( '/images/zalo-chat.png' ) ); ?>" alt="zalo">

        <span>
            <?php esc_html_e( 'Chat Zalo', 'sport' ); ?>
        </span>
    </a>
</div>
