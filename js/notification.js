/**
 * Element events js v1.0.0
 * Copyright 2018-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let site_notification   =   $( '.site-notification' );

    $( document ).ready( function () {

        setInterval( notification_show, 5000 );

        // setTimeout( notification_show, 5000 );

        // setInterval( function() {
        //
        //     notification_show().slideToggle('slow');
        //
        //     }, 5000 );


    });

    function notification_show() {

        $.ajax({

            url: load_notification.url,
            type: 'POST',
            data: ({

                action: 'sport_notification_ajax'

            }),

            beforeSend: function () {

                site_notification.slideUp();

            },

            success: function( data ) {

                if ( data ) {

                    site_notification.empty().append( data ).delay(2500);

                    // site_notification.empty().append( data );

                }

            },

            complete:function(data){
                site_notification.slideDown();
            }

        });

    }

} )( jQuery );