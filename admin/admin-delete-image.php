<?php
	require_once "../models/dpd.php";
	$id  = $_REQUEST["id"];
	$name= $_REQUEST["tmp"];
	$result	= $productObj->removeProductImageWithName($id,$name);
	if($result){
		header("Location:admin-update-products-image.php?id=$id");
	}
	else{
		echo "failed";
	}
?>