		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><i class="fa fa-bars"></i> ZOOWIMAMA</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right" id="profile_drop">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									<span class="header-profile">
										<img src="./../../assets/images/profile.jpg" class="img-circle" alt="<?php echo $_SESSION['zoowiuser']; ?>" /> 
									</span>
									<span class="header-profile-title">
										<?php echo $_SESSION['zoowiuser']; ?>
									</span>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
									<!--<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>-->
									<li class="divider"></li>
									<li><a href="../../LoginHandler.php?action=logout"><i class="fa fa-sign-out"></i> Logout</a></li>
								</ul>
							</li>
						</ul>
						<form class="form-inline navbar-form navbar-right">
						  <div class="form-group">
							<div class="input-group">
							  <input type="text" class="form-control" id="search" placeholder="Search">
							  <div class="input-group-addon">
								<i class="fa fa-search"></i>
							  </div>
							</div>
						  </div>
						</form>
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="#"><i class="fa fa-tasks"></i> Feeds </a></li>
							<li><a href="#"><i class="fa fa-bell-o"></i> Notifications</a></li>
							<li><a href="#"><i class="fa fa-users"></i> List</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
