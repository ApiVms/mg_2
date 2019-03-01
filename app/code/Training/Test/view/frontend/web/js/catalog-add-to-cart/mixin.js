define([
    'jquery',
    'mage/translate',
    'jquery/ui'
], function ($, $t) {
    'use strict';
    console.log("Called this Hook from MIXIN.");

    return function (widget) {
        $.widget('mage.catalogAddToCart', widget, {
            submitForm: function (form) {
                if (confirm($t('Are you sure?'))) {
                    this._super(form);
                } else {
                    return false;
                }
            }
        });
        return $.mage.catalogAddToCart;
    };
});