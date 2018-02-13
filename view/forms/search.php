<?php
	require 'menu.php';
	require '../util/urllib.php';
?>
<div class="form-container">
	<form action="../product/query.php" method="post" id="query-form" class="form">
			<legend>Search Product</legend><br><br>
			<label>Enter product Id : </label><br>
			<input type="number" name="product_id"  class="input-box" required><br><br>
			<input type="submit" value="Search product" class="input-button" ><br><br>
	</form>
</div>