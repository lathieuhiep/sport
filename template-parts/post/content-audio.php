<?php

    $sport_audio = get_post_meta(  get_the_ID() , '_format_audio_embed', true );
    if( $sport_audio != '' ):

?>
        <div class="site-post-audio">

            <?php if( wp_oembed_get( $sport_audio ) ) : ?>

                <?php echo wp_oembed_get( $sport_audio ); ?>

            <?php else : ?>

                <?php echo balanceTags( $sport_audio ); ?>

            <?php endif; ?>

        </div>

<?php endif;?>