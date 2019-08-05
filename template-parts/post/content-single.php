<?php

global $sport_options;

$sport_on_off_share_single = $sport_options['sport_on_off_share_single'];

$tags = get_tags(array(
    'hide_empty' => false
));

?>

    <div id="post-<?php the_ID() ?>" <?php post_class('site-post-single-item'); ?>>
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

            <div class="nav-previous">
                <h6 class="title"><?php echo esc_html__('<< Bài trước','sport'); ?></h6>
                <?php next_post_link('%link', '%title', TRUE); ?>
            </div>

            <div class="nav-next">
                <h6 class="title"><?php echo esc_html__('Bài sau >>','sport'); ?></h6>
                <?php previous_post_link('%link', '%title', TRUE); ?>
            </div>

        </div>

        <?php if ( !empty( $tags ) ) : ?>

        <div class="tag_cloud_on_single all-tags">
            <h2>
                <?php esc_html_e('Thẻ tag', 'sport'); ?>
            </h2>

            <div class="tag-scroll">
                <?php foreach ( $tags as $tag ) : ?>

                    <a title="<?php echo esc_attr( $tag->name ); ?>" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">
                        <?php echo esc_html( $tag->name ); ?>
                    </a>

                <?php endforeach; ?>
            </div>
        </div>

        <?php
        endif;

        get_template_part('template-parts/post/inc', 'related-post');

        if ($sport_on_off_share_single == 1 || $sport_on_off_share_single == null) :

            sport_share();

        endif;
        ?>
    </div>

<?php
//sport_comment_form();





