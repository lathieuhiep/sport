<?php

add_filter('rwmb_meta_boxes', 'sport_register_meta_boxes');

function sport_register_meta_boxes()
{

    /* Start meta box post */
    $sport_meta_boxes[] = array(
        'id' => 'post_format_option',
        'title' => esc_html__('Post Format', 'sport'),
        'post_types' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'id' => 'sport_gallery_post',
                'name' => 'Gallery',
                'type' => 'image_advanced',
                'force_delete' => false,
                'max_status' => false,
                'image_size' => 'thumbnail',
            ),

            array(
                'id' => 'sport_video_post',
                'name' => 'Video Or Audio',
                'type' => 'oembed',
            ),


        )
    );
    /* End meta box post */

    /* Start meta box gallery */
    $sport_meta_boxes[] = array(
        'id' => 'gallery_format_option',
        'title' => esc_html__('Gallery Format', 'sport'),
        'post_types' => array('gallery'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'id' => 'sport_images_gallery',
                'name' => esc_html__('Gallery', 'sport'),
                'type' => 'image_advanced',
                'force_delete' => false,
                'max_status' => false,
                'image_size' => 'thumbnail',
            ),

        )
    );
    /* End meta box post */

    /* Start meta box gallery */
    $sport_meta_boxes[] = array(
        'id' => 'product_format_option',
        'title' => esc_html__('Product Format', 'sport'),
        'post_types' => array('product'),
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(

            array(
                'id' => 'sport_option_product_new',
                'name' => esc_html__('Product New', 'sport'),
                'type' => 'select',
                'options' => array(
                    0 => esc_html__('No', 'sport'),
                    1 => esc_html__('Yes', 'sport'),
                ),
            ),
            array(
                'id' => 'sport_option_product_hot',
                'name' => esc_html__('Product Hot', 'sport'),
                'type' => 'select',
                'options' => array(
                    0 => esc_html__('No', 'sport'),
                    1 => esc_html__('Yes', 'sport'),
                ),
            ),
            array(
                'id' => 'sport_option_product_only',
                'name' => esc_html__('Product only today', 'sport'),
                'type' => 'text',
                'placeholder' => esc_html__('Chèn nội dung', 'sport'),
            ),

            array(
                'id' => 'sport_option_product_sale_info',
                'name' => esc_html__('Sale Infomation', 'sport'),
                'type' => 'text',
                'placeholder' => esc_html__('Nội dung thông tin khuyến mãi', 'sport'),
            ),

            array(
                'id' => '_sale_price_dates_to',
                'name' => esc_html__('Count down', 'sport'),
                'type' => 'date',
                'placeholder' => esc_html__('', 'sport'),
            ),

            array(
                'id' => 'sport_option_product_fake_star',
                'name' => esc_html__('Star number (fake)', 'sport'),
                'desc' => esc_html__('Số lượng sao', 'sport'),
                'type' => 'select',
                'options' => array(
                    4 => esc_html__('4', 'sport'),
                    45 => esc_html__('4.5', 'sport'),
                    5 => esc_html__('5', 'sport'),
                ),
            ),
            array(
                'id' => 'sport_option_product_fake_evaluate',
                'name' => esc_html__('Evaluate number (fake)', 'sport'),
                'desc' => esc_html__('Số lượng đánh giá', 'sport'),
                'type' => 'text',
            ),

        )
    );
    /* End meta box gallery */

    /* Start meta box notify */
    $sport_meta_boxes[] = array(
        'id' => 'notify_format_option',
        'title' => esc_html__('Option', 'sport'),
        'post_types' => array('notify'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(

            array(
                'id' => 'sport_option_notify_content',
                'name' => esc_html__('Content', 'sport'),
                'type' => 'textarea',
                'placeholder' => esc_html__('Đã đặt hàng, shop gửi sớm nhé', 'sport'),
            ),

            array(
                'id' => 'sport_option_notify_time_ago',
                'name' => esc_html__('Time Ago', 'sport'),
                'type' => 'text',
                'clone' => false,
                'placeholder' => esc_html__('20 phút trước', 'sport'),
            ),


        )
    );
    /* End meta box post */

    /* Start meta box notify */
    $sport_meta_boxes[] = array(
        'id' => 'fakecomment_format_option',
        'title' => esc_html__('Option', 'sport'),
        'post_types' => array('fakecomment'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(

            array(
                'id' => 'sport_option_fakecomment_star',
                'name' => esc_html__('Star number', 'sport'),
                'type' => 'select',
                'desc' => esc_html__('Chọn số sao hiển thị', 'sport'),
                'placeholder' => esc_html__('Chọn số sao tương ứng', 'sport'),
                'options' => array(
                    4 => '4',
                    '4.5' => '4.5',
                    '5',
                ),
                'std' => '5',
            ),
            array(
                'id' => 'sport_option_fakecomment_date',
                'type' => 'date',
                'name' => esc_html__( 'Chọn ngày hiển thị comment', 'sport' ),
            ),
            array(
                'id' => 'sport_option_fakecomment_like',
                'type' => 'number',
                'name' => esc_html__( 'Like number', 'sport' ),
                'desc' => esc_html__( 'Số lượng lượt thích comment', 'sport' ),
                'std' => '5',
            ),
        )
    );
    /* End meta box post */

    return $sport_meta_boxes;

}