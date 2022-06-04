<?php
	require_once "_check.php";
	require_once "../models/dpd.php";
	$get = $userObj->getUserInfo($_SESSION["session_user_id"]);
	if(isset($_POST["btn_submit"])){
		$name    = $_POST["name"];
		$phone   = $_POST["phone"];
		$address = $_POST["address"];
		$email   = $_POST["email"];
		$c_name  = $_POST["atm_name"];
		$c_number= $_POST["atm_number"];
		$cvv     = $_POST["cvv"];
		$productObj->createOrder($_SESSION["session_user_id"],$name,$email,$address,$phone,$c_name,$c_number,$cvv);
		$rows = $productObj->getLastestOrderID();
		$productObj->addProductsToOrder($rows["id"]);
		unset($_SESSION["cart"]);
		header("Location: ../index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Uncle Tetsu::Checkout</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../css/checkout.css" />
	<script src="../js/checkout.js"></script>
	<script>
		function refresh(){
			document.getElementById("c_name").innerHTML = "Your name: " + document.getElementById("name").value;
			document.getElementById("c_phone").innerHTML = "Your phone number: " + document.getElementById("phone").value;
			document.getElementById("c_email").innerHTML = "Your email: " + document.getElementById("email").value;
			document.getElementById("c_address").innerHTML = "Your address: " + document.getElementById("addressf").value;
		}
	</script>
</head>

<body>
    <div class="image-container set-full-height" style="background-image: url('../img/header.jpg')">
	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!-- Wizard container -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizard">
		                    <form action="checkout.php" method="POST">
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        		Finish your order
		                        	</h3>
									<h5>And we will do the rest for you</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#address" data-toggle="tab">Address</a></li>
			                            <li><a href="#payment" data-toggle="tab">Payment</a></li>
										<li><a href="#confirm" data-toggle="tab">Confirmation</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="address">
										<div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text">Address</h4>
			                            	</div>
		                              	
											<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fas fa-address-card" style="font-size:20px;"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Your Name</label>
			                                          	<input name="name" id="name" type="text" class="form-control" value="<?php echo $get["name"]?>">
			                                        </div>
												</div>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fas fa-map-marker-alt" style="font-size:20px;margin-right:8px"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Your Address</label>
			                                          	<input name="address" id="addressf" type="text" class="form-control" value="<?php echo $get["address"]?>">
			                                        </div>
												</div>
												
		                                	</div>
											<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Your Email</label>
			                                          	<input name="email" id="email" type="text" class="form-control" value="<?php echo $get["email"]?>">
			                                        </div>
												</div>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fas fa-phone" style="font-size:20px;margin-right:3px"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Your Phone number</label>
			                                          	<input name="phone" id="phone" type="text" class="form-control" value="<?php echo $get["phone"]?>">
			                                        </div>
												</div>
											</div>
										</div>
		                            </div>
		                            <div class="tab-pane" id="payment">
										<div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text">Payment</h4>
			                            	</div>
		                              	
											<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fas fa-user" style="font-size:20px;margin-left:3px;padding-right:2px"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Cardholder's name</label>
			                                          	<input name="atm_name" id="atm_name" type="text" class="form-control" value="">
			                                        </div>
												</div>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fas fa-credit-card" style="font-size:20px;"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Card number</label>
			                                          	<input name="atm_number" id="atm_number" type="text" class="form-control" value="">
			                                        </div>
												</div>
												
		                                	</div>
											<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Expired day</label>
			                                          	<div class="form-inline">
															<select class="form-control" style="width:45%">
																<option>MM</option>
																<?php 
																	for($i = 1; $i < 13; $i++){
																		print('<option>'.$i.'</option>');
																	}
																?>
															</select>
															<select class="form-control" style="width:45%">
																<option>YYYY</option>
																<?php
																	for($i = 2022; $i < 2100; $i++){
																		print('<option>'.$i.'</option>');
																	}
																?>
															</select>
														</div>
			                                        </div>
												</div>
												<div class="input-group col-sm-4">
													<span class="input-group-addon">
														<i class="fas fa-lock" style="font-size:20px;margin-right:3px"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">CVV</label>
			                                          	<input name="cvv" id="cvv" type="text" class="form-control" value="">
			                                        </div>
												</div>
											</div>
										</div>
										
									</div>
		                            <div class="tab-pane" id="confirm">
		                                <div class="row">
		                                    <h4 class="info-text">Your information</h4>
											<div class="col-sm-6">
												<h5 id="c_name"></h5>
												<h5 id="c_email"></h5>
												<h5 id="c_phone"></h5>
												<h5 id="c_address"></h5>
											</div>
		                                </div>
		                            </div>
		                        </div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='button' onclick="refresh()" class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
	                                    <input type='submit' class='btn btn-finish btn-fill btn-danger btn-wd' name='btn_submit' value='Finish' />
	                                </div>
	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
	                                </div>
	                                <div class="clearfix"></div>
	                        	</div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div> <!-- row -->
		</div> <!--  big container -->

	    <div class="footer">
	    </div>
	</div>
</body>

</html>
