<?php
get_header();

global $sport_options;

$sport_blog_sidebar_single = !empty( $sport_options['sport_blog_sidebar_single'] ) ? $sport_options['sport_blog_sidebar_single'] : 'right';

$sport_class_col_content = sport_col_use_sidebar( $sport_blog_sidebar_single, 'sport-sidebar-main' );

?>

<div class="site-container site-single">
    <div class="container">
        <div class="top-archive">
            <div class="breadcrumb">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $sport_class_col_content ); ?>">

                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();

                    get_template_part( 'template-parts/post/content','single' );

                    endwhile;
                endif;
                ?>

            </div>

            <?php
            if($sport_blog_sidebar_single != 'hide'):
            get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

