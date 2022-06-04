<?php
	session_start();
	require_once "../models/dpd.php";
	$id		= $_REQUEST["id"];
	$get	= $productObj->getProductsInfo($id);
	
	if(isset($_POST["btn_submit"])){
		$quant = $_POST["quant"];
		if(isset($_SESSION["cart"][$id])){
			$_SESSION["cart"][$id]["quant"]+=$quant;
		} 
		else{
			$_SESSION["cart"][$id]=array(
				"quant" => $quant,
				"price" => $get["price"],
				"name"  => $get["name"],
				"image" => $productObj->getFirstPhotoProduct($get["id"]),
				"id"    => $id,
			);
		}
	}
	
?>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
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
	   $(document).ready(function(){
            //-- Click on detail
            $("ul.menu-items > li").on("click",function(){
                $("ul.menu-items > li").removeClass("active");
                $(this).addClass("active");
            })

            $(".attr,.attr2").on("click",function(){
                var clase = $(this).attr("class");

                $("." + clase).removeClass("active");
                $(this).addClass("active");
            })

            //-- Click on QUANTITY
            $(".btn-minus").on("click",function(){
                var now = $(".section > div > input").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1 > 0){ now--;}
                    $(".section > div > input").val(now);
                }else{
                    $(".section > div > input").val("1");
                }
            })            
            $(".btn-plus").on("click",function(){
                var now = $(".section > div > input").val();
                if ($.isNumeric(now)){
                    $(".section > div > input").val(parseInt(now)+1);
                }else{
                    $(".section > div > input").val("1");
                }
            })                        
        }) 
	</script>
	<!-- Custom styles for this template -->
  </head>

  <body>
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="container">
						<a href="product-cart.php"><p class="icon-shopping-cart topright"></p></a>
					</div>
					<div class="preview col-md-6">
						<?php
							$productObj->showProductImageForPic($id);
							$productObj->showProductImageForThumbnail($id);
						?>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php echo $get["name"]?></h3>
						<p class="product-description"><?php echo $get["description"]?></p>
						<h4 class="price">current price: <span>$<?php echo $get["price"]?></span></h4>
						<form action="<?php echo "product-detail.php?id=$id"?>" method="POST">
							<div class="section" style="padding-bottom:20px;margin-bottom:10px">
								<h6 class="title-attr"><small>Quantity</small></h6>                    
								<div>
									<div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
									<input value="1" name="quant"/>
									<div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
								</div>
							</div>  
							<div class="action">
								<!--<input class="btn btn-large btn-primary" type="submit" name="btn_submit" value="Submit">-->
								<input type="submit" name="btn_submit" class="add-to-cart btn btn-default" type="submit" value="add to cart">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
