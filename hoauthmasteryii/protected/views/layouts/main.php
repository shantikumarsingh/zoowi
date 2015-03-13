<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- blueprint CSS framework -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
		<![endif]-->

		<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">-->
		

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"> <?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php
					$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			array('label'=>'Social Apps', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Facebook', 'url'=>array('/fb/index'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Twitter', 'url'=>array('/twitter/index'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Instagram', 'url'=>array('/instagram/index'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Foursquare', 'url'=>array('/foursquare/index'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Tumblr', 'url'=>array('/tumblr/index'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Linkedin', 'url'=>array('/linkedin/index'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Profile', 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),

			
			//array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
			//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
			//array('label'=>'Contact', 'url'=>array('/site/contact')),
			//array('label'=>'Register', 'url'=>array('/user/registration'), 'visible'=>Yii::app()->user->isGuest),
			// Using Submenu in yii 
			/*
			array('label'=>'SubMenu', 'url'=>array('/site/page', 'view'=>'about'), 
				'items' =>array(
					array('label'=>'Level 4 One', 'url'=>array('product/new')),
                    array('label'=>'Level 4 Two', 'url'=>array('product/index')),
				),
				),
				*/
			),
			)); 
		?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

		<!--

		Adding Javascript -- place them as required
		-->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
		<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>-->



</body>
</html>
