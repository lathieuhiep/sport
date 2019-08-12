<?php
global $sport_options;

$sport_contact_us_phone =   $sport_options['sport_contact_us_phone'];
$sport_information_mail =   $sport_options['sport_contact_us_mail'];
$sport_contact_us_zalo  =   $sport_options['sport_contact_us_zalo'];

?>

<div class="contact-us-bar d-sm-flex align-items-sm-center justify-content-lg-center">
    <div class="contact-us__icon">
        <img src="<?php echo esc_url( get_theme_file_uri( '/images/phone.png' ) ); ?>" alt="contact">
    </div>

    <div class="contact-us__hotline">
        <?php
        if ( !empty( $sport_contact_us_phone ) ) :

            foreach ( $sport_contact_us_phone as $item ) :
        ?>

            <a class="hot-line" href="tel:<?php echo esc_attr( $item ); ?>">
                <?php echo esc_html( $item ); ?>
            </a>

        <?php
            endforeach;

        endif;
        ?>

        <a class="email" href="mailto:<?php echo esc_attr( $sport_information_mail ); ?>">
            <?php esc_html_e( 'Email: ', 'sport' ); echo esc_html( $sport_information_mail ); ?>
        </a>

        <a class="zalo" href="//zalo.me/<?php echo esc_attr( $sport_contact_us_zalo ); ?>">
            <?php esc_html_e( 'Zalo Chat: ', 'sport' ); echo esc_html( $sport_contact_us_zalo ); ?>
        </a>
    </div>
</div>
