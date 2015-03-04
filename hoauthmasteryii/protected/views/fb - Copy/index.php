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

	function displayUserActivity($user_activity){
		
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
	?>
	
<img src = "<?php echo $fbUserProfile->photoURL;?>" width= "32" height="32"></img>	
	<h3><?php echo  $fbUserProfile->displayName; ?></h3>
	<?php 
			//get Friends List
			//$response = $fbAdapter->api()->api('/me/friends?fields=link,name');
// OR			
			//$personFriendsList = $fbAdapter->api()->api('/'.$fbIdentifier.'/friends?fields=link,name');
			//print_r($personFriendsList ); 
			//exit;
			
	// get the timeline 		
			$user_time_line = $fbAdapter->getUserActivity( "timeline" );
			$time_line = displayUserTimeLine($user_time_line );
			echo $time_line;
		} catch (Exception $e){
			echo $e->getMessage();
		}
			//exit;
		
//		echo $fbUserProfile ->displayName; 
//		echo "<br />" . $fbUserProfile ->profileURL; 
//		echo "<pre>" ;
		
		//print_r( $fbAdapter->config['keys']['id'] );
		//print_r( $fbAdapter );
		//print_r( $fbAdapter->getAccessToken() );

		/*
		$adapter2 = $hybridauth->authenticate( "twitter" );
		$user_profile2 = $adapter2->getUserProfile();
		echo "<br>". $user_profile2->displayName; 
		echo "<br />" . $user_profile2->profileURL; 
		*/
?>		
