/**
 * Element events js v1.0.0
 * Copyright 2018-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let timesRun            =   0,
        site_notification   =   $( '.site-notification' );

    $( document ).ready( function () {

        let settings_notify =   site_notification.data( 'settings' ),
            time_second     =   settings_notify['time_second'],
            loop_end        =   settings_notify['loop_end'];

        let interval    =   setInterval( function() {

            timesRun += 1;

            notification_show();

            setTimeout( function () {

                site_notification.removeClass('active');

            }, 5000 );

            if( timesRun === loop_end ) {
                clearInterval(interval);
            }

            }, time_second );

    });

    function notification_show() {

        $.ajax({

            url: load_notification.url,
            type: 'POST',
            data: ({

                action: 'sport_notification_ajax'

            }),

            beforeSend: function () {

                // site_notification.removeClass('active');

            },

            success: function( data ) {

                if ( data ) {

                    site_notification.empty().append( data ).delay(2500);

                    // site_notification.empty().append( data );

                }

            },

            complete:function(data){
                site_notification.addClass('active');
            }

        });

    }

} )( jQuery );