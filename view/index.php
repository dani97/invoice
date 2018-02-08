<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="form-container">
	<form class="form" method="post" action="user/login.php" class="">
		<?php
			if(isset($_GET['status'])&&(strcmp($_GET['status'],"failure")==0)){
				echo "<p>Username or password invalid; please resubmit form</p>";
				unset($_GET['status']);
			} 
		?>
		<legend>Login Form</legend><br> 
		<label>User Id</label><br>
		<input type="text" name="user_id" placeholder="enter user id" class="input-box" required><br><br>
		<label>Password</label><br>
		<input type="password" name="password" placeholder="enter password" class="input-box" required><br><br>
		<input type="submit" value="login">
	</form>
</div>
</body>
</html>