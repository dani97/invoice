<?php
	require 'menu.php';
	require '../util/urllib.php';
?>
<div class="form-container">
		<form id ="add-form" class = "form" action = "../product/add.php" method =  "post">
			<legend>Add Product</legend><br><br>
			<label>Enter Product name : </label><br>
			<input type="text" name="product_name" class="input-box" required><br><br>
			<label>Enter quanity : </label><br>
			<input type="number" name="quantity" class="input-box" required><br><br>
			<label>Enter unit : </label><br>
			<input type="unit" name="unit"  class="input-box" required><br><br>
			<label>Enter price : </label><br>
			<input type="number" name="price" class="input-box" required><br><br>
			<input type="submit" value="Add Product" class="input-button">
		</form>
	</div>