<?php
global $sport_options;

$sport_contact_us_phone =   $sport_options['sport_contact_us_phone'];
$sport_information_mail =   $sport_options['sport_contact_us_mail'];
$sport_contact_us_zalo  =   $sport_options['sport_contact_us_zalo'];

?>

<div class="contact-us-bar d-flex align-items-center justify-content-lg-center">
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
    </div>
</div>
