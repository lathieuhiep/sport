<?php
/**
 * The template for displaying product search form
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$args = array(
    'show_option_none'  =>  __( 'Chọn danh mục', 'textdomain' ),
    'show_count'        =>  1,
    'orderby'           =>  'name',
    'name'              =>  'product_cat_select',
    'echo'              =>  0,
    'taxonomy'          =>  'product_cat',
);

$sport_product_cat     =   get_terms(
    array(
        'taxonomy'      =>  'product_cat',
        'hide_empty'    =>  true,
    )
);

$sport_cat_id_product   = $_GET['product_cat_id'];

?>
<form role="search" method="get" class="search-form-product d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <?php
    if ( !empty( $sport_product_cat ) ) :

        if ( !empty( $sport_cat_id_product ) ) :

            $sport_product_select       =   get_term( $sport_cat_id_product , 'product_cat' );
            $sport_text_name_product    =   $sport_product_select->name;

        else:

            $sport_text_name_product    =   esc_html__( 'Chọn danh mục', 'sport' );

        endif;

    ?>

        <div class="product-cat-selector-search dropdown d-flex align-items-center">
            <span class="text-product" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo esc_html( $sport_text_name_product ) ?>
            </span>

            <div class="dropdown-menu product-cat-list" aria-labelledby="dLabel">
                <?php foreach ( $sport_product_cat as $item ) : ?>

                    <span class="item-product-cat" data-cat-id="<?php echo esc_attr( $item->term_id ); ?>">
                        <?php echo esc_html( $item->name ); ?>
                    </span>

                <?php endforeach; ?>
            </div>
        </div>

    <?php endif; ?>

    <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Bạn muốn tìm gì... ', 'sport' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    
    <button class="btn-submit global-transition" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'sport' ); ?>">
        <i class="fas fa-search" aria-hidden="true"></i>
    </button>

    <?php
    if ( !empty( $sport_product_cat ) ) :

        if ( !empty( $sport_cat_id_product ) ) :

            $cat_id_product_select =   $sport_cat_id_product;

        else:

            $cat_id_product_select = '';

        endif;

    ?>

        <input class="product-cat-id" type="hidden" name="product_cat_id" value="<?php echo esc_attr( $cat_id_product_select ); ?>" />

    <?php endif; ?>

    <input type="hidden" name="post_type" value="product" />
</form>