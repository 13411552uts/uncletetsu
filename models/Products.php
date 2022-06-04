<?php
require_once "setting.php";
class Products extends Dbh
{
    /**
     * Insert a product to database
     * @param {string} $name - Name of products to insert
     * @param {string} $desc - Description of products to insert
     * @param {string} $price - Price of products to insert
     * @return $result - result of query
     */
    public function insertProducts($name, $desc, $price)
    {
        $query = "INSERT INTO tbl_products(name,description,price) VALUES ('$name','$desc','$price')";
        $result = $this->conn->query($query) or die("Error insertProducts: " . $this->conn->error);
        return $result;
    }

    /**
     * Remove a product image from database using product id
     * @param {string} $id - Product id
     */
    public function removeProductImage($id)
    {
        $query = "SELECT * FROM tbl_products_image WHERE product_id='$id'";
        $result = $this->conn->query($query) or die("Error removeProductImage: " . $this->conn->error);
        $nums = mysqli_num_rows($result);
        while ($rows = mysqli_fetch_array($result))
        {
            // Delete files from machine
            unlink($rows["photos"]);
        }
    }   

    /**
     * Update a product with provided data
     * @param {string} $id - Product id
     * @param {string} $name - Product name
     * @param {string} $desc - Product description
     * @param {string} $price - Product price
     * @return $result - Result of query
     */
    public function updateProducts($id, $name, $desc, $price)
    {
        $query = "UPDATE tbl_products SET name='$name', description='$desc', price='$price' WHERE id='$id'";
        $result = $this->conn->query($query) or die("Error updateProducts: " . $this->conn->error);
        return $result;
    }
	
    /**
     * Remove a product image using product id and image name
     * @param {string} $id - Product Id
     * @param {string} $name - image name
     * @return $result - Result of query
     */
    public function removeProductImageWithName($id, $name)
    {
        $query = "SELECT * FROM tbl_products_image WHERE product_id='$id' AND tmp_name='$name'";
        $result = $this->conn->query($query) or die("Error removeProductImageWithName: " . $this->conn->error);
        while ($rows = mysqli_fetch_array($result))
        {
            unlink($rows["photos"]);
        }
        $query = "DELETE FROM tbl_products_image WHERE product_id='$id' AND tmp_name='$name'";
        $result = $this->conn->query($query) or die("Error removeProductImageWithName: " . $this->conn->error);
        return $result;
    }

    /**
     * Remove a product from database using id
     * @param {string} $id - Product Id
     * @return $result - Result of query
     */
    public function deleteProduct($id)
    {
        $query = "DELETE FROM tbl_products, tbl_products_image
			        USING tbl_products INNER JOIN tbl_products_image
					WHERE tbl_products.id = tbl_products_image.product_id AND tbl_products.id = '$id'";

        //delete rows from 2 tables
        $result = $this->conn->query($query) or die("Error deleteProduct: " . $this->conn->error);
        return $result;
    }

	/**
     * Remove a product from database using id
     * @param {string} $id - Product Id
     * @return $result - Result of query
     */
    public function deleteProductWithoutImage($id)
    {
        $query = "DELETE FROM tbl_products WHERE id = $id";
        $result = $this->conn->query($query) or die("Error deleteProductWithoutImage: " . $this->conn->error);
        return $result;
    }

    /**
     * Search product using name
     * @param {string} $name - product name
     */
    public function searchProducts($name)
    {
        $name = $this->conn->real_escape_string(trim($name));

        if ($name = "")
        {
            $name_cond = "true";
        }
        else
        {
            $name_cond = "name LIKE '%$name%'";
        }
        
        $query = "SELECT * FROM tbl_products WHERE $name_cond";
        $result = $this->conn->query($query) or die("Error searchProducts: " . $this->conn->error);
        print ('<table class="table table-striped"><tbody>');
        print ('<tr>
						<th scope="col">Id</th>
						<th scope="col">Name</th>
						<th scope="col">Action</th>
					</tr>
			');
        while ($rows = mysqli_fetch_array($result))
        {
            print ('
                <tr>
                  <td>' . $rows["id"] . '</td>
                  <td>' . $rows["name"] . '</td>
                  <td>
                  	<a href="admin-update-products.php?id=' . $rows["id"] . '" title="Edit"><i class="icon-edit"></i></a>
                  	<a href="admin-delete-products.php?id=' . $rows["id"] . '" title="Delete"><i class="icon-delete"></i></a>
                  </td>
                </tr>
			');
        }
        print ('</tbody></table>');
    }

    /**
     * Insert a product image to database
     * @param {string} $id - product id
     * @param {string} $photos - link to photos
     * @param {string} $tmp_name - name of image
     * @return $result - Result of query
     */
    public function insertProductsImg($id, $photos, $tmp_name)
    {
        $query = "INSERT INTO tbl_products_image(product_id,photos,tmp_name) VALUES('$id','$photos','$tmp_name')";
        $result = $this->conn->query($query) or die("Error insertProductsImg: " . $this->conn->error);
        return $result;
    } 
	
    /**
     * Insert a product image to database
     * @return $row - latest product info
     */
    public function getLastestProductID()
    {
        $query = "SELECT * FROM tbl_products ORDER BY id DESC LIMIT 0,1";
        $result = $this->conn->query($query) or die("Error getLastestProductID: " . $this->conn->error);
        $row = mysqli_fetch_array($result);
        return $row;
    }

    /**
     * Get a product info using id
     * @param {string} $id - product id
     * @return $row - product info
     */
    public function getProductsInfo($id)
    {
        $query = "SELECT * FROM tbl_products WHERE id='$id'";
        $result = $this->conn->query($query) or die("Error getProductsInfo: " . $this->conn->error);
        $rows = mysqli_fetch_array($result);
        return $rows;
    } 

	//print Gallery of Products
    public function printImageGalleryProductsForUpdate($id)
    {
        $query = "SELECT * FROM tbl_products_image WHERE product_id='$id'";
        $result = $this->conn->query($query) or die("Error printImageGalleryProducts: " . $this->conn->error);
        $get = $this->getProductsInfo($id);
        $product_name = $get["name"];
        print ('
				<div class="container">
				<!-- The container for the list of example images -->
					<div id="links">
			');
        while ($rows = mysqli_fetch_array($result))
        {
            $url = 'admin-delete-image.php?id=' . $rows["product_id"] . '&tmp=' . $rows["tmp_name"];
            $url = "'$url'";
            print ('
					<div class="row col-lg-4">
					<button class="icon-del topright" onclick="deleteImage(' . $url . ')"></button>
					<a href="' . $rows["photos"] . '" title="' . $product_name . '" data-gallery>
					  <img src="' . $rows["photos"] . '" alt="' . $product_name . '" style="width:300px; height:200px">
					</a>
					</div>
				');
        }
        print ('
				</div><br></div>
				<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
				<div id="blueimp-gallery" class="blueimp-gallery">
					<!-- The container for the modal slides -->
					<div class="slides"></div>
					<!-- Controls for the borderless lightbox -->
					<h3 class="title"></h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a>
					<a class="play-pause"></a><ol class="indicator"></ol>
					<!-- The modal dialog, which will be used to wrap the lightbox content -->
					<div class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" aria-hidden="true">&times;</button>
									<h4 class="modal-title"></h4>
								</div>
								<div class="modal-body next"></div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left prev">
										<i class="glyphicon glyphicon-chevron-left"></i>
										Previous
									</button>
									<button type="button" class="btn btn-primary next">
										Next
										<i class="glyphicon glyphicon-chevron-right"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			');
    } 

	//get first photo of Product
    public function getFirstPhotoProduct($id)
    {
        $query = "SELECT * FROM tbl_products_image WHERE product_id='$id' LIMIT 0,1";
        $result = $this->conn->query($query) or die("Error getFirstPhotoProduct: " . $this->conn->error);
        $rows = mysqli_fetch_array($result);
        $image = $rows["photos"];
        return $image;
    } 

	// show products
    public function showProductsInPortfolio()
    {
        $query = "SELECT * FROM tbl_products ORDER BY id DESC";
        $result = $this->conn->query($query) or die("Error showProductInPortfolio: " . $this->conn->error);
        while ($rows = mysqli_fetch_array($result))
        {
            $image = substr($this->getFirstPhotoProduct($rows['id']) , 3);
            print ('
			<div class="Portfolio"><a href="product/product-detail.php?id=' . $rows["id"] . '"><img class="card-img" src="' . $image . '" alt=""></a><div class="desc">' . $rows["name"] . '  $' . $rows["price"] . '</div></div>
				');
        }
    }

	// show Product image with detail for pic
    public function showProductImageForPic($id)
    {
        $query = "SELECT * FROM tbl_products_image WHERE product_id = '$id'";
        $result = $this->conn->query($query) or die("Error showProductImageForPic: " . $this->conn->error);
        $active = "active";
        $count = 1;
        print ('<div class="preview-pic tab-content">');
        while ($rows = mysqli_fetch_array($result))
        {
            print ('<div class="tab-pane ' . $active . '" id="pic-' . $count . '"><img src="' . $rows["photos"] . '" /></div>');
            $count++;
            if ($count > 1)
            {
                $active = "";
            }
        }
        print ('</div>');
    }

	//show Product image with detail for thumbnail
    public function showProductImageForThumbnail($id)
    {
        $query = "SELECT * FROM tbl_products_image WHERE product_id = '$id'";
        $result = $this->conn->query($query) or die("Error showProductImageForThumbnail: " . $this->conn->error);
        $active = "active";
        $count = 1;
        print ('<ul class="preview-thumbnail nav nav-tabs">');
        while ($rows = mysqli_fetch_array($result))
        {
            print ('<li class="' . $active . '"><a data-target="#pic-' . $count . '" data-toggle="tab"><img src="' . $rows["photos"] . '" /></a></li>');
            $count++;
            if ($count > 1)
            {
                $active = "";
            }
        }
        print ('</ul>');
    }

	//show Product cart
    public function showProductCart()
    {
        print ('
				<div class="container">
				<table id="cart" class="table table-hover table-condensed">
						<thead>
							<tr>
								<th style="width:50%">Product</th>
								<th style="width:10%">Price</th>
								<th style="width:8%">Quantity</th>
								<th style="width:22%" class="text-center">Subtotal</th>
								<th style="width:10%"></th>
							</tr>
						</thead>
						<tbody>');
        $total = 0;
        if (isset($_SESSION["cart"]))
        {
            foreach ($_SESSION["cart"] as $value)
            {
                $sub = $value["price"] * $value["quant"];
                $total += $sub;
                $url1 = 'product-cart-refresh.php?id=' . $value["id"] . '&value=';
                $url1 = "'$url1'";
                $url2 = 'product-cart-delete.php?id=' . $value["id"] . '';
                $url2 = "'$url2'";
                print ('
					<tr>
						<td data-th="Product">
							<div class="row">
								<div class="col-sm-2 hidden-xs"><img src="' . $value["image"] . '" alt="..." class="img-responsive"/></div>
								<div class="col-sm-10">
									<h4 class="nomargin">' . $value["name"] . '</h4>
								</div>
							</div>
						</td>
						<td data-th="Price">$' . $value["price"] . '</td>
						<td data-th="Quantity">
							<input type="number" id="quant" class="form-control text-center" value="' . $value["quant"] . '">
						</td>
						<td data-th="Subtotal" class="text-center">' . $sub . '</td>
						<td class="actions" data-th="">
							<button onclick="refresh_cart(' . $url1 . ')" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button></a>
							<button onclick="delete_cart(' . $url2 . ')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></a>								
						</td>
					</tr>
				');
            }
        }
        print ('			
						</tbody>
						<tfoot>
							<tr>
								<td><a href="../products.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
								<td colspan="2" class="hidden-xs"></td>
								<td class="hidden-xs text-center"><strong>Total $' . $total . '</strong></td>
								<td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
							</tr>
						</tfoot>
				</table>
			</div>');
    }

    //start of create order
    public function createOrder($user_id, $name, $email, $address, $phone, $c_name, $c_number, $cvv)
    {
        $query = "INSERT INTO tbl_order(user_id,name,email,phone,address,c_name,c_number,cvv,status) VALUES('$user_id','$name','$email','$phone','$address','$c_name','$c_number','$cvv','in process')";
        $result = $this->conn->query($query) or die("Error createOrder: " . $this->conn->error);
    }

	//get the Lastest of Order
    public function getLastestOrderID()
    {
        $query = "SELECT * FROM tbl_order ORDER BY id DESC LIMIT 0,1";
        $result = $this->conn->query($query) or die("Error getLastestOrderID: " . $this->conn->error);
        $rows = mysqli_fetch_array($result);
        return $rows;
    } 
	
    //start of add products to order
    public function addProductsToOrder($id)
    {
        foreach ($_SESSION["cart"] as $value)
        {
            $id2 = $value["id"];
            $quant = $value["quant"];
            $query = "INSERT INTO tbl_products_order (order_id,product_id,quantity) VALUES('$id','$id2','$quant')";
            $result = $this->conn->query($query) or die("Error addProductsToOrder: " . $this->conn->error);
        }
    }

    //start of display order
    public function displayOrders()
    {
        $query = "SELECT * FROM tbl_order";
        $result = $this->conn->query($query) or die("Error displayOrders: " . $this->conn->error);
        print ('<table class="table table-striped"><tbody>');
        print ('<tr>
						<th scope="col">Id</th>
						<th scope="col">user_id</th>
						<th scope="col">name</th>
						<th scope="col">email</th>
						<th scope="col">phone</th>
						<th scope="col">cardholder name</th>
						<th scope="col">card number</th>
						<th scope="col">Action
					</tr>
			');
        while ($rows = mysqli_fetch_array($result))
        {
            print ('
                <tr>
                  <td>' . $rows["id"] . '</td>
                  <td>' . $rows["user_id"] . '</td>
				  <td>' . $rows["name"] . '</td>
				  <td>' . $rows["email"] . '</td>
				  <td>' . $rows["phone"] . '</td>
				  <td>' . $rows["c_name"] . '</td>
				  <td>' . $rows["c_number"] . '</td>
                  <td>
                  	<a href="admin-orders-products.php?id=' . $rows["id"] . '" title="Show Product"><i class="icon-edit"></i></a>
                  </td>
                </tr>
			');
        }
        print ('</tbody></table>');
    }

	//start of show products in order
    public function showProductsInOrder($id)
    {
        $query = "SELECT * FROM tbl_products_order WHERE order_id = '$id'";
        $result = $this->conn->query($query) or die("Error showProductsInOrder: " . $this->conn->error);
        print ('<table class="table table-striped"><tbody>');
        print ('
				<tr>
					<th scope="col">Product name</th>
					<th scope="col">Product Image</th>
					<th scope="col">Quantity</th>
				</tr>
			');
        while ($rows = mysqli_fetch_array($result))
        {
            $get = $this->getProductsInfo($rows["product_id"]);
            print ('
				<tr>
					<td>' . $get["name"] . '</td>
					<td><img src="' . $this->getFirstPhotoProduct($rows["product_id"]) . '" width="120px" height="120px"/></td>
					<td>' . $rows["quantity"] . '</td>
				</tr>
			');
        }
    }
}
?>
