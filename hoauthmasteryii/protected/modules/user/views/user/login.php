<section class="log_wrapper">
		<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login"); ?>

		

		<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

		<div class="success">
			<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
		</div>

		<?php endif; ?>
		<div class="log_form col-lg-5 col-md-5 col-sm-12 col-xs-12">
			<h2 class="text-center">ZOOWIMAMA <small>beta</small></h2>
			<div class="thumbnail">
				<?php echo CHtml::beginForm(); ?>
					
					<?php 
						$htmlOptions=array ('class'=>'alert alert-danger');
						echo CHtml::errorSummary($model,'','',$htmlOptions);
					?>
					<div class="form-group">
						<?php 
							$htmlOptions=array ('for'=>'UserLogin_username');
							echo CHtml::activeLabelEx($model,'username',$htmlOptions);
						?>
						<?php 
							$htmlOptions=array ("class"=>"form-control","placeholder"=>"e.g. abcd@gmail.com","required"=>"required");
							echo CHtml::activeTextField($model,'username',$htmlOptions)
						?>
					</div>
					<div class="form-group">
						<?php 
							$htmlOptions=array ('for'=>'UserLogin_password');
							echo CHtml::activeLabelEx($model,'password',$htmlOptions);
						?>
						<?php 
							$htmlOptions=array ("class"=>"form-control","placeholder"=>"......","required"=>"required");
							echo CHtml::activePasswordField($model,'password',$htmlOptions);
						?>
					</div>
					<div class="checkbox">
						<label>
							<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
							<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
						</label>
						<?php 
							$htmlOptions=array ('class'=>'pull-right');
							echo CHtml::link(UserModule::t("Forgot Password&#63;"),Yii::app()->getModule('user')->recoveryUrl,$htmlOptions);
						?>
					</div>
					
					<?php 
						$htmlOptions=array ('class'=>'btn btn-primary btn-lg btn-block');
						echo CHtml::submitButton(UserModule::t("Sign In"),$htmlOptions);
					?>
					<p class="register-text">New to ZOOWIMAMA&#63; <?php echo CHtml::link(UserModule::t("Sign Up Now"),Yii::app()->getModule('user')->registrationUrl); ?></p>

				<?php echo CHtml::endForm(); ?>
			</div>
		</div>


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
</section>