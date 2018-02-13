<?php
	require 'menu.php';
	require '../util/urllib.php';
	if($_SESSION['user_type']=="admin") {
?>
<div class="form-container">
		<form action="../user/add.php" method="post"  id="add-user" class="form">
			<legend> Add User</legend><br><br>
			<label>Enter user name : </label><br>
			<input type="text" name="user_name"  class="input-box" pattern = "[a-zA-Z ]+" required><br><br>
			<label>Enter User Default Password (min 6) letters: </label><br>
			<input type="password" name="password" pattern = ".{6,}" class="input-box" required><br><br>
			<label>Enter user type: </label><br>
			<input type = "radio" name="user_type" value="admin"> Admin
			<input type = "radio" name="user_type" value="employee" checked> Employee<br><br>
			<input type="submit" value="add user" class="input-button" ><br><br>
		</form>
</div>
<?php 
}
else {
	header("location : http://localhost/invoice/view/forms");	
}
?>
