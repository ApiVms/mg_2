define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';
    console.log("Called from Training_Test::sidebar-review.js");
    
    return Component.extend({
        reviewerName: ko.observable(''),
        reviewerMessage: ko.observable(''),
        isLoading: ko.observable(false),
        url: '',
        initialize: function () {
            this._super();
            this.nextReview();
            return this;
        },
        nextReview: function () {
            this.isLoading(true);
            var self = this;
            
            $.ajax({
                url: self.url,
                type: 'get',
                dataType: 'json'})
            .done(function (data) {
                data = JSON.parse(data);
                console.log('done function data:', data);

                if (data.name && data.message) {
                    console.log('done function data NAME:', data['name']);
                    console.log('done function data: MESSAGE', data['message']);

                    self.reviewerName(data.name);
                    self.reviewerMessage(data.message);
                }
            }).always(function () {
                self.isLoading(false);
            });
        }
    });
});