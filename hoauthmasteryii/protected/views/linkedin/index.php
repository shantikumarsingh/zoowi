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
		// get the User Profile. 
		$linkedInAdapter = $hybridauth->authenticate( "linkedin" );
		/**
		 * TODO Format the Profle Page
		 * print_r($linkedInAdapter->getUserProfile());
		 */
		echo '<pre>';
			// working
//		$api_response = $linkedInAdapter->api()->profile('~:(id,industry,positions,languages)'); 
//		$api_response = $linkedInAdapter->api()->profile('~?format=json', 'post');



		$api_response = $linkedInAdapter->api('people-search?sort=connections');//->profile('~:(id,industry,positions,languages)'); 

		print_r($api_response);

		
	} catch (Exception $e){
		echo $e->getMessage();
	}
