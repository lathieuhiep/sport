<?php
    global $sport_options;

    $sport_information_show_hide = $sport_options['sport_information_show_hide'] == '' ? 1 : $sport_options['sport_information_show_hide'];
?>

<header id="home" class="header">
    <nav id="navigation" class="navbar-expand-lg">

        <?php
        if ( $sport_information_show_hide == 1 ) :
            get_template_part( 'template-parts/header/inc', 'top-bar' );
        endif;

        get_template_part( 'template-parts/header/inc', 'nav' );
        ?>

    </nav>
</header>