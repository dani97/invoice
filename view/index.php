<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="form-container">
	<form class="form" method="post" action="user/login.php" class="">
		<legend>Login Form</legend><br> 
		<label>User Id</label><br>
		<input type="number" name="user_id" placeholder="enter user id" class="input-box" required><br><br>
		<label>Password</label><br>
		<input type="password" name="password" placeholder="enter password" class="input-box" required><br><br>
		<input type="submit" value="login" class="input-button">
		<?php
			if(isset($_COOKIE['status'])&&(strcmp($_COOKIE['status'],"failure")==0)){
				echo "<p class='red'>Username or password invalid; please resubmit form</p>";
				setcookie("status", "", -1,"/");
			} 
		?>
	</form>
</div>
</body>
</html>