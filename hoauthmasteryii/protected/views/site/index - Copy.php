<div class="form-group has-error" id="formResult"></div>
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
	 'id'=>'user-form',
	 'enableAjaxValidation'=>false,
	)); ?>
	<?php 
		$name = 'postToProviders'; 
		$value = '';
		echo CHtml::textArea($name, $value, array('id'=>$name, "placeholder"=>"What's on your mind?" , 'rows'=>3, 'cols'=>75));
		echo CHtml::checkBoxList('providersCheckList',$selected_Array=array('twitter', 'facebook'),array('facebook'=>'facebook','twitter'=>'Titter'));
	
	?>
	<div class="row submit">
	        <div id="textCounter" style="font:15px Arial;">140 Characters limit</div>
	        <?php
				$ajaxOptions=array ( );
				$url = 'index.php?r=utility/PostSelectedProviders';
				$label = 'Post';
				$htmlOptions=array ( );
	     		echo CHtml::ajaxSubmitButton($label, 
			        $url, 
			         array(
			              	'data'=>'js:jQuery(this).parents("form").serialize() + ""',
			          		'beforeSend'=>'js:function(){
			          			var errText ="";
			          			if($("#postToProviders").val()==""){			
                       				errText += "Update Status Field Empty<br />";
                       				
                                }
                                if(	!$("#providersCheckList_0").is(":checked") && 
                                	!$("#providersCheckList_1").is(":checked")	 )
                                	errText += "Check at least one Provider <br />";
                                if(errText !="")
                                	$("#formResult").html(errText);
                                	
                             }',       
			              	'success'=>'function(data){
			              		//alert(data);
	              				//if(data!=="Error");
			                    //$("#postToProviders").val("");
		                   	}'
			          ), 
			         array(
			              'id'=>'ajaxSubmitBtn', 
			              'name'=>'ajaxSubmitBtn'
			         )); 
		      $this->endWidget();  
	        ?>
	</div>
</div><!-- form -->    

     
	<script type="text/javascript">
		
		$(document).ready(function() {
		    $('#postToProviders').on('input propertychange', function() {
				CharLimit(this, 140);
		    });
		});
		
		function CharLimit(input, maxChar) {
			//$("#formResult").html('');
		    var len = $(input).val().length;
		    $('#textCounter').text(maxChar - len + ' characters remaining');
		    
		    if (len > maxChar) {
		        $(input).val($(input).val().substring(0, maxChar));
		        $('#textCounter').text('You have ' +0 + ' characters Left');
		    }
		}
	
	</script>

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->widget('ext.hoauth.widgets.HOAuth');

function shuffle_assoc($list) { 
	if (!is_array($list)) return ;
	if(count($list)==0) return; 
	
	$keys = array_keys($list); 
	shuffle($keys); 
	$random = array(); 
	foreach ($keys as $key) { 
		$random[$key] = $list[$key]; 
	}
	return $random; 
}

	/**
	 * 
	 * converts timestamp to human readable format
	 * @param String $dt
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
	

	
	function customFBPosts($hybridauth){
	
		$fbAdapter = $hybridauth->authenticate( 'facebook');
		$fbTimelineFeeds = $fbAdapter->api()->api('/me/posts');
		
		global $universalCount;
		$currentFeed = array();
	//	echo "<pre>" ;print_r($fbTimelineFeeds) ; exit;
		foreach($fbTimelineFeeds['data']  as $feed){
			$universalCount++;
			if(isset($feed['message'])){
					
					$currentFeed[$universalCount] = array(
						'provider'=>'facebook',
						'message' =>array(
							'id'=>	$feed['id'],
							'messagetype' =>'message',
							'message'=>	$feed['message'],
							'actions'=>$feed['actions'],
							'type'=>$feed['type'],
							
						),
					);
				if(isset($feed['comments']))
					$currentFeed[$universalCount]['message']['comments'] = $feed['comments'];
			}
			if(isset($feed['story'])){
				$currentFeed[$universalCount] = array(
					'provider'=>'facebook',
					'message' =>array(
						'id'=>	$feed['id'],
						'messagetype' =>'story',
						'message'=>	$feed['story'],
						'actions'=>$feed['actions'],
						'type'=>$feed['type'],
					),
				);
				if(isset($feed['picture']))
					$currentFeed[$universalCount]['message']['picture'] = $feed['picture'];
				if(isset($feed['comments']))
					$currentFeed[$universalCount]['message']['comments'] = $feed['comments'];
				if(isset($feed['name']))
					$currentFeed[$universalCount]['message']['name'] = $feed['name'];
			}	
		}
		$currentFeed = shuffle_assoc($currentFeed) ;	
		return($currentFeed) ;	
	}
/**
 * 
 * Fetch the users timeline and construct the array
 * @param unknown_type $hybridauth
 */

	function customTwitterPosts($hybridauth){
	
		global $universalCount;
		$twitter= $hybridauth->authenticate( 'twitter');
		/**
		 * All these options work
		 * $user_time_line = $twitter->api()->api('/statuses/home_timeline.json');
		 * $user_time_line = $twitter->api()->api('/statuses/mentions_timeline.json');
		 */
		$user_time_line = $twitter->api()->api('/statuses/user_timeline.json');

		

		foreach ($user_time_line as $key=> $timeLine) {
			$universalCount++; 
			$currentFeed[$universalCount] = array(
			'provider'=>'twitter',
			'message' =>array(
				'messagetype' =>'message',
				'id' =>$timeLine->id_str ,
				'message' =>$timeLine->text ,
				'retweet'=>(isset($timeLine->retweeted_status))?$timeLine->retweeted_status->retweet_count:'' ,//$timeLine->retweet_count,
				'name'=>$timeLine->user->name,
				'favourite'=>$timeLine->favorite_count,
				'createdTime'=>$timeLine->created_at,
				'profileImageUrl'=>$timeLine->user->profile_image_url_https,
				),
			);
			
		}
		$currentFeed = shuffle_assoc($currentFeed) ;
		return $currentFeed;
	}

/**
 * 
 * Displays the post from Facebook page.
 * @param $messagePost
 */
	function formatFbMessage($messagePost){
	
		$html = '
			<div type="button" class="row" data-toggle="modal" data-target="#'.$messagePost['id'].'">
			  '.$messagePost['message'].'
			</div>
				<div class="modal fade" id="'.$messagePost['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
			      </div>
			      <div class="modal-body">
			        '.$messagePost['message'];
	
			    if(isset($messagePost['comments'])){  
				$html .= '<div class="row"> ';
					foreach($messagePost['comments']['data'] as $comment) {
						$html .= ' <div class="col-md-8"> ' . $comment['message'].'</div>' ;
						$html .= '  <div class="col-md-8"> Created : ' . timestamp_to_relative_time(strtotime($comment['created_time'])).' </div>';
						$html .= '  <div class="col-md-8"> Like : ' . $comment['like_count'].' </div>';
					}
				$html .= '</div> ';
			    }
			    if(isset($messagePost['messagetype']) && $messagePost['messagetype'] == 'story'){  
					$html .= '<div class="row"> ';
					$html .= '<div class="col-md-8"> <img style="width:32px;height=32px" src="'.$messagePost['picture'].'" /> </div>' ;
					$html .= ' <div class="col-md-8"> ' . $messagePost['name'].'</div>' ;
					if(isset($messagePost['comments'])) 		
						foreach($messagePost['comments']['data'] as $comment) {
						$html .= ' <div class="col-md-8"> ' . $comment['message'].'</div>' ;
						$html .= '  <div class="col-md-8"> Like : ' . $comment['like_count'].' </div>';
						$html .= '  <div class="col-md-8"> Created : ' . timestamp_to_relative_time(strtotime($comment['created_time'])).' </div>';
						}
					$html .= '</div> ';
			    }
				$html .=
			        '
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary">Save changes</button>
			      </div>
			    </div>
			  </div>
			</div>';
		return $html;
	}

/**
 * Construct the HTML Data 
 * @param unknown_type $fbPost
 * @return $fbHtml
 */
	function htmlizeFbData($fbPost){
		$fbHtml ='';
		foreach ($fbPost as $post){
			if($fbPost['message']['messagetype'] == 'message' || $fbPost['message']['messagetype'] == 'story'){
				if(isset($post['message']))
				$fbHtml .=	formatFbMessage($post);
			}
	
		if($fbPost['message']['messagetype'] == 'story'){
				if(isset($post['message']))
					$fbHtml .=formatFbMessage($post);
			}
		}
		return $fbHtml; 
	}
/**
 * Constructs the HTML body and returns to the HTMLizer Function 
 * 
 */
	function formatTwitterMessage($messagePost){
		$html ='';
		if(isset($messagePost['message'])) {
			$html = '
				<div class="panel panel-default">
				<div class="panel-body">
				<div type="button" class="row" data-toggle="modal" data-target="#'.$messagePost['id'].'">
				  '.$messagePost['message'].'
				</div>
				</div>
				</div>

					<div class="modal fade" id="'.$messagePost['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
				      </div>
				      <div class="modal-body">
				        '.$messagePost['message'];
					$html .= '<div class="row">';
					$html .= '  <div class="col-md-8"> <img style="width:32px;heoght:32px" src="' . $messagePost['profileImageUrl'].'"> </div>';
					$html .= '  <div class="col-md-8"> Tweet Count : ' . $messagePost['retweet'].' </div>';
					$html .= '  <div class="col-md-8"> Favourite: ' . (isset($messagePost['favourite']))?$messagePost['favourite']:''.' </div>';
					$html .= '  <div class="col-md-8"> ' . timestamp_to_relative_time(strtotime($messagePost['createdTime'])).' </div>';
					$html .= '</div> ';
					$html .=
				      '</div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-primary">Save changes</button>
				      </div>
				    </div>
				  </div>
				</div>';
		}
		return $html;
	}	

function htmlizeTwitterData($twitterPost){
	$twitterHtml='';
	foreach($twitterPost as $post){
		$twitterHtml .= formatTwitterMessage($post);
	}
	
	return $twitterHtml;
}

?>
<?php 
	$config =  './protected/config/hoauth.php';
	
	require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
	//echo "<pre>" ;
	$hybridauth = new Hybrid_Auth( $config );
	$universalPosts = array();
	$universalCount;
	// inititalize the arrays 	
	$fbPosts = array();
	$twitterPosts = array();
	
	/*
	 * Working Copy facebook 
	*/
	
	// customize the facebook post to be displayed to the user.
//	$fbPosts = customFBPosts($hybridauth);
	// get the count of post available for display
//	$universalCount = count($fbPosts);

	$twitterPosts= customTwitterPosts($hybridauth);
	$universalCount = count($twitterPosts);
	
	$finalResult = array_merge($fbPosts, $twitterPosts);
	
	$finalResult = shuffle_assoc($finalResult) ; 
	//print_r($finalResult); exit;
	foreach( $finalResult as $post){
		
		/**
		 * formats the Post and displays as plain HTML
		 */
		if($post['provider'] == 'facebook'){
			//htmlizeFbData($post);
		}
		if($post['provider'] == 'twitter'){
			echo htmlizeTwitterData($post);
		}
	}
	
?>

