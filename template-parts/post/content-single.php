<?php

global $sport_options;

$sport_on_off_share_single = $sport_options['sport_on_off_share_single'];

?>

<div id="post-<?php the_ID() ?>" <?php post_class( 'site-post-single-item' ); ?>>
    <?php sport_post_formats(); ?>

    <div class="site-post-content">
        <h2 class="site-post-title">
            <?php the_title(); ?>
        </h2>

        <?php sport_post_meta(); ?>

        <div class="site-post-excerpt">
            <?php
            the_content();

            sport_link_page()
            ?>
        </div>

        <div class="site-post-cat-tag">

            <?php if( get_the_category() != false ): ?>

                <p class="site-post-category">
                    <?php
                    esc_html_e('Category: ','sport');
                    the_category( ' ' );
                    ?>
                </p>

            <?php

            endif;

            if( get_the_tags() != false ):

            ?>

                <p class="site-post-tag">
                    <?php
                    esc_html_e( 'Tag: ','sport' );
                    the_tags('',' ');
                    ?>
                </p>

            <?php endif; ?>

        </div>
    </div>

    <?php
    if ( $sport_on_off_share_single == 1 || $sport_on_off_share_single == null ) :

        sport_share();

     endif;
     ?>
</div>

<?php
sport_comment_form();

get_template_part( 'template-parts/post/inc','related-post' );




