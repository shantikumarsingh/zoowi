<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="en">

		<!-- blueprint CSS framework -->

		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css">
		<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print"> -->
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
		<![endif]-->

		<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"> -->

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body class="log_wrapper">
		<section class="container" id="page">
			<?php echo $content; ?>
			
		</section>
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
		<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>-->
	</body>
</html>
