<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Zoowimama</title>
		
		<link rel="stylesheet" href="./../../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="./../../assets/thirdparty/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="./../../assets/css/custom.css">
	</head>
	<body>
		<?php include('./header/header.php'); ?>

		<!-- body -->
		<?php include('./body/body.php'); ?>

		<!-- footer -->
		<?php include('./footer/footer.php'); ?>

		<script src="./../../assets/js/jquery.min.js"></script>
		<script src="./../../assets/js/bootstrap.min.js"></script>
		<script src="./../../assets/thirdparty/grids/grid.js"></script>
		<script>
			$(document).ready(function() {
				$('#demo').pinterest_grid({
					no_columns: 3,
					padding_x: 10,
					padding_y: 10,
					margin_bottom: 50,
					single_column_breakpoint: 700
				});
			});
		</script>		
	</body>
</html>

