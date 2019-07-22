<?php

$sport_term_cat_post = get_the_terms( get_the_ID(), 'category' );

if ( !empty( $sport_term_cat_post ) ):

    $sport_term_cat_post_ids = array();

    foreach( $sport_term_cat_post as $item_cat_post_id ) $sport_term_cat_post_ids[] = $item_cat_post_id->term_id;

    $sport_post_related_arg = array(
        'post_type'         =>  'post',
        'cat'               =>  $sport_term_cat_post_ids,
        'post__not_in'      =>  array( get_the_ID() ),
        'posts_per_page'    =>  '',
    );

    $sport_post_related_query = new WP_Query( $sport_post_related_arg );

    if ( $sport_post_related_query->have_posts() ) :
?>

    <div class="site-single-post-related blog-post-product">
        <h3 class="title">
            <?php esc_html_e( 'Bài viết liên quan', 'sport' ); ?>
        </h3>


        <div class="blog-product-slider owl-carousel owl-theme">

            <?php
            $i = 1;
            $total_posts = $sport_post_related_query->post_count;
            $number_item = 4;
            while ($sport_post_related_query->have_posts()):
                $sport_post_related_query->the_post();

                if ($i % $number_item == 1) :
                    ?>

                    <div class="row">

                <?php endif; ?>

                <div class="col-md-6 item-col">
                    <div class="item d-sm-flex">
                        <div class="item-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>

                        <div class="item-content">
                            <h4 class="item-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

                            <p class="item-excerpt">
                                <?php
                                if (has_excerpt()) :
                                    echo wp_trim_words(get_the_excerpt(), 30, '...');
                                else:
                                    echo wp_trim_words(get_the_content(), 30, '...');
                                endif;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <?php if ($i % $number_item == 0 || $i == $total_posts) : ?>

                </div>

            <?php
            endif;

                $i++;
            endwhile;
            wp_reset_postdata(); ?>

        </div>
    </div>

<?php
    endif;
endif;