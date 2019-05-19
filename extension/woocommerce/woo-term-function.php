<?php

// Add term page
add_action( 'product_cat_add_form_fields', 'shoptheme_product_cat_add_new_meta_field', 10, 2 );

function shoptheme_product_cat_add_new_meta_field() {

    $args   =   array(
        'post_type' => 'gallery'
    );

    $post_types =   get_posts( $args );
?>

    <div class="form-field">
        <label for="type-gallery">
            <?php esc_html_e( 'Gallery', 'shoptheme' ); ?>
        </label>

        <select id="type-gallery" name="type-gallery" class="postform">
            <?php foreach ( $post_types as $item ): ?>

                <option value="<?php echo esc_attr( $item->ID ); ?>" >
                    <?php echo esc_html( $item->post_title ); ?>
                </option>

            <?php endforeach; ?>
        </select>
    </div>

<?php

}

// Edit term page
add_action( 'product_cat_edit_form_fields', 'shoptheme_product_cat_edit_meta_field', 10, 2 );
function shoptheme_product_cat_edit_meta_field() {

    $args   =   array(
        'post_type' => 'gallery'
    );

    $post_types =   get_posts( $args );

?>

    <tr>
        <th>
            <label for="term-collections">
                <?php esc_html_e( 'Gallery', 'shoptheme' ); ?>
            </label>
        </th>

        <td>
            <div class="form-field form-field__edit-cat">
                <div class="form-field__item">
                    <label for="type-gallery">
                        <?php esc_html_e( 'Gallery', 'shoptheme' ); ?>
                    </label>

                    <select id="type-gallery" name="type-gallery" class="postform">
                        <?php foreach ( $post_types as $item ): ?>

                            <option value="<?php echo esc_attr( $item->ID ); ?>" >
                                <?php echo esc_html( $item->post_title ); ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </td>
    </tr>

<?php

}

// Save extra taxonomy fields callback function.
function shoptheme_taxonomy_custom_meta( $shoptheme_product_term_id ) {

    if ( isset( $_POST[ 'type-gallery' ] ) ) {
        update_term_meta( $shoptheme_product_term_id, 'type-gallery', $_POST[ 'type-gallery' ] );
    }

}
add_action( 'edited_product_cat', 'shoptheme_taxonomy_custom_meta', 10, 2 );
add_action( 'create_product_cat', 'shoptheme_taxonomy_custom_meta', 10, 2 );

