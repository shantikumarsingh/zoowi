<?php

class UtilityController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(

			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex() {
		
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->redirect('index.php?r=site/index');
	}

	/**
	 * Status update to multiple providers 
	 */
	public function actionPostIndex() {
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('postProvider');
	}	

	/**
	 * Status update to multiple providers 
	 */
	public function actionPostSelectedProviders() {
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
			
			$error = '' ;
			$boolVal = false;
			if($_POST['postToProviders'] == '' ) 
				$boolVal = true;
			if(	!isset($_POST['providersCheckList']) ) 
				$boolVal = true;
			if($boolVal){
				$error  = 'Error';
				echo $error;
				exit(0);
			}	
			
			// code to post to the selected providers
			if(	isset($_POST['providersCheckList']) ){
				echo $_POST['postToProviders'];
				$message = $_POST['postToProviders'];
				foreach($_POST['providersCheckList'] as $provider){
					
					if($provider == 'twitter')
						self::updateTwitterStatus($message);
					if($provider == 'facebook')
						self::updateFacebookStatus($message);
				}
			}
			//print_r($_POST);
			
	}
	public function updateTwitterStatus($message){

		$config =  './protected/config/hoauth.php';
		require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
		$hybridauth = new Hybrid_Auth( $config );
		$twitterAdapter = $hybridauth->authenticate( "twitter" );
		if($message !== ''){
			echo " here " ;
			$twitterAdapter->setUserStatus(
			    array(
			       	"message" => $message, 
			    ));
			    
			    Yii::app()->end();
		}
	}
	
	public function updateFacebookStatus($message){
		
		$config =  './protected/config/hoauth.php';
		require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
		$hybridauth = new Hybrid_Auth( $config );
		$fbAdapter = $hybridauth->authenticate( "facebook" );
		if($message !== ''){
			$fbAdapter->setUserStatus(
		    array(
		       	"message" =>$message,
		    ));
		}
	}
}
