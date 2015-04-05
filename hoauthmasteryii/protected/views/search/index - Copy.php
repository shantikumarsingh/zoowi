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


	function getSearchTagsFromFb($hybridauth, $keyWord){

		$fbAdapter = $hybridauth->authenticate( "facebook" );
		//$fbUserProfile = $fbAdapter->getUserProfile();
		// UserId for Facebook account
		//$fbIdentifier = $fbUserProfile->identifier;
		try{
			$access_token = $fbAdapter->getAccessToken();
			$searchPost = $fbAdapter->api()->api('/search?q=%23'.$keyWord.'&type=page&access_token='.$access_token['access_token']);
			print_r($searchPost);
		}catch (FacebookApiException $e) {
		      //print_r($e->getMessage());
   		}		
	}
	
	function formHtmlStructure($statuses){
		$htmlStructure = '';
		$htmlStructure = '

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="..." alt="...">
      <div class="carousel-caption">
        1234
      </div>
    </div>
    <div class="item">
      <img src="..." alt="...">
      <div class="carousel-caption">
        5678
      </div>
    </div>
    <div class="item">
      <img src="..." alt="...">
      <div class="carousel-caption">
        abcd
      </div>
    </div>
  </div>
';
		
		/*
			foreach($statuses as $status){
				//echo $status -> id_str;
				//print_r($status->id_str);
				
				//if($status->id_str){
				
				if(isset($status->id_str)){
					$htmlStructure .='
						<div class="container" data-toggle="modal" data-target="#'.$status->id_str.'">
						  '.$status->text.'
						</div>
					';
				}
				/*
					$htmlStructure .='
						<div class="modal fade" id="'.$status->id_str.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
						      </div>
						      <div class="modal-body">
						';
						 $htmlStructure .= 'Inner Data here '.$status->text  ;
							//footer data
						$htmlStructure .='
							</div>
						      <div class="modal-footer">
								<input type"text" />							      
						        <button type="button" class="btn btn-primary">Post</button>
						      </div>
						    </div>
						  </div>
						</div>
						';
				//}
				 * 
				 */
			//}
		return $htmlStructure ;
	}
	
	function getSearchTagsFromTwitter($hybridauth, $keyWord){

		$twitterAdapter = $hybridauth->authenticate( "twitter" );
		//$fbUserProfile = $fbAdapter->getUserProfile();
		// UserId for Facebook account
		//$fbIdentifier = $fbUserProfile->identifier;
		try{
			$access_token = $twitterAdapter ->getAccessToken();
			$statuses = $twitterAdapter ->api()->api('search/tweets.json?q=blue%20stallion&type=page&access_token='.$access_token['access_token']);
			
			$html = '
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>
			
			';
			foreach($statuses as $status){
				$html .= formHtmlStructure($status);
				break;
			}
			
			$html .='
		
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>	
			
			';
			echo  $html ; 
			
		}catch (FacebookApiException $e) {
		      //print_r($e->getMessage());
   		}		
		
		
	}
	
	$config =  './protected/config/hoauth.php';
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	$hybridauth = new Hybrid_Auth( $config );

	// provider and the searchKeyword are Request parameters
	$provider = 'twitter';
	$searchKeyWord = 'basketball'; 
	
	$html = '';
	//$fbSearchHtml = array();
	echo "<pre>";
	
	if($provider == 'facebook'){
		$fbSearchHtml = getSearchTagsFromFb($hybridauth, $searchKeyWord);
	}
	if($provider == 'twitter'){
		$html = getSearchTagsFromTwitter($hybridauth, $searchKeyWord);
	} 
	
	echo $html;
	//print_r($fbSearchHtml);
?>