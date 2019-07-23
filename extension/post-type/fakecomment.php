<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post type fakecomnent
*---------------------------------------------------------------------
*/

add_action('init', 'sport_create_fakecomnent', 10);

function sport_create_fakecomnent() {

    /* Start post type template */
    $labels = array(
        'name'                  =>  _x( 'Fake Comments', 'post type general name', 'sport' ),
        'singular_name'         =>  _x( 'Fake Comments', 'post type singular name', 'sport' ),
        'menu_name'             =>  _x( 'Fake Comments', 'admin menu', 'sport' ),
        'name_admin_bar'        =>  _x( 'All Fake Comments', 'add new on admin bar', 'sport' ),
        'add_new'               =>  _x( 'Add New', 'Fake Comments', 'sport' ),
        'add_new_item'          =>  esc_html__( 'Add New Fake Comments', 'sport' ),
        'edit_item'             =>  esc_html__( 'Edit Fake Comments', 'sport' ),
        'new_item'              =>  esc_html__( 'New Fake Comments', 'sport' ),
        'view_item'             =>  esc_html__( 'View Fake Comments', 'sport' ),
        'all_items'             =>  esc_html__( 'All Fake Comments', 'sport' ),
        'search_items'          =>  esc_html__( 'Search Fake Comments', 'sport' ),
        'not_found'             =>  esc_html__( 'No template found', 'sport' ),
        'not_found_in_trash'    =>  esc_html__( 'No template found in trash', 'sport' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-format-chat',
        'rewrite'            => array('slug' => 'fakecomnent' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title','editor' ),
    );

    register_post_type('fakecomment', $args );
    /* End post type template */

}