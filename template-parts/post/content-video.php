<?php

$sport_video_post = get_post_meta(  get_the_ID() , 'sport_video_post', true );

if ( !empty( $sport_video_post ) ):

?>

    <div class="site-post-video">
        <?php echo wp_oembed_get( $sport_video_post ); ?>
    </div>

<?php endif;?>