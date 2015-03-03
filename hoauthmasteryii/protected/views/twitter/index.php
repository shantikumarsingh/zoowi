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
				$contactHtml  .='<a href="'.$item->profileURL.'"><img src="'.$item->photoURL.'" border="0" width="48" height="48"></a>';
			else 
				$contactHtml .='<a href="'.$item->profileURL.'"><img src="./images/profileuser.png" border="0" width="48" height="48"></a>';
			$contactHtml .= '<span><a href="'.$item->profileURL.'"<b>'.$item->displayName.'</b></a> </span>';	
		}
		return $contactHtml. "<br />" ;
	}

	function displayUserTimeLine($user_activity){
			
		$timeline = '<div>' ;	
		foreach ($user_activity as $item) {
			if( $item->user->photoURL )
				$timeline .='<a href="'.$item->user->profileURL.'"><img src="'.$item->user->photoURL.'" border="0" width="48" height="48"></a>';
			else 
				$timeline .='<a href="'.$item->user->profileURL.'"><img src="./images/profileuser.png" border="0" width="48" height="48"></a>';
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
			$formatTimelineHtml  .='<div>';
			$formatTimelineHtml  .=" <span> display text "  .  $timeLine->text . "</span> " ; 
			$formatTimelineHtml  .=" <span> Tweet Count "  .  $timeLine->retweet_count . "</span>" ; 
			$formatTimelineHtml  .= " <span> Favourite Count "  .  $timeLine->favorite_count. "</span>" ;
			$formatTimelineHtml  .='</div> <br/>'; 
		}
		return $formatTimelineHtml ;
	}
	
	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );
	
	$twitter = $hybridauth->authenticate( "Twitter" );

	// return TRUE or False <= generally will be used to check if the user is connected to twitter before getting user profile, posting stuffs, etc..
	$is_user_logged_in = $twitter->isUserConnected();
	$user_profile = $twitter->getUserProfile();
	$identifier = $user_profile->identifier ;


?>
		
	<img src = "<?php echo $user_profile->photoURL; ?>" width= "32" height="32"></img>		
	<h3><?php echo  $user_profile->displayName; ?></h3>
	<hr>

	<h3>User Contacts </h3>
<?php 
	echo $userContacts = getUserContacts($twitter->getUserContacts());

?>

	<hr>
<?php 
/** 
 * get Timelines
 */
/*
			$user_time_line = $fbAdapter->getUserActivity( "timeline" );
			$time_line = displayUserTimeLine($user_time_line );
			
*/
			echo '<pre>';
			//$user_time_line = $twitter->getUserActivity( "timeline" );
//			$user_time_line = $twitter->api()->api('/statuses/user_timeline.json'); //  returns data 
			$user_time_line = $twitter->api()->api('/statuses/user_timeline.json');
			$timelineHtml = formatTimeline($user_time_line);
			echo $timelineHtml  ;
			
			//print_r($user_time_line); 
			
			//$time_line = displayUserTimeLine($user_time_line );
			//echo $time_line;
?>			
	<hr>
	<h3> Activity </h3>	
<?php 
	$user_activity = $twitter->getUserActivity( "me" ); 

?>	