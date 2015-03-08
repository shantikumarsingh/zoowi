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
		<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
		<![endif]-->

		<!--<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/main.css">
		<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/form.css">-->

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body>
		<div class="wrapper jsc-sidebar-content jsc-sidebar-pulled">
			<nav>
				<a href="#" class="fa fa-bars link-menu jsc-sidebar-trigger"></a>
			</nav>
		

			<div class="container-fluid" id="page">


				<div id="header">
					<div id="logo"> <?php echo CHtml::encode(Yii::app()->name); ?></div>
				</div>

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
							),
						)); 
					?>
				</div>

				<?php if(isset($this->breadcrumbs)):?>
					<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
					)); ?>
				<?php endif?>

				<?php echo $content; ?>
			
				

			</div>
		</div>
		<nav class="sidebar jsc-sidebar" id="jsi-nav" data-sidebar-options="">
			<ul class="sidebar-list">
				<li><a href="./" class="current">SidebarJS</a></li>
				<li><a href="http://github.com/makotot/sidebar/">View on Github</a></li>
				<li><a href="http://github.com/makotot/sidebar/releases">Download</a></li>
			</ul>
		</nav>
		<footer id="footer">
			<nav class="navbar navbar-default navbar-fixed-bottom">
				<div class="container-fluid">
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="javascript:void(0);">Terms of Use</a></li>
							<li><a href="javascript:void(0);">Privacy Policy</a></li>
						</ul>
						<p class="navbar-text pull-right">Copyright &copy; <?php echo date('Y'); ?> ZOOWIMAMA. All Rights Reserved.</p>
					</div>
				</div>
			</nav>
		</footer>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sidebar.js"></script>
		<script>
			$('#jsi-nav').sidebar({
				trigger: '.jsc-sidebar-trigger',
				scrollbarDisplay: true,
				pullCb: function () { console.log('pull'); },
				pushCb: function () { console.log('push'); }
			});

			$('#api-push').on('click', function (e) {
				e.preventDefault();
				$('#jsi-nav').data('sidebar').push();
			});
			$('#api-pull').on('click', function (e) {
				e.preventDefault();
				$('#jsi-nav').data('sidebar').pull();
			});
		</script>
	</body>
</html>
