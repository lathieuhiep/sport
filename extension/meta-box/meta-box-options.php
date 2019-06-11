<?php

add_filter( 'rwmb_meta_boxes', 'sport_register_meta_boxes' );

function sport_register_meta_boxes() {

    /* Start meta box post */
    $sport_meta_boxes[] = array(
        'id'            =>  'post_format_option',
        'title'         =>  esc_html__( 'Post Format', 'sport' ),
        'post_types'    =>  array( 'post' ),
        'context'       =>  'normal',
        'priority'      =>  'high',
        'fields'        =>  array(

            array(
                'id'               =>   'sport_gallery_post',
                'name'             =>   'Gallery',
                'type'             =>   'image_advanced',
                'force_delete'     =>   false,
                'max_status'       =>   false,
                'image_size'       =>   'thumbnail',
            ),

            array(
                'id'            => 'sport_video_post',
                'name'          => 'Video Or Audio',
                'type'          => 'oembed',
            ),


        )
    );
    /* End meta box post */

    /* Start meta box gallery */
    $sport_meta_boxes[] = array(
        'id'         =>  'gallery_format_option',
        'title'      =>  esc_html__( 'Gallery Format', 'sport' ),
        'post_types' =>  array( 'gallery' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'id'               =>   'sport_images_gallery',
                'name'             =>   esc_html__( 'Gallery', 'sport' ),
                'type'             =>   'image_advanced',
                'force_delete'     =>   false,
                'max_status'       =>   false,
                'image_size'       =>   'thumbnail',
            ),

        )
    );
    /* End meta box post */

    /* Start meta box gallery */
    $sport_meta_boxes[] = array(
        'id'            =>  'product_format_option',
        'title'         =>  esc_html__( 'Product Format', 'sport' ),
        'post_types'    =>  array( 'product' ),
        'context'       =>  'side',
        'priority'      =>  'high',
        'fields'        =>  array(

            array(
                'id'        =>  'sport_option_product_new',
                'name'      =>  esc_html__( 'Product New', 'sport' ),
                'type'      =>  'select',
                'options'   => array(
                    0   =>  esc_html__( 'No', 'sport' ),
                    1   =>  esc_html__( 'Yes', 'sport' ),
                ),
            ),

        )
    );
    /* End meta box post */

    return $sport_meta_boxes;

}