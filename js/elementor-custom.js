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

        let element_text_editor_scroll = $scope.find( '.element-text-editor-scroll .boxscroll' );

        element_text_editor_scroll.each( function () {

            $(this).niceScroll();

        } )

    };
    /* End element text editor scroll */

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-slides.default', ElementCarouselSlider );

        /* Element post carousel */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-post-carousel.default', ElementPostCarousel );

        /* Element text editor scroll */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sport-text-editor-scroll.default', ElementTextEditorScroll );

    } );

})( jQuery );