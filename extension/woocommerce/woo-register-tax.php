<?php
/* Start add taxonomy woo */
add_action( 'init', 'sport_register_taxonomy_woo', 10 );
function sport_register_taxonomy_woo () {

    /* Start Type Product */
    $sport_taxonomy_product_brand = array(
        'name'              =>  _x( 'Brand', 'taxonomy general name', 'sport' ),
        'singular_name'     =>  _x( 'Brands', 'taxonomy singular name', 'sport' ),
        'search_items'      =>  esc_html__( 'Search Product Type', 'sport' ),
        'all_items'         =>  esc_html__( 'All Product Type', 'sport' ),
        'parent_item'       =>  esc_html__( 'Parent category', 'sport' ),
        'parent_item_colon' =>  esc_html__( 'Parent category:', 'sport' ),
        'edit_item'         =>  esc_html__( 'Edit category', 'sport' ),
        'update_item'       =>  esc_html__( 'Update category', 'sport' ),
        'add_new_item'      =>  esc_html__( 'Add New category', 'sport' ),
        'new_item_name'     =>  esc_html__( 'New category Name', 'sport' ),
        'menu_name'         =>  esc_html__( 'Brands', 'sport' ),
    );

    $sport_taxonomy_product_brand_args = array(
        'labels'                =>  $sport_taxonomy_product_brand,
        'hierarchical'          =>  true,
        'public'                =>  true,
        'show_ui'               =>  true,
        'show_admin_column'     =>  true,
        'query_var'             =>  true,
        'update_count_callback' =>  '_update_post_term_count',
        'rewrite'               =>  array( 'slug' => 'product_brand' ),
    );

    register_taxonomy( 'product_brand', array( 'product' ), $sport_taxonomy_product_brand_args );
    /* End Type Product */

}
/* End add taxonomy woo */