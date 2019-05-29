<?php



function sport_select_post_gallery() {

    $args   =   array(
        'post_type' => 'gallery'
    );

    $posts      =   array();
    $post_types =   get_posts( $args );

    foreach ( $post_types as $key => $item ):

        $posts[$item->ID]  =   $item->post_title;

    endforeach;

    return $posts;

}

// Add term page
function shoptheme_product_cat_add_new_meta_field() {
    
?>

    <div class="form-field">
        <label for="type-gallery">
            <?php esc_html_e( 'Gallery', 'shoptheme' ); ?>
        </label>

        <select id="type-gallery" name="type-gallery">
            <option value="0">
                <?php esc_html_e( 'None', 'sport' ); ?>
            </option>

            <?php foreach ( sport_select_post_gallery() as $key => $item ): ?>

                <option value="<?php echo esc_attr( $key ); ?>">
                    <?php echo esc_html( $item ); ?>
                </option>

            <?php endforeach; ?>
        </select>
    </div>

<?php

}
add_action( 'product_cat_add_form_fields', 'shoptheme_product_cat_add_new_meta_field', 10, 2 );

function sport_save_select_gallery( $term_id ){
    if( isset( $_POST['type-gallery'] ) && $_POST['type-gallery'] !== '' ){
        $select_gallery = sanitize_title( $_POST['type-gallery'] );
        add_term_meta( $term_id, 'type-gallery', $select_gallery, true );
    }
}
add_action( 'create_product_cat', 'sport_save_select_gallery', 10, 2 );

// Edit term page
function shoptheme_product_cat_edit_meta_field( $term ) {

    $args   =   array(
        'post_type' => 'gallery'
    );

    $posts      =   array();
    $post_types =   get_posts( $args );

    foreach ( $post_types as $key => $item ):

        $posts[$item->ID]  =   $item->post_title;

    endforeach;

    // get current group
    $feature_group = get_term_meta( $term->term_id, 'type-gallery', true );

?>

    <tr>
        <th>
            <label for="type-gallery">
                <?php esc_html_e( 'Gallery', 'shoptheme' ); ?>
            </label>
        </th>

        <td>
            <div class="form-field form-field__edit-cat">
                <div class="form-field__item">
                    <select id="type-gallery" name="type-gallery">
                        <option value="0">
                            <?php esc_html_e( 'None', 'sport' ); ?>
                        </option>

                        <?php foreach ( sport_select_post_gallery() as $key => $item ): ?>

                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $feature_group, $key ); ?>>
                                <?php echo esc_html( $item ); ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </td>
    </tr>

<?php

}
add_action( 'product_cat_edit_form_fields', 'shoptheme_product_cat_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function sport_update_select_gallery( $term_id ) {

    if( isset( $_POST['type-gallery'] ) &&  $_POST['type-gallery'] !=='' ){
        $select_gallery = sanitize_title( $_POST['type-gallery'] );
        update_term_meta( $term_id, 'type-gallery', $select_gallery );
    }

}
add_action( 'edited_product_cat', 'sport_update_select_gallery', 10, 2 );

/* Product New Columns */
add_filter( 'manage_product_posts_columns', 'product_column_new' );
add_action( 'manage_product_posts_custom_column', 'product_custom_column_new', 10, 2 );

function product_column_new( $defaults ) {

    $defaults['product_new'] = esc_html__( 'New', 'sport' );

    return $defaults;

}

function product_custom_column_new( $column_name, $id ) {

    if( $column_name === 'product_new' ) {

        $value = get_post_meta( $id, 'sport_option_product_new', true );

        if ( $value == 1 ) :
            echo esc_html__( 'Yes', 'sport' );
        else:
            echo esc_html__( 'No', 'sport' );
        endif;

    }

}

