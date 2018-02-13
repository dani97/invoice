<?php 
	session_start(); 
	if(!isset($_SESSION['user_id'])){
		header('location: http://localhost/invoice/view/index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice Console</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>
<body>
	<nav class = "top-nav">
		<a href="../forms/index.php">View products</a>
		<a href="../forms/addproduct.php">Add product</a>
		<a href="../forms/update.php">Update product</a>
		<a href="../forms/delete.php">Delete product</a>
		<a href="../forms/search.php">Search product</a>
		<?php
			if($_SESSION['user_type']=="admin") {
				echo "<a href='../forms/adduser.php'> Add user</a>";
				echo "<a href='../forms/user.php'>User list</a>";
			}
		?>
		<a href="../forms/changepassword.php">Change password</a>
		<a href="../forms/logout.php">Logout</a>
	</nav>
	<?php
		if(isset($_COOKIE['status'])) {
			echo "<div class='status'> <p>".$_COOKIE['status']."</p></div>";
			setcookie("status", "", -1,"/");
		}
	?>