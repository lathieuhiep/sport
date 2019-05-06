<?php

$sport_gallery_post = get_post_meta( get_the_ID(),'sport_gallery_post', false );

if( !empty( $sport_gallery_post ) ) :

    $sport_slider_settings =   [
        'loop'  =>  true,
        'nav'   =>  true,
        'dots'  =>  true
    ];

?>

    <div class="site-post-slides owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $sport_slider_settings ) ); ?>'>

        <?php foreach( $sport_gallery_post as $item ) : ?>

            <div class="site-post-slides__item">
                <?php echo wp_get_attachment_image( $item, 'full' ); ?>
            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>