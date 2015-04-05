<?php

/**
 * 
 * Comments :  need to discuss what need to be shown
 * @var unknown_type
 */

	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );
	
	$twitterAdapter = $hybridauth->authenticate( "twitter" );
	$list = $twitterAdapter ->api()->api('2987691269/ists/list.json');

	$user_profile = $twitterAdapter->getUserProfile();
	echo $identifier = $user_profile->identifier ;	
	
//	$suggestionsList = $twitterAdapter ->api()->api('/2987691269/suggestions/politics-government/members.json');
	echo "<pre>";
	print_r($list);
