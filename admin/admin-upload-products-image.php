<?php
require_once "_check.php";
require_once "../models/dpd.php";
$id   = $_REQUEST["id"];
$get  = $productObj->getProductsInfo($id);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin::<?php $active = "Add Product"; echo $active; ?></title>
    <?php include_once "_meta.php";?>
    <script src="../lib/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function (e) {
        $("#file_upload").on('change',(function(e) {
          var fileInput = document.getElementById('file_upload');
          var files = fileInput.files;
          console.log(files);
        }))
      })
    </script>
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
          <h1 class="page-header">Include images</h1>
          <div class="row placeholders">
              <h1>Upload image for"<?php echo $get["name"];?>" </h1>
              <form>
                <div id="queue"></div>
                <input id="file_upload" name="file_upload" type="file" multiple="true" onchange="submit">
              </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include_once "_script.php";?>
  </body>
</html>
