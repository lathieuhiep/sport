<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

        <h2 class="comments-title">

            <?php
            $sport_comments_number = get_comments_number();

            if ( '1' === $sport_comments_number ) :

                /* translators: %s: post title */
                printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'sport' ), get_the_title() );

            else :

                printf(
                /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '%1$s Reply to &ldquo;%2$s&rdquo;',
                        '%1$s Replies to &ldquo;%2$s&rdquo;',
                        $sport_comments_number,
                        'comments title',
                        'sport'
                    ),
                    number_format_i18n( $sport_comments_number ),
                    get_the_title()
                );

            endif;

            ?>

        </h2>

        <?php sport_comment_nav(); ?>

        <ul class="comment-list">

            <?php
            wp_list_comments( array(
                'type'          =>  'comment',
                'short_ping'    =>  true,
                'avatar_size'   =>  60,
                'callback'      =>  'sport_comments'
            ) );
            ?>

        </ul><!-- .comment-list -->

        <?php

            sport_comment_nav();

        endif; // have_comments()

        ?>

    <?php

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :

    ?>

        <p class="no-comments">
            <?php esc_html_e( 'Comments are closed.', 'sport' ); ?>
        </p>

    <?php endif; ?>

    <?php

    $sport_commenter        =   wp_get_current_commenter();
    $sport_req              =   get_option( 'require_name_email' );
    $sport_comments_args    =   ( $sport_req ? " aria-required='true'" : '' );

    $sport_comments_args = array(

        'title_reply'       => '<span>'.esc_html__( 'Leave a comment','sport' ).'</span>',

        'fields' => apply_filters( 'comment_form_default_fields',
            array(

                'comment_notes_before' => '<div class="comment-fields-row order-1"><div class="row">',

                'author' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="author" placeholder="'.esc_html__('Full Name','sport').'" class="form-control" name="author" type="text" value="' . esc_attr( $sport_commenter['comment_author'] ) . '" size="30" ' . $sport_comments_args . ' /></div></div>',

                'email' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="email" placeholder="'.esc_html__('Your Email','sport').'" class="form-control" name="email" type="text" value="' . esc_attr( $sport_commenter['comment_author_email'] ) . '" size="30" ' . $sport_comments_args . ' /></div></div>',

                'comment_notes_after' => '</div></div>',

            )
        ),

        'comment_field' => '<div class="form-comment-item form-comment-field order-3"><textarea rows="7" id="comment" placeholder="'.esc_html__('Comment','sport').'" name="comment" class="form-control"></textarea></div>',

    );

    comment_form( $sport_comments_args );

    ?>

</div><!-- .comments-area -->
