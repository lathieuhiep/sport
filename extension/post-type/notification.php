<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post type gallery
*---------------------------------------------------------------------
*/

add_action('init', 'sport_create_notification', 10);

function sport_create_notification() {

    /* Start post type template */
    $labels = array(
        'name'                  =>  _x( 'Notifications', 'post type general name', 'sport' ),
        'singular_name'         =>  _x( 'Notifications', 'post type singular name', 'sport' ),
        'menu_name'             =>  _x( 'Notifications', 'admin menu', 'sport' ),
        'name_admin_bar'        =>  _x( 'All Notifications', 'add new on admin bar', 'sport' ),
        'add_new'               =>  _x( 'Add New', 'Notifications', 'sport' ),
        'add_new_item'          =>  esc_html__( 'Add New Notification', 'sport' ),
        'edit_item'             =>  esc_html__( 'Edit Notification', 'sport' ),
        'new_item'              =>  esc_html__( 'New Notification', 'sport' ),
        'view_item'             =>  esc_html__( 'View Notification', 'sport' ),
        'all_items'             =>  esc_html__( 'All Notification', 'sport' ),
        'search_items'          =>  esc_html__( 'Search Notification', 'sport' ),
        'not_found'             =>  esc_html__( 'No template found', 'sport' ),
        'not_found_in_trash'    =>  esc_html__( 'No template found in trash', 'sport' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'            =>  $labels,
        'public'            =>  true,
        'show_ui'           =>  true,
        'show_in_menu'      =>  true,
        'query_var'         =>  true,
        'menu_icon'         =>  'dashicons-warning',
        'rewrite'           =>  array('slug' => 'notify' ),
        'capability_type'   =>  'post',
        'has_archive'       =>  true,
        'hierarchical'      =>  true,
        'menu_position'     =>  5,
        'supports'          =>  array( 'title', 'thumbnail' ),
    );

    register_post_type('notify', $args );
    /* End post type template */

}