<?php
	require 'menu.php';
	require '../../util/urllib.php';
?>
<div class="form-container">
	<form action="../../user/update.php" method="post" id="delete-form" class="form">
			<legend>Update Password</legend><br><br>
			<label>Enter old password (min 6 letters): </label><br>
			<input type="password" name="old_password" class="input-box" pattern = ".{6,}" required><br><br>
			<label>Enter new password (min 6 letters): </label><br>
			<input type="password" name="new_password" class="input-box" pattern = ".{6,}" required><br><br>
			<input type="submit" value="change Password" class="input-button" ><br><br>
	</form>
</div>