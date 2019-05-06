
<?php if( is_active_sidebar( 'sport-sidebar-main' ) ): ?>

    <aside class="<?php echo esc_attr( sport_col_sidebar() ); ?> site-sidebar">
        <?php dynamic_sidebar( 'sport-sidebar-main' ); ?>
    </aside>

<?php endif; ?>