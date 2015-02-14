<?php 
require_once(__DIR__.'/ClassMap.php');
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
			<div class="col-md-8 col-lg-8 col-md-offset-2">
				<div class="reg_form">
					<h2 class="text-center">ZOOWIMAMA <small>beta</small></h2>
					<div class="thumbnail">
						<div class="form-header row">
							<div class="col-md-9 col-lg-9">
								<p class="lead">Create New Account </p>
							</div>
							<div class="col-md-3 col-lg-3">
								<a class="btn btn-link pull-right" href="./" role="button">Sign In</a>
							</div>
						</div>
						<form class="form-horizontal" action="./RegistrationHandler.php" method="post">
							<div class="form-group">
								<label for="inputFirstName" class="col-sm-3 control-label">First Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="e.g. Rahul" required>
								</div>
							</div>
							<div class="form-group">
								<label for="inputLastName" class="col-sm-3 control-label">Last Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="e.g. Ankarboina" required>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="e.g. abcd@gmail.com" required>
								</div>
							</div>
							<div class="form-group">
								<label for="InputPassword" class="col-sm-3 control-label">Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="InputPassword" name="InputPassword" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" required>
								</div>
							</div>
							<div class="form-group">
								<label for="InputConfirmPassword" class="col-sm-3 control-label">Confirm Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="InputConfirmPassword" name="InputConfirmPassword"  placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" required>
								</div>
							</div>
							<div class="form-group">
								<label for="inputSelectCountry" class="col-sm-3 control-label">Country <p><small class="text-muted">(optional)</small></p></label>
								<div class="col-sm-9">
								<?php 
									$countryList  = new Countries;
									echo $countryList->getCountriesList();
								?>
								</div>
							</div>
							<div class="form-group">
								<label for="InputPhoneNumber" class="col-sm-3 control-label">Phone Number <p><small class="text-muted">(optional)</small></p></label>
								<div class="col-sm-9">
									<input type="number" class="form-control" id="InputPhoneNumber" name="InputPhoneNumber"  placeholder="" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<button type="submit" class="btn btn-primary">Create Account</button>
									<!-- <button type="submit" class="btn btn-link">Cancel</button> -->
									<a class="btn btn-link" href="./" role="button">Cancel</a>
								</div>
							</div>
						</form>
					</div>
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
