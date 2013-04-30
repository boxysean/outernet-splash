require.config({
    paths: {
        jquery: '../components/jquery/jquery',
        jqueryvalidate: '../components/jquery.validation/jquery.validate',
        bootstrap: 'vendor/bootstrap'
    },
    shim: {
        bootstrap: {
            deps: ['jquery'],
            exports: 'jquery'
        }
    }
});

require(['login', 'jquery', 'bootstrap'], function (app, $) {
    "use strict";
    app;
});


