<?php
	require 'menu.php';
	require '../../util/urllib.php';
?>
<div class="form-container">
	<form action="../../product/delete.php" method="post" id="delete-form" class="form">
			<legend>Delete Product</legend><br><br>
			<label>Enter product Id : </label><br>
			<input type="number" name="product_id" class="input-box" required><br><br>
			<input type="submit" value="Delete product" class="input-button" ><br><br>
	</form>
</div>