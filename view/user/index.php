<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice Console</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<nav class = "top-nav">
		<a href="#add-form">Add Product</a>
		<a href="#update-form">Update Product</a>
		<a href="#delete-form">Delete Product</a>
		<a href="#query-form">Query product</a>
		<?php
			if($_SESSION['user_type']=="admin") {
				echo "<a href='#add-user'> Add User</a>";
			}
		?>
	</nav>
	<div class="form-container">
		<form id ="add-form" class = "form hide" action = "../product/add.php" method =  "post">
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
		<form id="update-form" action="../product/update.php" method="post" class="form hide">
			<legend>Update Product</legend><br><br>
			<label>Enter Product name : </label><br>
			<input type="number" name="product_id"  class="input-box" required><br><br>
			<label>Enter quantity : </label><br>
			<input type="number" name="quantity" class="input-box" ><br><br>
			<label>Enter price : </label><br>
			<input type="number" name="price" class="input-box" ><br><br>
			<input type="submit" value="Update Product" class="input-button" ><br><br>
		</form>
		<form action="../product/delete.php" method="post" id="delete-form" class="form hide">
			<legend>Delete Product</legend><br><br>
			<label>Enter product Id : </label><br>
			<input type="number" name="product_id" class="input-box" required><br><br>
			<input type="submit" value="Delete product" class="input-button" ><br><br>
		</form>
		<form action="../product/query.php" method="post" id="query-form" class="form hide">
			<legend>Query Product</legend><br><br>
			<label>Enter product Id : </label><br>
			<input type="number" name="product_id"  class="input-box" required><br><br>
			<input type="submit" value="Query product" class="input-button" ><br><br>
		</form>
		<form action="../user/add.php" method="post"  id="add-user" class="form hide">
			<legend> Add User</legend><br><br>
			<label>Enter user name : </label><br>
			<input type="text" name="user_name"  class="input-box" required><br><br>
			<label>Enter User Default Password : </label><br>
			<input type="password" name="password" class="input-box" required><br><br>
			<label>Enter user type: </label><br>
			<input type="text" name="user_type" class="input-box" required><br><br>
			<input type="submit" value="add user" class="input-button" ><br><br>
		</form>

</div>
</body>
<script src="../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>
