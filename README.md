# BubbleUp_Adminpayments

This module will allow you to enable certain payment methods for use when creating orders from the admin side, without enabling them on the front-end. The most common use-case is allowing "Check/Money Order" to be used on the admin side, without allowing it on the front-end, so that administrators can create orders without entering credit card info.

All you have to do is set the desired method(s) in System=>Configuration=>Payment Methods=>Frontend Method Restrictions
DO NOT "enable" the payment method in its own configuration; this will make it appear on the front-end as well; All you must do is select it from the "Admin Only Methods" multi-select.

To preserve forwards compatability, this module does not override any Magento core classes.

The module works by observing the `payment_method_is_active` event, and uses the ReflectionClass to force these (protected) class properties:
```
	'_canUseCheckout'       => false,
	'_canUseMultishipping'  => false,
	'_canUseInternal'       => true,
```
[Click here to jump to the code](https://github.com/bubbleupdev/BubbleUp_Adminpayments/blob/master/BubbleUp_Adminpayments/app/code/local/BubbleUp/Adminpayments/Model/Observer.php)
