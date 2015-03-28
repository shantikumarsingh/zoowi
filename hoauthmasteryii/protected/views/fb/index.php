<?php

/**
 * 
 * This file list the facebook pages
 * @param unknown_type $dt
 */
	
	function timestamp_to_relative_time( $dt )
	{
		$precision = 2;
		$times=array(	365*24*60*60	=> "year",
				30*24*60*60	=> "month",
				7*24*60*60	=> "week",
				24*60*60	=> "day",
				60*60		=> "hour",
				60		=> "minute",
				1		=> "second");

		$passed=time()-$dt;

		if($passed<5)
		{
			$output='less than 5 seconds ago';
		}
		else
		{
			$output=array();
			$exit=0;
			foreach($times as $period=>$name)
			{
				if($exit>=$precision || ($exit>0 && $period<60)) 	break;
				$result = floor($passed/$period);

				if($result>0)
				{
					$output[]=$result.' '.$name.($result==1?'':'s');
					$passed-=$result*$period;
					$exit++;
				}

				else if($exit>0) $exit++;

			}
			$output=implode(' and ',$output).' ago';
		}

		return $output;
	}
	
	

		// format message
	function format_string( $string )
	{
		// url to link
		$string = preg_replace( '/((?:http|https|ftp):\/\/(?:[A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?[^\s\"\']+)/i','<a href="$1" rel="nofollow" target="blank">$1</a>', $string ) ;

	// some stuff for twitter, just to demonstrate ...

		// hashtag to link
		$string = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1<a href="http://twitter.com/search/\2" rel="nofollow" target="blank">#\2</a>', $string );
		
		// @ to link
		$string = preg_replace('/(^|\s)@(\w*[a-zA-Z_]+\w*)/', '\1<a href="http://twitter.com/\2" rel="nofollow" target="blank">@\2</a>', $string );

		return $string;
	}

	/**
	 * 
	 * Facebook Functions 
	 * @param $user_activity
	 */
	
	function displayUserTimeLine($user_activity){
		//echo "<pre>";
		print_r($user_activity);
		exit;
		$timeline = '<div>' ;	
		foreach ($user_activity as $item) {
			$timeline .= '<a href="'.$item->user->profileURL.'">';
			if( $item->user->photoURL )
				$timeline .='<img src="'.$item->user->photoURL.'" border="0" width="48" height="48">';
			else 
				$timeline .='<img src="./images/profileuser.png" border="0" width="48" height="48">';
			$timeline .= '<span><a href="'.$item->user->profileURL.'"><b>'.$item->user->displayName.'</b></a> </span>';	
			$timeline .= '<span>'.format_string( $item->text ).'</span>';	
			$timeline .= '<small>'.timestamp_to_relative_time( $item->date ).'</small>';	
			$timeline .= '</a><br /> ';	
			
		}
		$timeline .= '</div>' ;	
		return $timeline;
	}
	
	function getPostId($id){
		$ids = explode("_" , $id) ;
		return $ids[1];
	}

	function formatUserComments($comments, $link){
		
		$feedData = '<a href="'.$link.'"> <div>';
		foreach ($comments as $comment){
			$feedData .= '<span> '.$comment['message'].'</span>';
			//$feedData .= '<span> Count '.$comment['like_count'].'</span><br />';
		} 
		$feedData .= '</div> </a>';
		return $feedData;
	}
	
	
		try {

			//echo CHtml::button(' POST ', array('submit' => array('fb/postPage'))); 
			echo CHtml::link(' POST ',array('fb/postPage'),array('class'=>'link_on_fb'));
			echo '<br />' ; 
			echo '<br />' ; 
			echo CHtml::link(' Update Status ',array('fb/updateStatusPage'),array('class'=>'link_on_fb')); 
			echo '<br />' ; 
			echo '<br />' ; 

			
			
			$config =  './protected/config/hoauth.php';
			require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
			$hybridauth = new Hybrid_Auth( $config );


			$fbAdapter = $hybridauth->authenticate( "facebook" );
			$fbUserProfile = $fbAdapter->getUserProfile();
			// UserId for Facebook account
			
			$fbIdentifier = $fbUserProfile->identifier; 
			//echo "<br />" . $fbIdentifier  ;
//			echo '<pre>' ;
//			$profileImage = $fbAdapter->api()->api('/880000108713199/picture?redirect=0&height=200&width=200&type=normal');
//			print_r($profileId);
//			exit;
	?>
	
<img style="width: 32px; height: 32px;"  src = "<?php echo $fbUserProfile->photoURL;?>" width= "32" height="32"></img>	
	<h3><?php echo  $fbUserProfile->displayName; ?></h3>
	<div class="row feed-list">
	<?php 

			$access_token = $fbAdapter->getAccessToken();
			//$timelineFeeds = $fbAdapter->api()->api('/me/home');
			$timelineFeeds = $fbAdapter->api()->api('/'.$fbIdentifier.'?fields=home.filter(others){message,id,from,picture,actions,shares,likes,comments,photos}');
			$timelineInnerData='';
//			echo "<pre>" ;
//	print_r($timelineFeeds);exit;
			$feeds = $timelineFeeds['home']['data'];
			foreach ($feeds as $key => $feed){
				
				//error_log(' Key ' . $key );
				
				if(isset($feed['picture']))
					$picture = $feed['picture'];
				
				$shares ='';	
				if(isset($feed['shares']))
					$shares = $feed['shares']['count'];
				
				if(isset($feed['message'])){
					
					$likes = '';

					$id = $feed['id'];
					$from = $feed['from']['name'];
					$fromId = $feed['from']['id'];
					$message = $feed['message'];
					if(isset($feed['likes']['data']))
						$likes = count($feed['likes']['data']);
					$link = count($feed['actions'][0]['link']);
					if(isset($feed['comments']['data']))
						$comments = $feed['comments']['data'];
					
					$post_created_time = '';
//					if(isset($feed['created_time]']))
						$post_created_time = timestamp_to_relative_time( strtotime($feeds[$key]['created_time']));
					
					$personProfileImage = $fbAdapter->api()->api('/'.$fromId.'/picture?redirect=0&height=200&width=200&type=normal');
					$personProfileImageData = $personProfileImage ['data']['url'];
						
					$timelineInnerData.='
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div data-toggle="modal" data-target="#'.$id.'" class="thumbnail">
								<div class="top-list-head">
									<div class="media">
										<div class="media-left">
											<a href="javascript:void(0);">
												<img class="media-object" src="'.$personProfileImageData.'" />
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">'.$from.'</h4>
											<ul class="list-inline">
												<li><small class="text-muted">'.$from.'</small></li>
												<li class="pull-right"><small class="text-muted">'.$post_created_time.'</small></li>
											</ul>
											<div class="">
												'.$message.'
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					';
					$timelineInnerData.='
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
													<img src="'.$picture.'" />
										    	</div>
										    	<div class="media-body">
													'.$message.'
													<p>
														Likes ('.$likes.') | Shares ('.$shares.')
													</p>
									    			<div class="media">
									';
								if(isset($comments))
								foreach ($comments as $comment){
									//$profileImage = $fbAdapter->api()->api('/'.$comment['from']['id'].'/picture?redirect=0&height=32&width=32&type=normal');
									$profileImage ['data']['url']= './images/profileuser.png';
									$timelineInnerData.='
								    	<div class="media-left">
								    		<!-- Need to replace the image src -->
								    		<img style= "width:px;height32px;" id="'.$comment['from']['id']. '" src="'.$profileImage ['data']['url'].'" />
								    		<span>'.$comment['from']['name']. '</span>
								    	</div>
						    			<div class="media-body">
							      			<h4>'. $comment['message'].'</h4>
							      			<p> Likes ('.$comment['like_count'].')</p>
							      			<span id="'.$comment['id'].'_span"></span>
							      			<input type"text" id="'.$comment['id'].'_comment" onkeypress="handleCarriageReturns(event, \''.$comment['id'].'\')" />							      
								        	<button type="button" class="btn btn-primary" onclick="postRepliesToComments(\''.$comment['id'].'\') ">Post</button>
							      		</div>';
														
								}

							//footer data
						$timelineInnerData .='
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
			}
		echo $timelineInnerData ;	
			
		} catch (Exception $e){
			echo $e->getMessage();
		}
// 		
?>		
</div>
<script type="text/javascript" >
/** 
 * Code that handles the carriage key
 */
	function handleCarriageReturns(e, id) {
	    if (e.keyCode == 13) {
	    	postRepliesToComments(id) 
	        return false;
	    }
	}
	
	/**
		Code that posts Comments to the facebook
	*/
	
	postRepliesToComments = function (id){
		var url = "index.php?r=fb/CurlPostTOProvder";
		var message  = $("#"+id+"_comment").val();
		var data = 'id='+ id  + '&message='+ message;
		$.ajax({
			type:"POST",
			cache:false,
			url:url,
			data:data,    // multiple data sent using ajax
			success: function (html) {
				$("#"+id+"_comment").val('') ;
				$("#"+id+"_span").html(message) ;
			}
		});
	};
</script>