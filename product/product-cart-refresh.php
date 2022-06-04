<?php
	session_start();
	$id   = $_GET["id"];
	$quant= $_GET["value"];
	if($quant > 0){
		$_SESSION["cart"][$id]["quant"] = $quant;
	}
	else{
		unset($_SESSION["cart"][$id]);
	}
	header("Location: product-cart.php");
?>