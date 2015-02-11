<?php

require_once(__DIR__.'/ClassMap.php');
class RegistrationHandler{
	
	private $registered ;
	public function __construct(){
		$this->registered = false;
		
	}
	/**
	 * 
	 * User is done here Registration 
	 * @param unknown_type $postParams
	 */
	public function registerNewUser($postParams){
		print_r($postParams);
		$this->registered=true;
		//return $registered; 
	}
}

if(isset($_POST)) {
	
	$regHandler = new RegistrationHandler;
	$isRegistered = $regHandler->registerNewUser($_POST);
}