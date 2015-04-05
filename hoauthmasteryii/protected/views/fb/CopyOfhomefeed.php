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
	
	
	function formatHomeTimeLineFeeds ($timelineFeeds){
/*		echo "<pre>" ;
		print_r($timelineFeeds);
		return;*/
		
				$timelineFeeds = $timelineFeeds['data'];
		$timelineInnerData='' ;
		foreach ($timelineFeeds  as $feed) {

			$likes='';
			$shares='';
			$id = $feed['id'];
			$message = '';
			if(isset($feed['message']))
				$message = $feed['message'];
			if(isset($feed['story'])){
				$story = $feed['story'];
				if($message == '')
					$message = $story;
			}	
			$from = '';	
			if(isset($feed['name']))
				$from = $feed['name'];
			
			if(isset($feed['picture']))
			$personProfileImageData = $feed['picture'];
			
			if(isset($feed['actions']))
				$postActions = $feed['actions'];
			if(isset($feed['type']))
			$postType = $feed['type'];
			if(isset($feed['object_id']))
			$objectId = $feed['object_id'];
			$post_created_time = $feed['created_time'];
				$timelineInnerData.='
						<div class="pin">
							<div data-toggle="modal" data-target="#'.$id.'" class="thumbnail">
								<div class="top-list-head">
									<div class="media">
										<div class="media-left">
											<a href="javascript:void(0);">
												<img class="media-object" src="'.$personProfileImageData.'" />
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">'.$from.'<small class="pull-right"><i class="fa fa-facebook-square fa-lg"></i></small></h4>
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
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							      	<div class="modal-header">
							        	<div class="modal-title" id="myModalLabel">
								        	<div class="media">
												<div class="media-left">
													<a href="javascript:void(0);">
														<img class="media-object" src="'.$personProfileImageData.'" />
													</a>
												</div>
												<div class="media-body">
													<h4 class="media-heading">'.$from.'<small class="pull-right"><i class="fa fa-facebook-square fa-lg"></i></small></h4>
													<ul class="list-inline">
														<li><small class="text-muted">'.$from.'</small></li>
														<li class="pull-right"><small class="text-muted">'.$post_created_time.'</small></li>
													</ul>
												</div>
											</div>
										</div>

							      	</div>
							      	<div class="modal-body">
							      		<div class="media-list">
									    	<div class="media">
										    	<div class="media-left">
													<img src="'.$personProfileImageData.'" />
										    	</div>
										    	<div class="media-body">
													<p>'.$message.'</p>
													<ul class="list-inline">
														<li><a href="javascript:vodi(0);"><small><i class="fa fa-thumbs-o-up"></i> Likes ('.$likes.')</small></a></li>
														<li><a href="javascript:vodi(0);"><small><i class="fa fa-share"></i> Shares ('.$shares.')</small></a></li>
													</ul>
									    			
									    			<div class="well">';

				if(isset($feed['comments'])){
					$timelineInnerData.='hello	';
				$comments = $feed['comments'];
				
				foreach ($comments as $comment){
					if(isset($comment['from'])){
						$commentFromId = $comment['from']['id'];
						$commentFromName = $comment['from']['name'];
					}
					
					
					if(isset($comment['message'])){
						$commentMessage = $comment['message'];
						$commentCreatedTime = $comment['created_time'];
						$commentLikeCount = $comment['like_count'];
						
					}$timelineInnerData .=' here ';
					
				}
				
		
			} //if ends here
	
		$timelineInnerData .='			
					    			</div>
						      	</div>
					    	</div>
			      		</div>
					</div>
		      	<!-- <div class="modal-footer">
					
		      	</div> -->
		    </div>
		  </div>
		</div>';
					
			
	
			
			

			
		}
		echo $timelineInnerData ;
	}
	
	
		try {

			
			
			$config =  './protected/config/hoauth.php';
			require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
			$hybridauth = new Hybrid_Auth( $config );


			$fbAdapter = $hybridauth->authenticate( "facebook" );
			$fbUserProfile = $fbAdapter->getUserProfile();
			// UserId for Facebook account
			
			$fbIdentifier = $fbUserProfile->identifier; 
	?>
	
	<div class="">
		<img style="width: 32px; height: 32px;"  src = "<?php echo $fbUserProfile->photoURL;?>" />
		<h3><?php echo  $fbUserProfile->displayName; ?></h3>
	</div>
	<div class="row feed-list">
		<div class="">
	
	<?php 

			$access_token = $fbAdapter->getAccessToken();
			$homeTimelineFeeds = $fbAdapter->api()->api($fbIdentifier.'/home?limit=25');
//			$homeTimelineFeeds = $fbAdapter->api()->api($fbIdentifier.'/feed?is_visible=true');
			//echo "<pre>" ;
			//print_r($homeTimelineFeeds);
			//$timelineInnerData='';
			formatHomeTimeLineFeeds ($homeTimelineFeeds ) ; 
			
			
			/*
			$timelineFeeds = $fbAdapter->api()->api('/'.$fbIdentifier.'?fields=home.filter(others){message,id,from,picture,actions,shares,likes,comments,photos}');
			$timelineInnerData='';
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
						<div class="pin">
							<div data-toggle="modal" data-target="#'.$id.'" class="thumbnail">
								<div class="top-list-head">
									<div class="media">
										<div class="media-left">
											<a href="javascript:void(0);">
												<img class="media-object" src="'.$personProfileImageData.'" />
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">'.$from.'<small class="pull-right"><i class="fa fa-facebook-square fa-lg"></i></small></h4>
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
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							      	<div class="modal-header">
							        	<div class="modal-title" id="myModalLabel">
								        	<div class="media">
												<div class="media-left">
													<a href="javascript:void(0);">
														<img class="media-object" src="'.$personProfileImageData.'" />
													</a>
												</div>
												<div class="media-body">
													<h4 class="media-heading">'.$from.'<small class="pull-right"><i class="fa fa-facebook-square fa-lg"></i></small></h4>
													<ul class="list-inline">
														<li><small class="text-muted">'.$from.'</small></li>
														<li class="pull-right"><small class="text-muted">'.$post_created_time.'</small></li>
													</ul>
												</div>
											</div>
										</div>

							      	</div>
							      	<div class="modal-body">
							      		<div class="media-list">
									    	<div class="media">
										    	<div class="media-left">
													<img src="'.$picture.'" />
										    	</div>
										    	<div class="media-body">
													<p>'.$message.'</p>
													<ul class="list-inline">
														<li><a href="javascript:vodi(0);"><small><i class="fa fa-thumbs-o-up"></i> Likes ('.$likes.')</small></a></li>
														<li><a href="javascript:vodi(0);"><small><i class="fa fa-share"></i> Shares ('.$shares.')</small></a></li>
													</ul>
									    			
									    			<div class="well">';
								if(isset($comments))
								foreach ($comments as $comment){
									//$profileImage = $fbAdapter->api()->api('/'.$comment['from']['id'].'/picture?redirect=0&height=32&width=32&type=normal');
									$profileImage ['data']['url']= './images/default_user.png';
									$timelineInnerData.=' <div class="media">
													    	<div class="media-left">
														    	<a href="javascript:void(0);">
																	<img class="media-object" id="'.$comment['from']['id']. '" src="'.$profileImage ['data']['url'].'" />
																</a>
													    	</div>
											    			<div class="media-body">
													    		<h4 class="media-heading">'.$comment['from']['name']. '</h4>
												      			<ul class="list-inline">
												      				<li><a href="javascript:void(0);"><small><i class="fa fa-thumbs-o-up"></i> Likes ('.$comment['like_count'].')</small></a></li>
												      				<li id="'.$comment['id'].'_span"></li>
												      			</ul>
												      			<p>'. $comment['message'].'</p>
												      			<form class="form-inline">
												      				<div class="form-group">
												      					<img style="width:32px;height:32px;" src="'.$personProfileImageData.'" />
												      					<input type"text" placeholder="Write a comment here ..." class="form-control" id="'.$comment['id'].'_comment" onkeypress="handleCarriageReturns(event, \''.$comment['id'].'\')" />
												      				</div>
												      				<!--<div class="form-group">
													        			<button type="button" class="btn btn-primary" onclick="postRepliesToComments(\''.$comment['id'].'\') ">Post</button>
													        		</div>-->
													        	</form>
												      		</div>
												      	</div>';
														
								}

							//footer data
						$timelineInnerData .='			
									    			</div>
										      	</div>
									    	</div>
							      		</div>
									</div>
						      	<!-- <div class="modal-footer">
									
						      	</div> -->
						    </div>
						  </div>
						</div>';
					
				}
			}
	//	echo $timelineInnerData ;	
			*/
		} catch (Exception $e){
			echo $e->getMessage();
		}
// 		
?>		
	</div>
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