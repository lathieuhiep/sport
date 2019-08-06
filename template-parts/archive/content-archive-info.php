<div class="site-post-content">

    <div class="post-thumbnail">
        <?php
        sport_post_formats();
        ?>
    </div>
    <div class="post-content">
        <h3 class="site-post-title">
            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                <?php if ( is_sticky() && is_home() ) : ?>
                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                <?php
                endif;

                the_title();
                ?>
            </a>
        </h3>
        <div class="site-post-excerpt">
            <p>
                <?php
                if ( has_excerpt() ) :
                    echo esc_html( get_the_excerpt() );
                else:
                    echo wp_trim_words( get_the_content(), 30, '...' );
                endif;
                ?>
            </p>

            <?php sport_link_page(); ?>

        </div>
    </div>
</div>