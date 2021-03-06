/**
 * shop cat js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let register_form   =   $( '#register' ),
        login_form      =   $( '#login' );

    // Perform AJAX login/register on form submit
    $('form#login, form#register').on('submit', function (e) {

        if (!$(this).valid()) return false;
        $('p.status', this).show().text(ajax_auth_object.loadingmessage);
        let action = 'ajax_login',
        username = $('form#login #username').val(),
        password = $('form#login #password').val(),
        email = '',
        security = $('form#login #security').val();

        if ($(this).attr('id') === 'register') {
            action = 'ajax_register';
            username = $('#signonname').val();
            password = $('#signonpassword').val();
            email = $('#email').val();
            security = $('#signonsecurity').val();
        }

        let ctrl = $(this);

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'username': username,
                'password': password,
                'email': email,
                'security': security
            },
            success: function (data) {
                $('p.status', ctrl).text(data.message);
                if (data.loggedin === true) {
                    document.location.href = ajax_auth_object.redirecturl;
                }
            }
        });

        e.preventDefault();

    });

    // Client side form validation
    if ( register_form.length )

        register_form.validate(
            {
                rules:{
                    password2:{ equalTo:'#signonpassword'
                    }
                }}
        );

    else if ( login_form.length )

        login_form.validate();

} )( jQuery );