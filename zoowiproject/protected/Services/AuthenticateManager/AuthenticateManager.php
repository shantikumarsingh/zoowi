<?php 

/**
*/

class AuthenticateManager{

	private $authenticate; 
	function __construct() {
	
	}
	
	public function doAuthenticate($userName, $password){
		// Currently Authenticated by Default
		$this->authenticate = false;
		if($userName == 'iadmin@gmail.com' && $password == 'demo'  ) {
			$this->authenticate = true;
			self::authSetSession($userName);
			error_log('Setting ');
		} else {
			$_SESSION['zoowiuser'] = 'Authentication Failed';
		}
		return $this->authenticate;
	}
	public function authSetSession ($userName) {
		$_SESSION['zoowiuser'] = 'Sunil Kumar';
		$_SESSION['zoowiemail'] = $userName;
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