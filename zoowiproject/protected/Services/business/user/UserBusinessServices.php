<?php
/**
 * 
 * @author Sunil Kumar
 * Created On 			: 
 * Update By			:
 * Updated On			:
 * Reviewed By			:
 * Reviewer Comments	:
 * File Comments		:
 * 
 */
class UserBusinessServices {
	
	private $dataService;
	private $isDataInserted;
	function __construct(){
		$this->dataService = new UserDataServices;
				
	}
	/**
	 * 
	 * Gets the Salt combination 
	 */
	public function getSaltKey(){
		return PASSWORD_SALT_HASH_KEY;
	}
	/**
	 * 
	 * Registers an user into the System
	 * @param unknown_type $userData
	 */
	public function registerUser($userData){
		
		if($userData['InputPassword'] !== $userData['InputPassword']){
			
			return false;
		}
		$salt = self::getSaltKey();
		return $this->dataService-> registerUser($userData, $salt);
	}
	/**
	 * 
	 * Validating an existing user 
	 * @param unknown_type $userName
	 * @param unknown_type $password
	 */
	public function validateUserExists($userName, $password){
		
		return $this->dataService-> validateUserExists($userName, $password);
		
	}
	
}