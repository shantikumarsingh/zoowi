<?php 

/**
*/

class AuthenticateManager{

	private $authenticate;
	private $userBusinessServices; 
	function __construct() {
		$this->userBusinessServices = new UserBusinessServices;
	}
	
	public function doAuthenticate($userName, $password){
		// Currently Authenticated by Default
		$this->authenticate = false;
		$userObject = $this->userBusinessServices->validateUserExists($userName, $password);
		if($userObject){
			error_log(' inside ') ;
			if($userName == $userObject->username && md5($password) == $userObject->password_hash) {
			
			error_log(' Validated ') ;
				$this->authenticate = true; 
				$userSetName = ucfirst($userObject->firstname . ' ' . $userObject->lastname );
				self::authSetSession($userSetName, $userObject->username);
			} else 
				$this->authenticate = false; 
			
		} else {
				self::authSetSession('Invalid User', 'Invalid Email');
		}
		return $this->authenticate;
	}
	/**
	 * 
	 * Setting up the Session Variables
	 * @param unknown_type $userName
	 */
	public function authSetSession ($userSetName ,  $email) {

		$_SESSION['zoowiuser'] = $userSetName;
		$_SESSION['zoowiemail'] = $email;
		header("Location: /zoowiproject/protected/application/");
		exit(0);   
	}
	public function authLogout() {
		if(isset($_SESSION['zoowiuser']))
			session_destroy();
		header("Location: /zoowiproject/");
		exit(0);   
	}
	
	
}
