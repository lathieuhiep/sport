<?php
global $sport_options;

$sport_logo_image_id    =   $sport_options['sport_logo_image']['id'];

?>

<div class="center-bar">
    <div class="container">
        <div class="center-bar__box row">
            <div class="col-3 col-sm-4 col-lg-3">
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
                </div>
            </div>

            <div class="col-lg-5 d-lg-flex align-items-lg-center col-search">
                <div class="center-bar__search">
                    <?php get_template_part( 'searchform', 'product' ); ?>
                </div>
            </div>

           <div class="col-9 col-sm-8 col-lg-4 d-flex">
               <div class="d-flex justify-content-between contact-cart">
                   <?php
                   get_template_part( 'template-parts/header/inc', 'contact-us' );

                   get_template_part( 'template-parts/header/inc', 'cart' );
                   ?>
               </div>
           </div>
        </div>
    </div>
</div>