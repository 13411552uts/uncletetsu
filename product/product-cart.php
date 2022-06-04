<?php
	session_start();
	require_once "../models/dpd.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Uncle Tetsu</title>
		<link href="../css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
		<script src="../js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
		<link href="../css/product-detail.css" rel="stylesheet">
		<script src="../lib/jquery-1.10.1.min.js"></script>
		<script>
			function refresh_cart(url){
				url = url + document.getElementById("quant").value;
				window.location.assign(url);
			}
			function delete_cart(url){
				window.location.assign(url);
			}
		</script>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<?php
			$productObj->showProductCart();
		?>
	</body>
</html>