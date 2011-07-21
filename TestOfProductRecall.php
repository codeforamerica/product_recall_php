<?php
// load simple test library.. not required if simpletest is preinstalled.
require_once('simpletest/autorun.php');
// load baseclass 
require_once('APIBaseClass.php');
// load your class here...
require_once('productRecallApi.php');
// the name of the api class is 'yourApi'
class TestOfApiClass extends UnitTestCase {
   public $api;
   // put your class name here
   public static $class_name = 'productRecallApi';
    function testApiConstructs(){
    	$this->api = new self::$class_name();
    	$this->check_class_params('_http _root api_url');
    	$this->assertTrue($this->api->get_recall_data(NULL,'2010-01-01','2010-03-19'));
    	$this->assertTrue($this->api->get_recall_data('tires','2010-01-01','2010-03-19'));
    }

    function check_class_params($params=NULL,$mode=TRUE){
    	// look up parameters inside of class and see if they are set/ true
    	// also allow to only check for certain parameters by passing in an array with the names of those variables or a space seperated string
    	// parameters to look for in the object
    	$api_class_vars =  get_class_vars(get_class($this->api));
    	if($params != null && is_string($params)){    		
			$params = explode(' ',$params);
			foreach($params as $key_name)
				$api_vars [$key_name] = "$key_name";
			$api_vars = array_intersect_key($api_class_vars,$api_vars);
    	}
    	else
    		$api_vars = $api_class_vars;		
    	// anything that isnt intersected should return false
   
    	foreach($api_vars as $key=>$value){
    		if($mode == TRUE)
    			$this->assertTrue(array_key_exists($key,$api_class_vars));
    		elseif($mode == FALSE)
    			$this->assertFalse(array_key_exists($key,$api_class_vars));
    		}
    }
}
?>