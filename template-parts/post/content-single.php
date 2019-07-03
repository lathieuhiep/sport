<?php

global $sport_options;

$sport_on_off_share_single = $sport_options['sport_on_off_share_single'];

?>

    <div id="post-<?php the_ID() ?>" <?php post_class('site-post-single-item'); ?>>
        <?php if (get_the_tags() != false): ?>
            <div class="tag_cloud_on_single">
                <?php
                the_tags('', ' ');
                ?>

            </div>
        <?php endif; ?>
        <div class="site-post-content">
            <h1 class="site-post-title">
                <?php the_title(); ?>
            </h1>

            <div class="site-post-excerpt">
                <?php
                the_content();

                sport_link_page()
                ?>
            </div>


        </div>

        <div class="older-post">

            <div class="nav-previous"><?php next_post_link('%link', '<< Bài trước', TRUE); ?></div>

            <div class="nav-next"><?php previous_post_link('%link', 'Bài sau >>', TRUE); ?></div>

        </div>

        <div class="tag_cloud_on_single all-tags">
            <h2><?php echo esc_html__('Thẻ tag', 'sport'); ?></h2>
            <?php

            $tags = get_tags(array(
                'hide_empty' => false
            ));
            foreach ($tags as $tag) {
                echo '<a title="' . $tag->name . '" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
            }
            ?>
        </div>

        <?php get_template_part('template-parts/post/inc', 'related-post'); ?>

        <?php
        if ($sport_on_off_share_single == 1 || $sport_on_off_share_single == null) :

            sport_share();

        endif;
        ?>
    </div>

<?php
//sport_comment_form();





