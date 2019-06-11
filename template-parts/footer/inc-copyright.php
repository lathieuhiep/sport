<?php
//Global variable redux
global $sport_options;

$sport_copyright = $sport_options ['sport_footer_copyright_editor'] == '' ? 'Copyright &amp; DiepLK' : $sport_options ['sport_footer_copyright_editor'];

?>
<div class="much-search">
    <div class="container">
        <h6><?php echo esc_html__('Tìm kiếm nhiều:','sport'); ?></h6>
        <div class="row">
            <div class="col-md-3">
                <?php
                if ( has_nav_menu('footer-menu-1') ) :
                    wp_nav_menu(array(
                        'theme_location'    =>  'footer-menu-1',
                        'menu_class'        => '',
                        'container'         =>  false,
                    ));
                endif;
                ?>
            </div>
            <div class="col-md-3">
                <?php
                if ( has_nav_menu('footer-menu-2') ) :
                    wp_nav_menu(array(
                        'theme_location'    =>  'footer-menu-2',
                        'menu_class'        => '',
                        'container'         =>  false,
                    ));
                endif;
                ?>
            </div>
            <div class="col-md-3">
                <?php
                if ( has_nav_menu('footer-menu-3') ) :
                    wp_nav_menu(array(
                        'theme_location'    =>  'footer-menu-3',
                        'menu_class'        => '',
                        'container'         =>  false,
                    ));
                endif;
                ?>
            </div>
            <div class="col-md-3">
                <?php
                if ( has_nav_menu('footer-menu-4') ) :
                    wp_nav_menu(array(
                        'theme_location'    =>  'footer-menu-4',
                        'menu_class'        => '',
                        'container'         =>  false,
                    ));
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<div class="site-footer__copyright">
    <div class="container">
        <div class="site-copyright">
            <?php echo wp_kses_post( $sport_copyright ); ?>
        </div>
    </div>
</div>