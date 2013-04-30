require.config({
    paths: {
        jquery: '../components/jquery/jquery',
        jqueryvalidate: '../components/jquery.validation/jquery.validate',
        bootstrap: 'vendor/bootstrap'
    },
    shim: {
        jqueryvalidate: {
            deps: ['jquery'],
            exports: 'jquery'
        },
        bootstrap: {
            deps: ['jquery'],
            exports: 'jquery'
        }
    }
});

require(['login', 'jquery', 'jqueryvalidate', 'bootstrap'], function (login, $) {
    'use strict';
    login;

    jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, ""); 
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
    }, "Please specify a valid phone number");
    
    $("#registration-form").validate({
        errorClass: "alert-error",
        rules: {
            phone: {
                phoneUS: true
            }
        }
    });

    $('form[name=registration-form]').submit(function() {
        $.post($(this).attr('action'), $(this).serialize(), function(res) {
            if ('error' in res) {
                var newAlert = $("<div/>");
                $(newAlert).addClass("alert").addClass("alert-error")
                    .html('<button type="button" class="close" data-dismiss="alert">×</button> ' + res['error'])
                    .appendTo($("#error-message"))
                    .delay(2000)
                    .fadeOut(2000, function() { $(this).remove(); });
            } else if ('success' in res) {
                var newAlert = $("<div/>");
                    $(newAlert).addClass("alert").addClass("alert-success")
                    .html('<button type="button" class="close" data-dismiss="alert">×</button> ' + res['message'])
                    .appendTo($("#error-message"))
                    .delay(2000)
                    .fadeOut(2000, function() { $(this).remove(); });
                $(location).attr("href", "./index.php?v=index&a=registered");
            }
        });
        return false;
    });

});


