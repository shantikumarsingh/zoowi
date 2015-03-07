<?php

/**
 * @author Sunil Kumar
 * This file list the Tumblr Pages 
 * @param 
 */
	

	try {

		$config =  './protected/config/hoauth.php';
		require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
		$hybridauth = new Hybrid_Auth( $config );

		$fsAdapter = $hybridauth->authenticate( "tumblr" );

		echo '<pre>';
		//$userInfo = $fsAdapter->api()->api('/users/self/?v='.$version);
		//$userId  = $userInfo->response->user->id ;
		//print_r($eventsInfo );
		
	} catch (Exception $e){
		echo $e->getMessage();
	}
