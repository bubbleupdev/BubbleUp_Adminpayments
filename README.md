# BubbleUp_Adminpayments

This module will allow you to enable certain payment methods for use when creating orders from the admin side, without enabling them on the front-end. The most common use-case is allowing `Check/Money Order` to be used on the admin side, without allowing it on the front-end, so that administrators can create orders without entering credit card info.

## Installation and Setup Instructions
1. Download [the zip file], or git clone the repo
2. Copy all of the contents from the `BubbleUp_Adminpayments` directory into your Magento Root directory. This can be done with drag-and-drop.
3. Clear caches if enabled.
4. In the admin panel, go to `System`=>`Configuration`=>`Payment Methods`=>`Frontend Method Restrictions`.
5. From the multi-select, choose whichever method(s) you want to be available from the admin panel (ie, `Check/Money Order`). 
You should now be able to place an order from the admin panel using those selected methods, but they will not display on the front-end.

> Tip: Don't "enable" the payment method in its own configuration as this will make it appear on the front-end as well. All you must do is select it from the "Admin Only Methods" multi-select.

## How it works

The module works by observing the `payment_method_is_active` event, and uses the ReflectionClass to force these (protected) class properties:
```
	'_canUseCheckout'       => false,
	'_canUseMultishipping'  => false,
	'_canUseInternal'       => true,
```
[Click here to jump to the code](https://github.com/bubbleupdev/BubbleUp_Adminpayments/blob/master/BubbleUp_Adminpayments/app/code/local/BubbleUp/Adminpayments/Model/Observer.php)
> To preserve forwards compatability, this module does not override any Magento core classes.
