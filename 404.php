<?php
get_header();

global $sport_options;

$sport_title = $sport_options['sport_404_title'];
$sport_content = $sport_options['sport_404_editor'];
$sport_background = $sport_options['sport_404_background']['id'];

?>

<div class="site-error text-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <figure class="site-error__image404">
                    <?php
                    if( !empty( $sport_background ) ):
                        echo wp_get_attachment_image( $sport_background, 'full' );
                    else:
                        echo'<img src="'.esc_url( get_theme_file_uri( '/images/404.jpg' ) ).'" alt="'.get_bloginfo('title').'" />';
                    endif;
                    ?>
                </figure>
            </div>

            <div class="col-md-6">
                <h1 class="site-title-404">
                    <?php
                    if ( $sport_title != '' ):
                        echo esc_html( $sport_title );
                    else:
                        esc_html_e( 'Awww...Do Not Cry', 'sport' );
                    endif;
                    ?>
                </h1>

                <div id="site-error-content">
                    <?php
                    if ( $sport_content != '' ) :
                        echo wp_kses_post( $sport_content );
                    else:
                    ?>
                        <p>
                            <?php esc_html_e( 'It is just a 404 Error!', 'sport' ); ?>
                            <br />
                            <?php esc_html_e( 'What you are looking for may have been misplaced', 'sport' ); ?>
                            <br />
                            <?php esc_html_e( 'in Long Term Memory.', 'sport' ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div id="site-error-back-home">
                    <a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_html__('Go to the Home Page', 'sport'); ?>">
                        <?php esc_html_e('Go to the Home Page', 'sport'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>