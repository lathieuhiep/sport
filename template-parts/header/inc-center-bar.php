<?php
global $sport_options;

$sport_logo_image_id    =   $sport_options['sport_logo_image']['id'];

?>

<div class="center-bar">
    <div class="container">
        <div class="center-bar__box row align-items-center">
            <div class="col-md-3">
                <div class="site-logo d-flex align-items-center">
                    <a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                        <?php
                        if ( !empty( $sport_logo_image_id ) ) :
                            echo wp_get_attachment_image( $sport_logo_image_id, 'full' );
                        else :
                            echo'<img class="logo-default" src="'.esc_url( get_theme_file_uri( '/images/logo.png' ) ).'" alt="'.get_bloginfo('title').'" />';
                        endif;
                        ?>
                    </a>

                    <button class="navbar-toggler" data-toggle="collapse" data-target=".site-menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-5">
                <div class="center-bar__search d-flex align-items-center">
                    <?php get_template_part( 'searchform', 'product' ); ?>
                </div>
            </div>

           <div class="col-md-4 d-flex align-items-center">
               <?php
               get_template_part( 'template-parts/header/inc', 'contact-us' );

               get_template_part( 'template-parts/header/inc', 'cart' );
               ?>
           </div>
        </div>
    </div>
</div>