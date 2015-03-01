<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class TwitterController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(

			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

			if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
			$this->render('index');
		
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * View to Facebook
	 */
	public function actionPostPage(){
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		Yii::app()->clientScript->registerScriptFile('./js/jquery/1.11.2/jquery.min.js',CClientScript::POS_END);			
		$this->render('post');	
			
	}
	public function actionPostToProvider(){
		
			$config =  './protected/config/hoauth.php';
			require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
			$hybridauth = new Hybrid_Auth( $config );

			$fbAdapter = $hybridauth->authenticate( "facebook" );
			
		$fbAdapter->setUserStatus(
		    array(
		       	"message" => $_POST ['postToProviders'], //" Simple test with image accessible from web", // status or message content
		    ));
		   //Yii::app()->user->setFlash('success','Post has been posted .'); 
		    Yii::app()->end();
	}
	/**
	 * build up to update the current status 
	 */
	public function actionUpdateStatusPage(){

		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('postUpdateStatus'); 
	}
	/**
	 * 
	 * update the user status with images description, caption and other information
	 */
	public function actionUpdateStatusToProvider(){

		
		
/**			
		$fbAdapter->setUserStatus(
		    array(
		       	"message" => " Simple test with image accessible from web", // status or message content
		       	"link"    => "http://google.co.in", // webpage link
		       	"picture" => "https://support.bigrock.com/__swift/files/file_b32itinpe05gaip.jpg", // a picture link
				"caption"=>  "Zoowimama, the Social aggregator application logo",
				"description"=> "Zoowimama, Lets see what happens to the image?." 
		    
		    ));
**/		    
		
		
	}
	
}