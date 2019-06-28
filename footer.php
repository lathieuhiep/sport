    </div><!--End Sticky Footer-->

    <footer class="site-footer">

        <?php

        get_template_part( 'template-parts/footer/inc','footer-top' );

        get_template_part( 'template-parts/footer/inc','multi-column' );

        get_template_part( 'template-parts/footer/inc','copyright' );

        ?>

    </footer>

    <div class="close-canvas"></div>

    <div id="back-top">
        <a href="#">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
