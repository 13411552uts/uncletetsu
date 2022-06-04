<link href="../css/bootstrap.min.css" rel="stylesheet" />
<script src="../js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="../css/navbar-checkout.css" rel="stylesheet">
<style>
	a:hover{
		text-decoration:none;
	}
	a:focus{
		text-decoration:none;
	}
</style>
<div class="container">
    <br />
    <div class="row">        
        <div class="col-xs-12 col-sm-8 col-lg-9">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <a href="#Address">
					<div class="step <?php if($active == "Address"){echo "active";} ?>">
                        <span class="glyphicon glyphicon-home"></span> 
                        Address
                        <div class="hidden-xs caret right"></div>
                        <div class="visible-xs caret bottom"></div>
                    </div>   
					</a>
                </div>
        
                <div class="col-xs-12 col-sm-4">
					<a href="#Payment">
                    <div class="step <?php if($active == "Payment"){echo "active";} ?>">
                            <span class="glyphicon glyphicon-usd"></span> 
                            Payment
                            <div class="hidden-xs caret right"></div>
                        <div class="visible-xs caret bottom"></div>
                    </div>
					</a>
                </div>
            
                <div class="col-xs-12 col-sm-4">
					<a href="#Confirm">
                    <div class="step <?php if($active == "Confirm"){echo "active";} ?>">
                        <span class="glyphicon glyphicon-ok"></span> 
                        Confirmation            
                    </div>
					</a>
                </div>
            </div>            
        </div>

        <hr class="col-xs-12" />    
    </div>
</div>