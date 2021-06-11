define([
    'jquery',
    'uiComponent',
    'ko'], 
function ($, Component, ko) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'AHT_KnockoutJs/knockout-test'
        },
        function () {
            this.customerName = ko.observableArray([]);
            this.customerData = ko.observable('');
            this.customerName.push({name:this.customerData()});
        },

        // addNewCustomer: function () {
           
        //     this.customerData('');
        // }
    });
}
);
