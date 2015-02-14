<?php 
	session_start();
	
	//if(isset($_SESSION['zoowiuser']) && isset ($_SESSION['zoowiemail'])){
		//header("Location: /zoowiproject/protected/application/");
		//exit(0);   
	//}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Zoowimama</title>
		
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/thirdparty/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/custom.css">
	</head>
	<body class="log_wrapper">
		<div class="container">
				<div class="log_form">
					<h2 class="text-center">ZOOWIMAMA <small>beta</small></h2>
					<div class="thumbnail">
						Successfully Registered,  This page will redirect in 5 seconds
						<?php header( "refresh:5;url=./" ); ?>
					</div>
				</div>
		</div>
		<footer>
			<nav class="navbar navbar-default navbar-fixed-bottom">
				<div class="container-fluid">
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="javascript:void(0);">Terms of Use</a></li>
							<li><a href="javascript:void(0);">Privacy Policy</a></li>
						</ul>
						<p class="navbar-text navbar-right">Copyright &copy; ZOOWIMAMA. All Rights Reserved.</p>
					</div>
				</div>
			</nav>
		</footer>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>