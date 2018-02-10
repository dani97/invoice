<?php
	require 'menu.php';
	require '../../util/urllib.php';
?>
<div class="form-container">
	<form id="update-form" action="../../product/update.php" method="post" class="form">
			<legend>Update Product</legend><br><br>
			<label>Enter Product Id : </label><br>
			<input type="number" name="product_id"  class="input-box" required><br><br>
			<label>Enter quantity : </label><br>
			<input type="number" name="quantity" class="input-box" ><br><br>
			<label>Enter price : </label><br>
			<input type="number" name="price" class="input-box" ><br><br>
			<input type="submit" value="Update Product" class="input-button" ><br><br>
		</form>
</div>