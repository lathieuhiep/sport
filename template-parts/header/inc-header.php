<?php

global $sport_options;

$sport_sticky_header = $sport_options['sport_sticky_header'];

?>

<header id="home" class="header<?php echo ( $sport_sticky_header == 1 ? ' sticky-header' : '' ); ?>">
    <?php
    get_template_part( 'template-parts/header/inc', 'top-bar' );

    get_template_part( 'template-parts/header/inc', 'center-bar' );
    ?>
</header>

<nav id="navigation" class="nav-menu navbar-expand-lg">
    <?php get_template_part( 'template-parts/header/inc', 'nav' ); ?>
</nav>