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
						<form method="post" action="LoginHandler.php">
							<?php if(isset($_SESSION['zoowiuser'])) { ?>
							<div class="alert alert-danger"> Authentication Failed !</div>
							<?php }?>
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input type="email" name="username" class="form-control" id="exampleInputEmail1" placeholder="e.g. abcd@gmail.com" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" required>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"> Remember me
								</label>
								<a href="javascript:void(0);" class="pull-right">Forgot Password&#63;</a>
							</div>
							<button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
							<p class="register-text">New to ZOOWIMAMA&#63; <a href="./registration.php">Sign Up Now</a></p>
						</form>
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
