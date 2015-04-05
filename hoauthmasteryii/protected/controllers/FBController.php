
<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class FbController extends Controller
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
		//Yii::app()->clientScript->registerScriptFile('./js/jquery/1.11.2/jquery.min.js',CClientScript::POS_END);			
		$this->render('post');	
			
	}
	
	public function actionCurlPostTOProvder(){
		
		$fbIdentifier = '1403484586624470';
		$url = 'https://graph.facebook.com/' . $fbIdentifier  . '/feed';
		
		$config =  './protected/config/hoauth.php';
		require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
		$hybridauth = new Hybrid_Auth( $config );
		$fbAdapter = $hybridauth->authenticate( "facebook" );
		try{
		$access_token = $fbAdapter->getAccessToken();
		$app_secret = '8fd4cabe2de8bc79395a56a44fe831ae';
		$appsecret_proof= hash_hmac('sha256', $access_token['access_token'], $app_secret);

		$id = $_POST['id'];
		//$id = '10153142134977999_10153142144877999';
		$message = $_POST['message'];
		if( isset($id ) && isset($message)  ) {
		    $url = "https://graph.facebook.com/{$id}/comments";
		    $attachment =  array(
		            'access_token'  => $access_token['access_token'],
		            'message'       => $message, //"Puma! Lovely shoes in wide Range of Collection",
					'appsecret_proof'=>$appsecret_proof
		    );
		
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		    curl_setopt($ch, CURLOPT_POST, true);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    $comment = curl_exec($ch);
		    curl_close ($ch);
		    $comment = json_decode($comment, TRUE);
		    if(isset($comment['id'] ))
		    	echo "success" ;
		    exit(0);	
		    //print_r($comment);
		}	
	}catch(Exception $e){
		
		
	}
	
}
	
	public function actionPostToProvider(){
		
			$config =  './protected/config/hoauth.php';
			require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
			$hybridauth = new Hybrid_Auth( $config );

			$fbAdapter = $hybridauth->authenticate( "facebook" );
			try{
			$fbUserProfile = $fbAdapter->getUserProfile();
				echo "<pre>";
				$access_token = $fbAdapter->getAccessToken();
				$app_secret = 'c2ed70bd12e6fb1cc0fa93a389fbaa86';
				$appsecret_proof= hash_hmac('sha256', $access_token['access_token'], $app_secret); 
				
//			exit;	
			//$commentPost= $fbAdapter->api()->api('197535293612901_937409339625489/?access_token='.$access_token['access_token'].'&message=ha this is a test from app&parent=937409339625489_937418522957904');
//			$commentPost= $fbAdapter->api()->api('116151972998_10153139619852999/?access_token='.$access_token['access_token'].'&message=Milan is a Great team&parent=197535293612901_937409339625489&appsecret_proof='.$appsecret_proof);

				
			$commentPost= $fbAdapter->api()->api('/116151972998_10153139619852999/comments', 'post',  "message : comment post" );
			} catch( FacebookApiException $e ){
				throw new Exception( "comment posting Failed! {$this->providerId} returned an error: $e");
				error_log('here ');
			} 
			print_r($commentPost);

			//  the below code likes the post 
			//$likeComment= $fbAdapter->api()->api('1403484586624470_1409893302650265/likes', 'post');
			//print_r($comment);
			//echo " here without error" ;
/*
			//$_POST ['postToProviders'] = 'this is a test post again' ;
		$fbAdapter->setUserStatus(
		    array(
		       	"message" => $_POST ['postToProviders'], //" Simple test with image accessible from web", // status or message content
		    ));
*/		    
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
	
	public function actionShareWithProvider(){
		
		$config =  './protected/config/hoauth.php';
		require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
		$hybridauth = new Hybrid_Auth( $config );
		$fbAdapter = $hybridauth->authenticate( "facebook" );
		$fbIdentifier = '1403484586624470';
		$linkUrl = 'https://www.facebook.com/1463400223890245/posts/1626350464261886';
		$message = 'To the general public';
		$sharePost= $fbAdapter->api()->api('/'.$fbIdentifier.'/links/1463400223890245_1626350464261886?link='.$linkUrl.'&message='.$message );
		print_r($sharePost);
		echo "The post has been shared";
	}
	
	/**
	 * Display the home feeds
	 */
	public function actionHomeFeed(){

		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('homefeed'); 
	}
	/**
	 * Display the home feeds
	 */
	public function actionUserPhotos(){

		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('photos'); 
	}
	/**
	 * 
	 * Display the friendsList
	 */
	public function actionUserFriends(){

		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('friends'); 
	}
	
	/**
	 * 
	 * Display the friendsList
	 */
	public function actionUserGroups(){
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('groups'); 
	}

	/**
	 * 
	 * gets all unread Notifications
	 */
	public function actionMyUnreadNotifications(){
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('notifications');
	}
	/**
	 * 
	 * Display the timeline of the user
	 */
	public function actionUserTimeline(){
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('timeline');
	}
	/**
	 * 
	 * User Likes 
	 */
	public function actionPostUserLikes(){
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$config =  './protected/config/hoauth.php';
		require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
		$hybridauth = new Hybrid_Auth( $config );
		$fbAdapter = $hybridauth->authenticate( "facebook" );
		$fbIdentifier = '1403484586624470';
		$sharePost= $fbAdapter->api()->api('/1606073576304722_1624996987745714/likes');
		print_r($sharePost);
		echo "The post has been shared";
			
		//$this->render('timeline');
	}
}