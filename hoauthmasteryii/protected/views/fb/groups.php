<?php
	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );


	$fbAdapter = $hybridauth->authenticate( "facebook" );
	$fbUserProfile = $fbAdapter->getUserProfile();
	$fbIdentifier = $fbUserProfile->identifier; 

	$access_token = $fbAdapter->getAccessToken();
	$myGroupsList = $fbAdapter->api()->api($fbIdentifier.'/groups?access_token='.$access_token['access_token']); // working groups

	//	$myGroupsList = $fbAdapter->api()->api($fbIdentifier.'/pages'); //  
//	$myGroupsList = $fbAdapter->api()->api('155689736457259/members'); // 
	$htmlData ='';
	foreach($myGroupsList['data'] as $group){
		$htmlData .='
			<div class=" row table table-striped">
				<div class="col-md-12"><h3>'.$group['name'].'</h3></div>';
				
				$myGroupsMemberList = $fbAdapter->api()->api($group['id'].'/members?access_token='.$access_token['access_token'].'&limit=25');
				
				foreach ($myGroupsMemberList['data'] as $members){
					
					$profileImage = $fbAdapter->api()->api('/'.$members['id'].'/picture?redirect=0&height=200&width=200&type=normal');
					$htmlData .='
					<div class="col-md-12">
						<div class="col-md-1"><img src="'.$profileImage['data']['url'].'" width="48px" height="48px" /></div> 
						<div class="col-md-11">'.$members['name'];
						if($members['administrator']== '1'){
						//	echo "** " ; 
							$htmlData .='<i class="fa-cog"></i>';
						}
						
					$htmlData .='
						</div>
		  			</div>
					';
					
				}
		$htmlData .='
			</div>';
	}
echo $htmlData;	
	
