define(
    [
        'ko',
        'uiComponent',
        'underscore',
        'Magento_Checkout/js/model/step-navigator',
        'Magento_Customer/js/model/customer',
         'mage/url',
        'mage/storage',
    ],
    function (
        ko,
        Component,
        _,
        stepNavigator,
        customer,
        urlBuilder,
        storage
    ) {
        'use strict';
        /**
        * check-login - is the name of the component's .html template
        */
       
        return Component.extend({
            defaults: {
                template: 'AHT_CheckOut/check_delivery_date'
            },

            //add here your logic to display step,
            isVisible: ko.observable(true),
            isLogedIn: customer.isLoggedIn(),
            //step code will be used as step content id in the component template
            stepCode: 'isDeliveryDateCheck',
            //step title value
            stepTitle: 'Delivery Step',

            /**
            *
            * @returns {*}
            */
            initialize: function () {
                this._super();
                // register your step
                stepNavigator.registerStep(
                    this.stepCode,
                    //step alias
                    null,
                    this.stepTitle,
                    //observable property with logic when display step or hide step
                    this.isVisible,

                    _.bind(this.navigate, this),

                    /**
                    * sort order value
                    * 'sort order value' < 10: step displays before shipping step;
                    * 10 < 'sort order value' < 20 : step displays between shipping and payment step
                    * 'sort order value' > 20 : step displays after payment step
                    */
                    15
                );

                return this;
            },

            /**
            * The navigate() method is responsible for navigation between checkout step
            * during checkout. You can add custom logic, for example some conditions
            * for switching to your custom step
            */
            navigate: function () {

            },

            
            /**
            * @returns void
            */
            navigateToNextStep: function () {
                stepNavigator.next();
             
                var serviceUrl = urlBuilder.build('test/index/index');
               
                var date    =  document.getElementById('checkout-date').value;
                var comment =  document.getElementById('checkout-comment').value;

                storage.post(
                    serviceUrl,
                    JSON.stringify( {'checkout-date': date,'checkout-comment': comment}
                                    ),
                    false
                ).done(function (response) {
                           /** Do your code here */
                           console.log(response);
                    }
                ).fail(function (response) {
                    // code khi fail
                });


            }
        });
    }
);