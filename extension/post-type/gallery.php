<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post type gallery
*---------------------------------------------------------------------
*/

add_action('init', 'sport_create_gallery', 10);

function sport_create_gallery() {

    /* Start post type template */
    $labels = array(
        'name'                  =>  _x( 'Galleries', 'post type general name', 'sport' ),
        'singular_name'         =>  _x( 'Galleries', 'post type singular name', 'sport' ),
        'menu_name'             =>  _x( 'Galleries', 'admin menu', 'sport' ),
        'name_admin_bar'        =>  _x( 'All Galleries', 'add new on admin bar', 'sport' ),
        'add_new'               =>  _x( 'Add New', 'Galleries', 'sport' ),
        'add_new_item'          =>  esc_html__( 'Add New Gallery', 'sport' ),
        'edit_item'             =>  esc_html__( 'Edit Gallery', 'sport' ),
        'new_item'              =>  esc_html__( 'New Gallery', 'sport' ),
        'view_item'             =>  esc_html__( 'View Gallery', 'sport' ),
        'all_items'             =>  esc_html__( 'All Galleries', 'sport' ),
        'search_items'          =>  esc_html__( 'Search Gallery', 'sport' ),
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
        'menu_icon'          => 'dashicons-format-gallery',
        'rewrite'            => array('slug' => 'gallery' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title' ),
    );

    register_post_type('gallery', $args );
    /* End post type template */

    /* Start taxonomy prodcut */
    $taxonomy_labels = array(

        'name'              => _x( 'Galleries categories', 'taxonomy general name', 'sport' ),
        'singular_name'     => _x( 'Galleries category', 'taxonomy singular name', 'sport' ),
        'search_items'      => __( 'Search template category', 'sport' ),
        'all_items'         => __( 'All Category', 'sport' ),
        'parent_item'       => __( 'Parent category', 'sport' ),
        'parent_item_colon' => __( 'Parent category:', 'sport' ),
        'edit_item'         => __( 'Edit category', 'sport' ),
        'update_item'       => __( 'Update category', 'sport' ),
        'add_new_item'      => __( 'Add New category', 'sport' ),
        'new_item_name'     => __( 'New category Name', 'sport' ),
        'menu_name'         => __( 'Categories', 'sport' ),

    );

    $taxonomy_args = array(

        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'gallery-category' ),

    );

//    register_taxonomy( 'gallery_cat', array( 'gallery' ), $taxonomy_args );
    /* End taxonomy prodcut */

}