<div class="col-md-8 col-lg-8 col-md-offset-2">
	<div class="reg_form">
	<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration"); ?>
		<h2 class="text-center">ZOOWIMAMA <small>beta</small></h2>
		<div class="thumbnail">
			<div class="form-header row">
				<div class="col-md-9 col-lg-9">
					<p class="lead"><?php echo UserModule::t("Create New Account"); ?></p>
				</div>
				<div class="col-md-3 col-lg-3">
					<a class="btn btn-link pull-right" href="./index.php?r=user/login" role="button">Sign In</a>
				</div>
			</div>

			<?php if(Yii::app()->user->hasFlash('registration')): ?>
				<div class="success">
					<?php echo Yii::app()->user->getFlash('registration'); ?>
				</div>
			<?php else: ?>

			<?php 
				$form=$this->beginWidget('UActiveForm', array(
					'id'=>'registration-form',
					'enableAjaxValidation'=>true,
					'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
					'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'form-horizontal'),
				));
			?>
			<?php //echo $form->errorSummary(array($model,$profile)); ?>

			<?php 
				$htmlOptions=array ('class'=>'alert alert-danger');
				echo $form->errorSummary(array($model,$profile),'','', $htmlOptions);
			?>

			<div class="form-group required">
				<?php 
					$htmlOptions=array ('for'=>'RegistrationForm_username', 'class'=>'col-sm-3 control-label');
					echo $form->labelEx($model,'username', $htmlOptions);
				?>
				<div class="col-sm-9">
					<?php 
						$htmlOptions=array ('class'=>'form-control', 'placeholder'=>'e.g. Rahul','required'=>'required');
						echo $form->textField($model,'username', $htmlOptions);
					?>
				</div>
				<?php echo $form->error($model,'username'); ?>
			</div>
			<div class="form-group required">
				<?php 
					$htmlOptions=array ('for'=>'RegistrationForm_password', 'class'=>'col-sm-3 control-label');
					echo $form->labelEx($model,'password',$htmlOptions);
				?>
				<div class="col-sm-9">
					<?php 
						$htmlOptions=array ('class'=>'form-control', 'placeholder'=>'......','required'=>'required');
						echo $form->passwordField($model,'password',$htmlOptions);
					?>
					<small class="help-block"><?php echo UserModule::t("Minimal password length 4 symbols."); ?></small>
				</div>
				<?php //echo $form->error($model,'password'); ?>
			</div>

			<div class="form-group required">
				<?php 
					$htmlOptions=array ('for'=>'RegistrationForm_verifyPassword', 'class'=>'col-sm-3 control-label');
					echo $form->labelEx($model,'verifyPassword',$htmlOptions);
				?>
				<div class="col-sm-9">
					<?php 
						$htmlOptions=array ('class'=>'form-control', 'placeholder'=>'......','required'=>'required');
						echo $form->passwordField($model,'verifyPassword',$htmlOptions);
					?>
				</div>
				<?php //echo $form->error($model,'verifyPassword'); ?>
			</div>

			<div class="form-group required">
				<?php 
					$htmlOptions=array ('for'=>'RegistrationForm_email', 'class'=>'col-sm-3 control-label');
					echo $form->labelEx($model,'email',$htmlOptions);
				?>
				<div class="col-sm-9">
					<?php
						$htmlOptions=array ('class'=>'form-control', 'placeholder'=>'abcd@gmail.com','required'=>'required');
						echo $form->textField($model,'email',$htmlOptions);
					?>
				</div>
				<?php //echo $form->error($model,'email'); ?>
			</div>

			<?php 
				$profileFields=Profile::getFields();
				if ($profileFields) {
					foreach($profileFields as $field) {
					?>
						<div class="row">
							<?php echo $form->labelEx($profile,$field->varname); ?>
							<?php 
							if ($widgetEdit = $field->widgetEdit($profile)) {
								echo $widgetEdit;
							} elseif ($field->range) {
								echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
							} elseif ($field->field_type=="TEXT") {
								echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
							} else {
								echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
							}
							 ?>
							<?php echo $form->error($profile,$field->varname); ?>
						</div>	
					<?php
					}
				}
			?>
		
			<?php if (UserModule::doCaptcha('registration')): ?>
				<div class="form-group required">
					<?php
						$htmlOptions=array ('for'=>'RegistrationForm_verifyCode', 'class'=>'col-sm-3 control-label');
						echo $form->labelEx($model,'verifyCode',$htmlOptions);
					?>
					<div class="col-sm-9">
						<div class="img-thumbnail center-block">
							<?php $this->widget('CCaptcha'); ?>
						</div>
						<?php
							$htmlOptions=array ('class'=>'form-control', 'placeholder'=>'Please enter above verification code','required'=>'required');
							echo $form->textField($model,'verifyCode',$htmlOptions);
						?>
						<small class="help-block">
							<?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
							<?php echo UserModule::t("Letters are not case-sensitive."); ?>
						</small>
					</div>
					<?php //echo $form->error($model,'verifyCode'); ?>
					
				</div>
			<?php endif; ?>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<?php 
						$htmlOptions=array ('class'=>'btn btn-primary');
						echo CHtml::submitButton(UserModule::t("Create Account"),$htmlOptions);
					?>
					<a href="./index.php?r=user/login" class="btn btn-link" role="button">Cancel</a>
				</div>
			</div>

			<?php $this->endWidget(); ?>
		<?php endif; ?>
		</div>
	</div>
</div>