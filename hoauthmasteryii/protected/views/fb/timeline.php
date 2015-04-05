<?php
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


	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );
	$fbAdapter = $hybridauth->authenticate( "facebook" );
	$fbUserProfile = $fbAdapter->getUserProfile();

	// UserId for Facebook account
	$fbIdentifier = $fbUserProfile->identifier;
	$userTimeline= $fbAdapter->api()->api($fbIdentifier.'/home'); 
	
	
//	echo '<pre>' ;print_r($userTimeline['data'] ); exit;
	$timelineHtml='';
	foreach($userTimeline['data'] as $timeline){
		$story = '';
		$picture = '';
		$link = '';
		if(isset($timeline['story'])){
			 $story = $timeline['story'];
			 $timelineHtml .= '<div>' . $story. '</div>';
		}
		$shares='';	  
		if(isset($timeline['share']))
			 $shares = $timeline['share'];
		if(isset($timeline['link']))
			 $link = $timeline['link'];
		if(isset($timeline['picture'])){
			 $picture = $timeline['picture'];
			 $timelineHtml .= '<div><a href="'.$link.'"> <img src="'.$picture.'" /></a></div>';
		}	 
		
	 	$likeCount = '';
		 if(isset($timeline['likes'])){
		 	$likeCount = count($timeline['likes']['data']);
			foreach($timeline['likes']['data'] as $likes){
				$likedById = $likes['id']; 
				$likedByName = $likes['name']; 
			}
		 }	 
		 $timelineHtml .= '
		 <div>
 			<ul class="list-inline">
				<li><a href="javascript:vodi(0);"><small><i class="fa fa-thumbs-o-up"></i> Likes ('.$likeCount.')</small></a></li>
				<li><a href="javascript:vodi(0);"><small><i class="fa fa-share"></i> Shares ('.$shares.')</small></a></li>
			</ul>
		</div>' ;
		 
		 if(isset($timeline['comment'])){
		 	$timelineHtml .= ' if';
		 	foreach ($timeline['comment']['data'] as $comment) {
		 		$timelineHtml .= ' foreach comment';	
		 		$commentId = $comment['id'];
		 		$commentMessage = $comment['message'];
		 		$commentById = $comment['from']['id'];
		 		$commentByName = $comment['from']['name'];
		 		$commentCreated_time = $comment['created_time'];
		 		$commentLikeCount = $comment['like_count'];
		 		$timelineHtml .= '<div> Inner Comment '.$commentMessage .'</div>';
		 	}
		 }
	}
	echo $timelineHtml;	
?>
