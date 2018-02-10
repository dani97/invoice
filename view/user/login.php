<?php
	require '../util/urllib.php';
	session_start();
	$data = array();
	if(isset($_POST['user_id']) && isset($_POST['password'])) {
		$data['user_id'] = $_POST['user_id'];
		$data['password'] = $_POST['password'];
		$data = json_encode($data);
		$response = json_decode(url::postData("http://localhost/invoice/user/login.php",$data),true);
		if(strcmp($response['status'],"login success")==0) {
			$_SESSION['user_id'] = $_POST['user_id'];
			$_SESSION['token'] = $response['token'];
			$_SESSION['user_type'] = $response['user_type'];
			header('location: http://localhost/invoice/view/user/forms');
		}
		else {
			setcookie('status', 'failure', -1, "/");
			header('location: http://localhost/invoice/view/index.php?');
		}
	}
	else {
		header('location: http://localhost/invoice/view');
	}

?>