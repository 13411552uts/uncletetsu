<?php
	require_once "../models/dpd.php";
	$id = $_REQUEST["id"];
	$productObj->removeProductImage($id);
	$result	= $productObj->deleteProduct($id);
	if($result){
		$result = $productObj->deleteProductWithoutImage($id);
		header("Location:admin-products.php");
	}
	else{
		echo "failed";
	}
?>