<?php
//Global variable redux
global $sport_options;

$sport_footer_multi_column     =   $sport_options ["sport_footer_multi_column"];
$sport_footer_multi_column_l   =   $sport_options ["sport_footer_multi_column_1"];
$sport_footer_multi_column_2   =   $sport_options ["sport_footer_multi_column_2"];
$sport_footer_multi_column_3   =   $sport_options ["sport_footer_multi_column_3"];
$sport_footer_multi_column_4   =   $sport_options ["sport_footer_multi_column_4"];

if( is_active_sidebar( 'sport-sidebar-footer-multi-column-1' ) || is_active_sidebar( 'sport-sidebar-footer-multi-column-2' ) || is_active_sidebar( 'sport-sidebar-footer-multi-column-3' ) || is_active_sidebar( 'sport-sidebar-footer-multi-column-4' ) ) :

?>

    <div class="site-footer__multi--column">
        <div class="container">
            <div class="row">
                <?php
                for( $i = 0; $i < $sport_footer_multi_column; $i++ ):

                    $j = $i +1;

                    if ( $i == 0 ) :
                        $sport_col = $sport_footer_multi_column_l;
                    elseif ( $i == 1 ) :
                        $sport_col = $sport_footer_multi_column_2;
                    elseif ( $i == 2 ) :
                        $sport_col = $sport_footer_multi_column_3;
                    else :
                        $sport_col = $sport_footer_multi_column_4;
                    endif;

                    if( is_active_sidebar( 'sport-sidebar-footer-multi-column-'.$j ) ):
                ?>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( $sport_col ); ?>">

                        <?php dynamic_sidebar( 'sport-sidebar-footer-multi-column-'.$j ); ?>

                    </div>

                <?php
                    endif;

                endfor;
                ?>
            </div>
        </div>
    </div>

<?php endif; ?>