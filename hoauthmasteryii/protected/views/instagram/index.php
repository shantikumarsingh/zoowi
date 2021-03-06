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
	
	function displayUserFeed($userFeed){
		$userFeedDisplay = '';
		
		foreach ($userFeed as $key => $feeds){
			if(  $key == 'meta' || $key == 'pagination'  ){ /** Use the Pagination or meta data for future references **/} 
			else {
				foreach($feeds as $feedKey => $feed ) {
					
					//print_r($feed->comments);
					$userFeedDisplay.= '<div>' ;
					//print_r($feed->images->standard_resolution->url);
					// thumbnail // low_resolution // standard_resolution
					$userFeedDisplay .= '	<img src="'.$feed->images->thumbnail->url.'" width="'.$feed->images->standard_resolution->width.'" height="'.$feed->images->standard_resolution->height.'" /> <br />';
					$userFeedDisplay .='<span>';
					$userFeedDisplay .= $feed->caption->text;
					$userFeedDisplay.= '</span>';
					$userFeedDisplay .= '</div>' ;
					//print_r($feed->caption->text. '<br > **** <br />');
				}
			
			}
			//print_r($key);
			//exit;
			
			
		}
		return $userFeedDisplay;
	}
	

	
	
		try {

			
			$config =  './protected/config/hoauth.php';
			require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
			$hybridauth = new Hybrid_Auth( $config );

			// https://instagram.com/developer/api-console/
			$fbAdapter = $hybridauth->authenticate( "instagram" );
			// display the user profile 
			$userProfile = $fbAdapter -> getUserProfile();
			
			$userFeed = $fbAdapter->api()->api('/users/self/feed');
			echo '<pre>';
			$feedsHtml = displayUserFeed($userFeed);
			//print_r($userFeed);
			echo $feedsHtml ;
			
			
		} catch (Exception $e){
			echo $e->getMessage();
		}
