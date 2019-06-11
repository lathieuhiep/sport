<?php

$sport_term_cat_post = get_the_terms( get_the_ID(), 'category' );

if ( !empty( $sport_term_cat_post ) ):

    $sport_term_cat_post_ids = array();

    foreach( $sport_term_cat_post as $item_cat_post_id ) $sport_term_cat_post_ids[] = $item_cat_post_id->term_id;

    $sport_post_related_arg = array(
        'post_type'         =>  'post',
        'cat'               =>  $sport_term_cat_post_ids,
        'post__not_in'      =>  array( get_the_ID() ),
        'posts_per_page'    =>  3,
    );

    $sport_post_related_query = new WP_Query( $sport_post_related_arg );

    if ( $sport_post_related_query->have_posts() ) :
?>

    <div class="site-single-post-related">
        <h3 class="title">
            <?php esc_html_e( 'Related Post', 'sport' ); ?>
        </h3>

        <div class="row">
            <?php
            while ( $sport_post_related_query->have_posts() ) :
                $sport_post_related_query->the_post();
            ?>

                <div class="col-12 col-sm-6 col-md-4 item">
                    <div class="related-post-item">
                        <figure class="post-image">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </figure>

                        <h4 class="title-post">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <div class="excerpt-post">
                            <p>
                                <?php
                                if( has_excerpt() ) :
                                    echo wp_trim_words( get_the_excerpt(), 15, '...' );
                                else:
                                    echo wp_trim_words( get_the_content(), 15, '...' );
                                endif;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>

<?php
    endif;
endif;