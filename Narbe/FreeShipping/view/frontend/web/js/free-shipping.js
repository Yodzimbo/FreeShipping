define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'underscore',
    'ko'
], function(Component, customerData, _, ko){
    'use strict'
    return Component.extend({
        defaults: {
            subtotal: 0.00,
            template: 'Narbe_FreeShipping/free-shipping',
            tracks: {
                subtotal: true
            }
        },
        initialize: function () {
            this._super();

            var self = this,
                cart = customerData.get('cart');

            customerData.getInitCustomerData().done(function() {
                if (!_.isEmpty(cart()) && !_.isUndefined(cart().subtotalAmount)) {
                    self.subtotal = parseFloat(cart().subtotalAmount);
                }
            });

            cart.subscribe(function(cart) {
                if (!_.isEmpty(cart) && !_.isUndefined(cart.subtotalAmount)) {
                    self.subtotal = parseFloat(cart.subtotalAmount);
                }
            });

            self.message = ko.computed(function() {
                if (_.isUndefined(self.subtotal) || self.subtotal === 0) {
                    return self.messageDefault;
                }

                if (self.subtotal > 0 && self.subtotal < self.value) {
                    var subtotalRemaining = self.value - self.subtotal;
                    var formattedSubtotalRemaining = self.formatCurrency(subtotalRemaining);
                    return self.messageItemsInCart + " " + formattedSubtotalRemaining;
                }

                if (self.subtotal >= self.value) {
                    return self.messageFreeShipping
                }
            });
        },

        formatCurrency: function(value) {
            return value.toFixed(2);
        }
    });
})
