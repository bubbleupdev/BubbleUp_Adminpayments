This module is designed to allow you to enable certain payment methods only for the admin side, without enabling them on the front-end.

All you have to do is set the desired method(s) in System=>Configuration=>Payment Methods=>Frontend Method Restrictions
DO NOT "enable" the payment method in its own configuration; this will make it appear on the front-end as well; All you must do is select it from the "Admin Only Methods" multi-select.

The module works by observing the 'payment_method_is_active' event, and uses the ReflectionClass to force these (protected) class properties:
	'_canUseCheckout'       => false,
	'_canUseMultishipping'  => false,
	'_canUseInternal'       => true,