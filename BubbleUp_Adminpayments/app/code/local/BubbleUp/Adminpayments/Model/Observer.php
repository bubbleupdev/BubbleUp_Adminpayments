<?php

class BubbleUp_Adminpayments_Model_Observer {
	function onEvent($event) {
		$method = $event->getMethodInstance();
		$checkResult = $event->getResult();

		$class = new ReflectionClass($method);
		
		$toOverride = array(
			'_canUseCheckout'       => false,
			'_canUseMultishipping'  => false,
			'_canUseInternal'       => true,
		);

		$methodsToOverride = explode(',', Mage::getStoreConfig('payment/adminpayments/adminmethods') );
		if(!in_array($method->getCode(), $methodsToOverride)) {
			//Mage::log("Doing nothing for {$method->getCode()}");
			return;
		} else {
			//Mage::log("Setting admin-only for {$method->getCode()}");
		}

		foreach($toOverride as $key=>$val) {
			try {
				$property = $class->getProperty($key);
				$property->setAccessible(true);
				$property->setValue($method, $val);
			} catch(Exception $e) {
				if($key != '_canUseMultishipping' ) {
					// Many payment methods just don't implement _canUseMultishipping, so we can expect exceptions for this.
					Mage::logException($e);
				}
			}
		}

		$checkResult->isAvailable = true;
	}
}