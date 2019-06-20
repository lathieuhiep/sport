(function ($) {

    /* Start element slider */
    let ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides = $scope.find( '.element-slides' );

        $( document ).general_owlCarousel_item( element_slides );

    };
    /* End element slider */

    /* Start element post carousel */
    let ElementPostCarousel   =   function( $scope, $ ) {

        let element_post_carousel = $scope.find( '.element-post-carousel' );

        $( document ).general_multi_owlCarouse( element_post_carousel );

    };
    /* End element post carousel */

    /* Start element text editor scroll */
    let ElementTextEditorScroll =   function( $scope, $ ) {

        let element_text_editor_scroll = $scope.find( '.element-text-editor-scroll .scrollbar-inner' );

        element_text_editor_scroll.each( function () {

            $(this).scrollbar({
                scrollStep: 0
            });

        } )

    };
    /* End element text editor scroll */

    /* Start Product Tabs List */
    let ElementProductTabsList   =   function( $scope, $ ) {

        let product_tabs_list = $scope.find( '.product-tabs-list' );

        $( document ).general_multi_owlCarouse( product_tabs_list );

    };
    /* End Product Tabs List */

    /* Start element product category */
    let ElementProductCatSlider   =   function( $scope, $ ) {

        let element_product_cat_slider = $scope.find( '.element-product-cat__slider' );

        $( document ).general_owlCarousel_item( element_product_cat_slider );

    };

    let ElementProductCatSliderGallery  =   function( $scope, $ ) {

        let product_gallery_cat_slider = $scope.find( '.element-product-gallery-cate' );

        $( document ).general_owlCarousel_item( product_gallery_cat_slider );

    };
    /* End element product category */

    /* Start element product ids */
    let ElementProductIds   =   function( $scope, $ ) {

        let element_product_ids_slider = $scope.find( '.element-product-ids__slider' );

        $( document ).general_multi_owlCarouse( element_product_ids_slider );

    };
    /* End element product ids */

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-slides.default', ElementCarouselSlider );

        /* Element post carousel */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-post-carousel.default', ElementPostCarousel );

        /* Element text editor scroll */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-text-editor-scroll.default', ElementTextEditorScroll );

        /* Element product tabs list */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-products-ids.default', ElementProductTabsList );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-products-cat.default', ElementProductTabsList );

        /* Element product category */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-products-cat.default', ElementProductCatSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-products-cat.default', ElementProductCatSliderGallery );

        /* Element product ids */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-products-ids.default', ElementProductIds );

    } );

})( jQuery );