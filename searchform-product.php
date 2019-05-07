<?php
/**
 * The template for displaying product search form
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<form role="search" method="get" class="search-form-product" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Bạn muốn tìm gì... ', 'sport' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    
    <button class="btn-submit global-transition" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'sport' ); ?>">
        <i class="fas fa-search" aria-hidden="true"></i>
    </button>
    
    <input type="hidden" name="post_type" value="product" />
</form>