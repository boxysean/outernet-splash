/*global define */
define(['jquery'], function ($) {
    'use strict';

    $('#login-form input, #login-menu label').click(function(e) {
        e.stopPropagation();
    });

    // this doesn't work
    $('.login-toggle').click(function(e) {
        $('#username').focus();
    });

    // Login submit button

    $('form[name=login-form]').submit(function() {
        $.post($(this).attr('action'), $(this).serialize(), function(res) {
            if ('error' in res) {
                var newAlert = $("<div/>");
                $(newAlert).addClass("alert").addClass("alert-error")
                    .html('<button type="button" class="close" data-dismiss="alert">×</button> ' + res['error'])
                    .appendTo($("#menubar"))
                    .delay(2000)
                    .fadeOut(2000, function() { $(this).remove(); });
            } else if ('success' in res) {
/*                var newAlert = $("<div/>");
                    $(newAlert).addClass("alert").addClass("alert-success")
                    .html('<button type="button" class="close" data-dismiss="alert">×</button> ' + res['message'])
                    .appendTo($("#menubar"))
                    .delay(2000)
                    .fadeOut(2000, function() { $(this).remove(); });*/
                location.reload();
            }
        });
        return false;
    });

    // Logout link

    $('#logout').click(function() {
        $.ajax({ url: "actions/logout.php" }).done(function() {;
            $(location).attr("href", "index.php");
        });
        return false;
    });

});


