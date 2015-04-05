<?php 

	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );
	$twitterAdapter = $hybridauth->authenticate( "twitter" );
	$myMentions = $twitterAdapter ->api()->api('statuses/mentions_timeline.json');
	
	$mentionsHtml = '' ;
	foreach($myMentions as $mentions){
		
		$id = $mentions->user->id_str;
		$personProfileImageData = $mentions->user->profile_image_url_https;
		$personProfileName = $mentions->user->name;
		$personProfileScreenName= $mentions->user->screen_name;
		$personProfileDescriptiotn= $mentions->user->description;
		$mentionsHtml .='
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<a href="#" class="center-block panel panel-default" data-toggle="modal" data-target="#'.$id.'">
						  		<div class="panel-body">
							  		<div class="media">
							  			<div class="media-left">
							  				<img style="width:32px;height:32px;" src="'.$personProfileImageData.'" /> 
							  				<span aria-hidden="true">'.$personProfileName.'</span>
							  				<span aria-hidden="true">@'.$personProfileScreenName.'</span>
							  			</div>
							  			<div class="media-body">
							  				'.$personProfileDescriptiotn.'
							  			</div>
							  		</div>
							  	</div>
							</a>
						</div>
					';
				$mentionsHtml.='
						<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
						  	<div class="modal-dialog">
							    <div class="modal-content">
							      	<div class="modal-header">
							        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        	<h4 class="modal-title" id="myModalLabel">Modal title</h4>
							      	</div>
							      	<div class="modal-body">
							      		<ul class="media-list">
									    	<li class="media">
										    	<div class="media-left">
													<img style="width:32px;height:32px;"  src="'.$personProfileImageData.'" />
										    	</div>
										    	<div class="media-body">
													'.$personProfileDescriptiotn.'
									    			<div class="media">';
											$mentionsHtml .=
											'				  				
										  				<span aria-hidden="true">'.$personProfileName.'</span>
										  				<span aria-hidden="true">@'.$personProfileScreenName.'</span>
						
									    			</div>
										      	</div>
									    	</li>
							      		</ul>
								</div>
						      	<div class="modal-footer">
									
						      	</div>
						    </div>
						  </div>
						</div>';
	
	}
	echo $mentionsHtml;

?>