<?php 
	session_start();
	if(!isset($_SESSION['zoowiuser']) && !isset ($_SESSION['zoowiemail'])){
		//header("Location: /zoowiproject/protected/application/");
		//exit(0);   
	}

?>

<html>
	<head>
		<title>
		</title>
	</head>
	<body>
		<div><?php include('./header/header.php'); ?> </div>
		<div>Welcome! <?php echo $_SESSION['zoowiuser']; ?> </div>
		<div><a href="../../LoginHandler.php?action=logout">Logout! </a> </div>
		<?php 	echo " Authorised Dynamic body Contents here " ; ?>
		<div><?php include('./footer/footer.php'); ?> </div>
	</body>
</html>

