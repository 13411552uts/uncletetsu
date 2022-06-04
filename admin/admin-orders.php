<?php
require_once "_check.php";
require_once "../models/dpd.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin::<?php $active = "Manage Products"; echo $active; ?></title>
    <?php include_once "_meta.php";?>
    <script type="text/javascript" src="../lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="../editor/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="../editor/ckeditor/adapters/jquery.js"></script>
    <script type="text/javascript" src="../editor/ckeditor/config.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <?php include_once "_header.php";?>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include_once "_left.php";?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Order Manager Page</h1>
          <?php 
            if(isset($msg)) echo $msg;
          ?>
          <div class="row placeholders">
          </div>
            <?php
              $productObj->displayOrders();
            ?>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include_once "_script.php";?>
  </body>
</html>
