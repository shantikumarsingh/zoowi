<?php

/**
 * 
 * This file list the twitter feeds
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


	function getUserContacts($userContacts){
		$contactHtml ='';
		foreach ($userContacts as $item) {
			if( $item->photoURL )
				$contactHtml  .='<a href="'.$item->profileURL.'"><img src="'.$item->photoURL.'" border="0" style="width:48px; height:48px;"></a>';
			else 
				$contactHtml .='<a href="'.$item->profileURL.'"><img src="./images/profileuser.png" border="0" style="width:48px; height:48px;" ></a>';
			$contactHtml .= '<span><a href="'.$item->profileURL.'"<b>'.$item->displayName.'</b></a> </span>';	
		}
		return $contactHtml. "<br />" ;
	}

	function displayUserTimeLine($user_activity){
			
		$timeline = '<div>' ;	
		foreach ($user_activity as $item) {
			if( $item->user->photoURL )
				$timeline .='<a href="'.$item->user->profileURL.'"><img src="'.$item->user->photoURL.'" border="0" style="width:48px; height:48px;"></a>';
			else 
				$timeline .='<a href="'.$item->user->profileURL.'"><img src="./images/profileuser.png" border="0" style="width:48px; height:48px;" ></a>';
			$timeline .= '<span><a href="'.$item->user->profileURL.'"<b>'.$item->user->displayName.'</b></a> </span>';	
			$timeline .= '<span>'.format_string( $item->text ).'</span>';	
			$timeline .= '<small>'.timestamp_to_relative_time( $item->date ).'</small> <br />';	
		}
		$timeline .= '</div> ' ;	
		return $timeline;
	}
	
	function formatTimeline($user_time_line){
		$formatTimelineHtml = '' ;
		foreach ($user_time_line as $key=> $timeLine) {
			$image = $timeLine->user->profile_image_url_https ;
  			$text  = $timeLine->text  ;
			if(isset($timeLine->retweeted_status->text)){
				$image = $timeLine->retweeted_status->user->profile_image_url_https ;
				$text = $timeLine->retweeted_status->text  ;
			}
			$formatTimelineHtml  .='
				<div class="container" data-toggle="modal" data-target="#'.$timeLine->id_str.'">
				  
					<img src="'.$image.'" style="width:32px;height:32px;" />
				
				'.$text.'
				</div>
			';
			$twitterAction  = 
				'<script type="text/javascript" async src="//platform.twitter.com/widgets.js"></script>
				<a href="https://twitter.com/intent/tweet?in_reply_to='.$timeLine->id_str.'"><i class="fa fa-reply"></i></a>
				<a href="https://twitter.com/intent/retweet?tweet_id='.$timeLine->id_str.'"><i class="fa fa-retweet"></i></a> '.$timeLine->retweet_count .'
				<a href="https://twitter.com/intent/favorite?tweet_id='.$timeLine->id_str.'"><i class="fa fa-star"></i></a> '.$timeLine->favorite_count ;
	
			
			$formatTimelineHtml .='
				<div class="modal fade" id="'.$timeLine->id_str.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
				      </div>
				      <div class="modal-body">
					<img src="'.$image.'" style="width:32px;height:32px;" />
				';
				if(isset($timeLine->extended_entities->media))
					foreach($timeLine->extended_entities->media as $media){
	 					$formatTimelineHtml .= '<img style="width:568px;height:379px" src="'.$media->media_url_https.'" />' ;
					}	
					
		 		$formatTimelineHtml .= $text ;
 				$formatTimelineHtml  .='<div>';
				//$formatTimelineHtml  .=" <span> display text "  .  $text . "</span> " ; 
	//			$formatTimelineHtml  .=" <span> Tweet Count "  .  $timeLine->retweet_count . "</span>" ; 
	//			$formatTimelineHtml  .= " <span> Favourite Count "  .  $timeLine->favorite_count. "</span>" ;
				$formatTimelineHtml  .='</div> ';
				$formatTimelineHtml .='
					</div>
				      <div class="modal-footer">';
						$formatTimelineHtml  .= $twitterAction ;
						$formatTimelineHtml  .= '
				      </div>
				    </div>
				  </div>
				</div>
				';			
		}
		return $formatTimelineHtml ;
	}

	

	/**
	 * 
	 * return the current trends in Twitter
	 * @param $hybridauth
	 */

	function getTwitterTrends($hybridauth){
		/**
		 * TODO refactor the code, as this is not working.
		 */
		$twitter = $hybridauth->authenticate( "Twitter" );
		$user_profile = $twitter->getUserProfile();
		$identifier = $user_profile->identifier ;	
		$twitterTrends = $twitter->api()->api('trends/available.json');
		print_r($twitterTrends);
	}
	
	
	
	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );
	
	$twitter = $hybridauth->authenticate( "Twitter" );

	// return TRUE or False <= generally will be used to check if the user is connected to twitter before getting user profile, posting stuffs, etc..
	//$is_user_logged_in = $twitter->isUserConnected();
	$user_profile = $twitter->getUserProfile();
	$identifier = $user_profile->identifier ;


?>
		
	<img src = "<?php echo $user_profile->photoURL; ?>" style="width:48px; height:48px;"></img>		
	<h3><?php echo  $user_profile->displayName; ?></h3>
	<hr>

<?php 
/** 
 * get Timelines
 */
			$user_time_line = $twitter->api()->api('/statuses/home_timeline.json');
	//		echo "<pre>" ;
	//		print_r($user_time_line); exit;
			$timelineHtml = formatTimeline($user_time_line);
			echo $timelineHtml  ;

?>	