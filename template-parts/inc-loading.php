<?php

global $sport_options;

$sport_show_loading = $sport_options['sport_general_show_loading'] == '' ? '0' : $sport_options['sport_general_show_loading'];

if(  $sport_show_loading == 1 ) :

    $sport_loading_url  = $sport_options['sport_general_image_loading']['url'];
?>

    <div id="site-loadding" class="d-flex align-items-center justify-content-center">

        <?php  if( $sport_loading_url !='' ): ?>

            <img class="loading_img" src="<?php echo esc_url( $sport_loading_url ); ?>" alt="<?php esc_attr_e('loading...','sport') ?>"  >

        <?php else: ?>

            <img class="loading_img" src="<?php echo esc_url(get_theme_file_uri( '/images/loading.gif' )); ?>" alt="<?php esc_attr_e('loading...','sport') ?>">

        <?php endif; ?>

    </div>

<?php endif; ?>