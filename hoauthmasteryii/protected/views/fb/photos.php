<?php

	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );

	$fbAdapter = $hybridauth->authenticate( "facebook" );
	$fbUserProfile = $fbAdapter->getUserProfile();

	// UserId for Facebook account
	echo $fbIdentifier = $fbUserProfile->identifier; 

	$access_token = $fbAdapter->getAccessToken();
	//$timelineFeeds = $fbAdapter->api()->api('/1403484586624470/albums?fields=photos&access_token='.$access_token['access_token']); //
	$userPhotos = $fbAdapter->api()->api('/'.$fbIdentifier.'/albums?fields=photos&access_token='.$access_token['access_token'].'&is_visible=true&limit=25');
	
	echo "<pre>" ;
	$photos = $userPhotos['data'];
	$htmlData  = '';  
	foreach ($photos as $photoList) {
		
		$photos  = $photoList['photos']['data'] ;
		foreach ($photos as $photo){
			$htmlData .='<img src= "'.$photo['picture'].'" width="300" height="400"> <br />';
			
		}
	}
	
echo $htmlData  ;
