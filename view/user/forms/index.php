<?php
	require 'menu.php';
	require '../../util/urllib.php';
?>
<div class="form-container">
	<div class="products" id="product-list">
			<?php
				$data = array();
				$data['token'] = $_SESSION['token'];
				$data['user_id'] = $_SESSION['user_id'];
				$data = json_encode($data);
				$response = json_decode(url::postData("http://localhost/invoice/product/products.php",$data),true);
				if($response['status']=="success"){
					$products = $response['data'];
					foreach ($products as $product) {

						echo "<div class='product'>";
						echo "<div class='icon'>";
						echo "<i class='fas fa-cart-arrow-down fa-5x'></i></div>";
						echo "<div class='right'><p> Product Id : ".$product['product_id']."</p>";
						echo "<p> Name :".$product['product_name']."</p>";
						echo "<p> Quantity : ".$product['quantity']." ".$product['unit']."</p>";
						echo "<p> Price: ".$product['price']."</p></div></div>";
					}
				}
				
			?>
