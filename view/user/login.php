<?php
	session_start();
	require '../util/urllib.php';
	$data = array();
	if(isset($_POST['user_id']) && isset($_POST['password'])) {
		$data['user_id'] = $_POST['user_id'];
		$data['password'] = $_POST['password'];
		$data = json_encode($data);
		$response = url::postData("http://localhost/invoice/user/login.php",$data);
		var_dump($response); 
	}
	else {
		header('location: http://localhost/invoice/view');
	}

?>