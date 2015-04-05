<?php
	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );


	$fbAdapter = $hybridauth->authenticate( "facebook" );
	$fbUserProfile = $fbAdapter->getUserProfile();
	$fbIdentifier = $fbUserProfile->identifier; 

	$access_token = $fbAdapter->getAccessToken();
	$friendsList = $fbAdapter->api()->api('/me/taggable_friends?limit=100'); // working here

	$htmlData ='';
		//print_r($friendsList);exit;
	foreach ($friendsList['data'] as $friends){
		$htmlData .= 
			'<div class=" row table table-striped">
				<div class="col-md-2"><img src="'.$friends['picture']['data']['url'].'" width="32px" height="32px"/></div>
				<div class="col-md-2">
				  	<ul>
				  		<li>'.$friends['name'].'</li>
				  		<li>invite</li>
			  		</ul>
		  		</div>
			  	<div class="col-md-6"></div>
			  	<div class="col-md-2"></div>
			</div>';
	}
	
	echo $htmlData;
	
	
