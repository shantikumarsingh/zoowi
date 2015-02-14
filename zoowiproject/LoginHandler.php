<?php 
	session_start();
	require_once(__DIR__.'/ClassMap.php');

	class LoginHandler {
		private $auManager;
		function __construct (){
			//error_log('Constructor Called here ');
			$this->auManager = new AuthenticateManager;
		}
		
		public function loginHandler(){
			$userName = $_POST['username'] ; 
			$password = $_POST['password'] ; 
			$isAuthenticate = false;
			
			$isAuthenticate = $this->auManager->doAuthenticate($userName, $password);
			if($isAuthenticate === false){
				$this->auManager->authLogout();
			}
		}
		public function logoutHandler(){
		
			$isAuthenticate = $this->auManager->authLogout();
		}
	} 

	$loginObj = new LoginHandler;
	if(		isset($_POST) && 
		(	isset($_POST['username']) && 
			isset($_POST['password'])
		)
	){
		$loginObj->loginHandler();
	}

	if(isset ($_GET['action']) && $_GET['action'] == 'logout') {
		$loginObj->logoutHandler();
		
	}
?>
