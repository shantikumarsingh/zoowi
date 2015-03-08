<section class="log_wrapper">
	<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Forgot Password"); ?>


	<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
	<div class="success">
	<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
	</div>
	<?php else: ?>

	<div class="log_form col-lg-5 col-md-5 col-sm-12 col-xs-12">
		<h2 class="text-center">ZOOWIMAMA <small>beta</small></h2>
		<div class="thumbnail">
			<div class="form-header row">
				<div class="col-md-12 col-lg-12">
					<p class="lead">Forgot Your Password&#63;</p>
				</div>
			</div>
			<?php echo CHtml::beginForm(); ?>

				<?php 
					$htmlOptions=array ('class'=>'alert alert-danger');
					echo CHtml::errorSummary($form,'','',$htmlOptions);
				?>

				<div class="form-group">
					<?php 
						$htmlOptions=array ('for'=>'UserRecoveryForm_login_or_email');
						echo CHtml::activeLabelEx($form,'login_or_email',$htmlOptions);
					?>
					<?php 
						$htmlOptions=array ("class"=>"form-control","placeholder"=>"e.g. abcd123 or abcd@gmail.com","required"=>"required");
						echo CHtml::activeTextField($form,'login_or_email',$htmlOptions);
					?>
					<small class="text-muted"><?php echo UserModule::t("Don't worry it happens tothe best of us. Enter your username/email above and we will send you a reset token."); ?></small>
				</div>
				
					<?php 
						$htmlOptions=array ('class'=>'btn btn-primary btn-lg btn-block');
						echo CHtml::submitButton(UserModule::t("Reset my password"),$htmlOptions);
					?>
					
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>
	<?php endif; ?>
</div>