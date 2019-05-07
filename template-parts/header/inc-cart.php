<?php if ( class_exists('Woocommerce') ) : ?>

    <div class="shop-cart-view d-flex align-items-center">
        <?php
        do_action( 'sport_get_cart_item' );

        the_widget( 'WC_Widget_Cart', '' );
        ?>
    </div>

<?php endif; ?>
