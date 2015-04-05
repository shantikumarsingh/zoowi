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
	$notifications = $fbAdapter->api()->api($fbIdentifier.'/notifications?filter(un_read)&permission=manage_notifications&limit=50'); 
	
	
	//echo "<pre>" ;
	
	//print_r($personFriendList);
	?>
	
	<div class="row">
		<ul class="nav navbar-nav  navbar-left">
			<li><a href="#"><i class="fa fa-bell-o"></i> Notifications <sup class="badge badge-danger"><?php echo $notifications['summary']['unseen_count'];?></sup></a></li>
		</ul>
	</div>
	<div class="row">
	<?php 
		$notificationHtml = '';
		if($notifications['summary']['unseen_count']){
			foreach ($notifications['data'] as $notification) {
				$profileImage = $fbAdapter->api()->api('/'.$notification['from']['id'].'/picture?redirect=0&height=200&width=200&type=normal');
				$notificationHtml .= '<div class="col-md-1"><img src="'.$profileImage['data']['url'].'" width="48px" height="48px" /></div>';
				$notificationHtml .= "<div>". $notification['title'] ."</div>";
				$notificationHtml .= "<div>". timestamp_to_relative_time( strtotime($notification['created_time'])) ."</div>";
				$notificationHtml .= "<div>". $notification['link'] ."</div>";
				$count++;
			}
		}
		echo $notificationHtml ;
	?>
	</div>