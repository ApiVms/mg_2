define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
        
    'use strict';
    console.log("Called from INVOCE.", Component);
    
    return Component.extend({
        defaults: {
            template: 'Training_Js/checkout/printed-invoice'
        }
    });
});