<?php

global $sport_options;

$sport_blog_sidebar_archive = !empty($sport_options['sport_blog_sidebar_archive']) ? $sport_options['sport_blog_sidebar_archive'] : 'right';

$sport_class_col_content = sport_col_use_sidebar($sport_blog_sidebar_archive, 'sport-sidebar-main');
?>

<div class="site-container site-blog">
    <div class="container">
        <div class="top-archive">
            <div class="breadcrumb">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
        </div>
        <div class="category-desc">
                <?php
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
        </div>

        <div class="tag_cloud_on_single">
            <h2><?php echo esc_html__('Thẻ tag','sport'); ?></h2>
            <?php

            $category = get_the_category();
            $root_cat_of_curr =  $category[0]->category_parent;

            function get_cat_slug($cat_id) {
                $cat_id = (int) $cat_id;
                $category = &get_category($cat_id);
                return $category->slug;
            }

            $my_cat = get_cat_slug($root_cat_of_curr);

            $custom_query = new WP_Query('posts_per_page=-1&category_name='.$my_cat.'');
            if ($custom_query->have_posts()) :
                while ($custom_query->have_posts()) : $custom_query->the_post();
                    $posttags = get_the_tags();
                    if ($posttags) {
                        foreach($posttags as $tag) {
                            $all_tags[] = $tag->term_id;
                        }
                    }
                endwhile;
            endif;

            $tags_arr = array_unique($all_tags);
            $tags_str = implode(",", $tags_arr);

            $args = array(
                'smallest'                  => 12,
                'largest'                   => 24,
                'unit'                      => 'pt',
                'number'                    => 0,
                'format'                    => 'flat',
                'separator'                 => "&nbsp;&nbsp;&nbsp;",
                'orderby'                   => 'name',
                'order'                     => 'RAND',
                'exclude'                   => null,
                'topic_count_text_callback' => '',
                'link'                      => 'view',
                'echo'                      => true,
                'include'                   => $tags_str
            );

            wp_tag_cloud($args);

            ?>

        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="<?php echo esc_attr($sport_class_col_content); ?>">
                <div class="site-post-content">

                    <?php if (have_posts()) : ?>

                        <div class="row">

                            <?php while (have_posts()) : the_post(); ?>

                                <div id="post-<?php the_ID(); ?>" <?php post_class('site-post-item col-12 col-md-6'); ?>>
                                    <?php
                                    if (!is_search()):
                                        get_template_part('template-parts/archive/content', 'archive-info');
                                    else:
                                        get_template_part('template-parts/search/content', 'search-post');
                                    endif;
                                    ?>
                                </div>

                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>

                    <?php

                    else:

                        if (is_search()) :
                            get_template_part('template-parts/search/content', 'search-no-data');
                        endif;

                    endif; // end if ( have_posts )
                    ?>
                </div>

                <?php sport_pagination(); ?>
            </div>

            <?php
            if($sport_blog_sidebar_archive != 'hide'):
            get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>