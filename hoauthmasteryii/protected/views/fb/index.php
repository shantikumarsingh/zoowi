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
		echo "<pre>";
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
			
	?>
	
<img style="width: 32px; height: 32px;"  src = "<?php echo $fbUserProfile->photoURL;?>" width= "32" height="32"></img>	
	<h3><?php echo  $fbUserProfile->displayName; ?></h3>
	<?php 

		//	$trends = $fbAdapter->api()->api('/trends?country=US&fields=headline,categories,photo_icon');
		//	print_r($trends);
		//	exit;
		//	exit;

	// checking the files 
		
			$timelineFeeds = $fbAdapter->api()->api('/me/posts');
			//echo "<pre>" ;print_r($timelineFeeds); exit;
			$timelineInnerData='';
			foreach ($timelineFeeds as $key => $feeds){
				
				if($key != 'paging')
					foreach ($feeds as $iKey => $feed){
						if(isset($feed['message']))
						$timelineInnerData.='
							<div class="panel panel-default" data-toggle="modal" data-target="#'.$feed['id'].'">
							  <div class="panel-body">'.$feed['message'].'</div>
							</div>
						';
						$timelineInnerData.='
						<div class="modal fade" id="'.$feed['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
						      </div>
						      <div class="modal-body">
						';
						if(isset($feed['message']))
							$timelineInnerData .= '<a href="'.$feed['actions'][0]['link'].'" target="__blank"><span>'.$feed['message'].'</span>' ;
						if(isset($feed['comments']['data']))
						{
							foreach($feed['comments']['data'] as $comment)
							{
								$timelineInnerData  .=  $comment['message'] . '  Likes  '. $comment['like_count'] ;
							}		
						}
						$timelineInnerData .='</a>';
							//footer data
						$timelineInnerData .='
							</div>
						      <div class="modal-footer">
								<input type"text" />							      
						        <button type="button" class="btn btn-primary">Post</button>
						      </div>
						    </div>
						  </div>
						</div>
						';
					}
			}
			
		echo $timelineInnerData ;	
		} catch (Exception $e){
			echo $e->getMessage();
		}
// 		
?>		
