<?php
	session_start();
	require '../util/urllib.php';
	$data = array();
	if(isset($_POST['old_password']) && isset($_POST['new_password'])){
		$data['old_password'] = $_POST['old_password'];
		$data['new_password'] = $_POST['new_password'];
		$data['token'] = $_SESSION['token'];
		$data['user_id'] = $_SESSION['user_id'];
		$data = json_encode($data);
		$response = json_decode(url::postData("http://localhost/invoice/user/update.php",$data),true);
		setcookie('status', $response['status'], time() + (86400 ), "/");
	}
?>
<a href="http://localhost/invoice/view/user/forms">Home</a>