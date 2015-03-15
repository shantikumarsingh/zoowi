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
	<div class=" wrapper jsc-sidebar-content jsc-sidebar-pulled">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="./"><?php echo CHtml::encode(Yii::app()->name); ?></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<?php 
								$htmlOptions=array ("class"=>"dropdown-toggle","data-toggle"=>"dropdown","role"=>"button", "aria-expanded"=>"false");
								echo CHtml::link(Yii::app()->user->name." <span class='caret'></span>", $url='#', $htmlOptions);
							?>
							<ul class="dropdown-menu" role="menu">
								<li><a href="index.php?r=user/profile"><i class="fa fa-user"></i> Profile</a></li>
								<li><a href="index.php?r=settings/index"><i class="fa fa-gear"></i> Settings</a></li>
								<li class="divider"></li>
								<li><a href="index.php?r=site/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
							</ul>
						</li>
					</ul>
					<form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn"><i class="fa fa-search"></i></button>
					</form>
					<ul class="nav navbar-nav  navbar-right">
						<li class="active"><a href="index.php?r=site/index"><i class="fa fa-list-ul"></i> Feeds <span class="sr-only">(current)</span></a></li>
						<li><a href="#"><i class="fa fa-bell-o"></i> Notifications <sup class="badge badge-danger">5</sup></a></li>
						<li><a href="#"><i class="fa fa-users"></i> List </a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container-fluid" id="page">
			<a href="#" class="fa fa-bars link-menu jsc-sidebar-trigger"></a>

			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>

			<?php echo $content; ?>

		</div>
		<footer id="footer">
			<nav class="navbar navbar-default">
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
	</div>


	<div class="sidebar jsc-sidebar" id="jsi-nav" data-sidebar-options="">
		<ul class="sidebar-list list-unstyled">
			<li><a href="./" class="current"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="index.php?r=fb/index"><i class="fa fa-facebook-square"></i> Facebook</a></li>
			<li><a href="index.php?r=twitter/index"><i class="fa fa-twitter-square"></i> Twitter</a></li>
			<li><a href="index.php?r=instagram/index"><i class="fa fa-instagram"></i> Instagram</a></li>
			<li><a href="index.php?r=foursquare/index"><i class="fa fa-foursquare"></i> Foursquare</a></li>
			<li><a href="index.php?r=tumblr/index"><i class="fa fa-tumblr-square"></i> Tumblr</a></li>
			<li><a href="index.php?r=linkedin/index"><i class="fa fa-linkedin-square"></i> Linkedin</a></li>
			<li><a href="javascript:void(0);"><i class="fa fa-plus"></i> Add Account...</a></li>
		</ul>
	</div>
		<!--

		Adding Javascript - place them as required
		-->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/grid.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sidebar.js"></script>
		<!--<script src="<?php //echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>-->
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
			$('#pinBoot').pinterest_grid({
				no_columns: 3,
				padding_x: 10,
				padding_y: 10,
				margin_bottom: 50,
				single_column_breakpoint: 700
			});

			$('body').append('<button id="toTop" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Back to top"><i class="fa fa-chevron-up"></i></button>');
		    	$(window).scroll(function () {
					if ($(this).scrollTop() != 0) {
						$('#toTop').fadeIn();
					} else {
						$('#toTop').fadeOut();
					}
				}); 
		    $('#toTop').click(function(){
		        $("html, body").animate({ scrollTop: 0 }, 600);
		        return false;
		    });

		    $('[data-toggle="tooltip"]').tooltip();
		</script>



</body>
</html>
