<?php
/**
 * Update the current status of the user
 */
?>

	<style>
		textarea { width: 300px; height: 80px; padding: 10px; border: 1px solid blue;}
	</style>
<?php 

			$config =  './protected/config/hoauth.php';
			require_once( "./protected/extensions/hoauth/hybridauth/Hybrid/Auth.php" );
			$hybridauth = new Hybrid_Auth( $config );

			$fbAdapter = $hybridauth->authenticate( "facebook" );
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user-form',
 'enableAjaxValidation'=>false,
)); ?>	
<?php 
	
	$name = 'postToProviders'; 
	$value = '';
	echo CHtml::textArea($name, $value, array('id'=>'postToProviders', 'rows'=>15, 'cols'=>75));

?>
	<div class="row submit">
	        <div id="textCounter" style="font:15px Arial;">140 Characters limit</div>
	        <?php
				$ajaxOptions=array ( );
				$url = 'index.php?r=fb/updateStatusToProvider';
				$label = 'Post';
				$htmlOptions=array ( );
	     		echo CHtml::ajaxSubmitButton($label, 
			        $url, 
			         array(
			              'data'=>'js:jQuery(this).parents("form").serialize()+
			                             "&request=added"',       
			              'success'=>'function(data){
			                          $("#postToProviders").val("");
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
	    var len = $(input).val().length;
	    $('#textCounter').text(maxChar - len + ' characters remaining');
	    
	    if (len > maxChar) {
	        $(input).val($(input).val().substring(0, maxChar));
	        $('#textCounter').text('You have ' +0 + ' characters Left');
	    }
	}

</script>
