<?php
	require 'menu.php';
	require '../util/urllib.php';
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

						echo "<div class='product' data-id ='".$product['product_id']."'>";
						echo "<div class='right'><p> Product Id : ".$product['product_id']."</p>";
						echo "<p> Name :".$product['product_name']."</p>";
						echo "<p> Quantity : ".$product['quantity']." ".$product['unit']."</p>";
						echo "<p> Price: ".$product['price']."</p></div>";
						echo "<div class='cart-input'>";
						echo "<input type='number' placeholder = 'enter quantity' class='cart-quantity' name='order_quantity' min='1' max='".$product['quantity']."'>";
						echo "<button class='cart-button'><i class='fas fa-cart-arrow-down'></i>Add to cart</button></div></div>";

					}
				}
				
			?>
</div>

<div class="cart-list">
<div  id="cart-items">
</div>
	<form action = "../product/checkout.php"  class="cart" id="cartform"  method="post">
		<input type = "hidden" name="json" id="json">
		<button class="cart" id="cart"><i class="fas fa-shopping-cart">Checkout</i></button>
	</form>
</div>
</div>

</div>
 

<script src="../js/cart.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
	
</html>