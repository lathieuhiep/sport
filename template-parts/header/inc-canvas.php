<?php if ( has_nav_menu('canvas') ) : ?>

    <div class="site-menu-canvas d-flex align-items-center">
        <a href="#menu-canvas" class="icon-canvas">
            <i class="fas fa-bars"></i>
        </a>

        <nav id="menu-canvas">
            <?php
            wp_nav_menu( array(
                'theme_location'    =>  'canvas',
                'menu_class'        =>  'navbar-nav',
                'container'         =>  false,
            ) ) ;
            ?>
        </nav>
    </div>

<?php endif; ?>