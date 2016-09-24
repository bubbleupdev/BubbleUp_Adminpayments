<?php

class BubbleUp_Adminpayments_Model_System_Config_Source_Methods  {
	public function toArray() {
		$methods = Mage::getModel('payment/config')->getAllMethods();
		$out = array();

		foreach($methods as $method){
        	if(!is_a($method, 'Mage_Payment_Model_Method_Abstract')){
        		continue;
        	}

        	$out[ $method->getCode() ] = "{$method->getTitle()} [{$method->getCode()}]";
		}

		return $out;
	}

	public function toOptionArray() {
		$out = array();
		foreach( $this->toArray() as $key=>$val){
        	$out[] = array(
        		'value' => $key,
        		'label' => $val
        	);
		}

		return $out;
	}
}