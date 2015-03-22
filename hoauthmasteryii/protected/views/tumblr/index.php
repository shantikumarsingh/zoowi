<?php

/**
 * @author Sunil Kumar
 * This file list the Tumblr Pages 
 * @param 
 */
	
	/** 
	 * Returns the base Host name of the App used by Tumblr
	 */
	function getBaseHostName($identifier){
		
		if (preg_match('/https?:\/\/([^\/]+)\//i', $identifier, $matches)) 
	  		$base_hostName = $matches[1];
		return $base_hostName;
	}
	
	try {

		$config =  './protected/config/hoauth.php';
		require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
		$hybridauth = new Hybrid_Auth( $config );
		
		$tumblrAdapter = $hybridauth->authenticate( "tumblr" );
		$apiKey='a40mfQYXnQMxPTVLQhtlS254xswVOKDDKOHXwGolAz6X2b7XJX';
		$userProfile = $tumblrAdapter->getUserProfile();
		
		//basename is the name provided in the user settings of Tumblr 
		$base_hostName = getBaseHostName( $userProfile->identifier) ; 
		
		$displayName  = $userProfile-> displayName;
		$photoURL  = $userProfile-> photoURL;

		echo '<pre>';
		$userHtml = ' ';
		$userHtml .= '<div>';
			$userHtml .= '<span> Display Name :'.$displayName.' </span>';
			$userHtml .= '<img src="'.$photoURL.'" style="width:32px; height:32px;" />';
		$userHtml .= '</div>';
		
		echo $userHtml;
		// sample code to test on browser		
		// http://api.tumblr.com/v2/blog/%20zoowimama.tumblr.com/posts/text?format=text&api_key=a40mfQYXnQMxPTVLQhtlS254xswVOKDDKOHXwGolAz6X2b7XJX 
		
		// http://api.tumblr.com/v2/blog/%20zoowimama.tumblr.com/info?format=text&api_key=a40mfQYXnQMxPTVLQhtlS254xswVOKDDKOHXwGolAz6X2b7XJX 
		
		// working copy 
		//$userPosts = $tumblrAdapter->api()->api('blog/'.$base_hostName.'/posts/text?format=text&api_key='.$apiKey);
		
		//$userInfo = $tumblrAdapter->api()->api('user/following');
		//v2/user/dashboard?type=text

//		$userInfo = $tumblrAdapter->api()->api('user/following?api_key=a40mfQYXnQMxPTVLQhtlS254xswVOKDDKOHXwGolAz6X2b7XJX&type=text');

		//$userInfo = $tumblrAdapter->api()->api('user/dashboard?api_key=a40mfQYXnQMxPTVLQhtlS254xswVOKDDKOHXwGolAz6X2b7XJX&type=text');
		/**
		 * Display the post from tumbler
		 */
		
		print_r($userInfo );
		//$dashboard = $tumblrAdapter->getDashboardPosts();
		

		
		
//		print_r($dashboard);

		//$userId  = $userInfo->response->user->id ;
		//print_r($eventsInfo );
		
	} catch (Exception $e){
		echo $e->getMessage();
	}
