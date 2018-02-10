 <?php
	session_start();
	require '../util/urllib.php';
	if(strcmp($_SESSION['user_type'],"admin")==0) {
		if(isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['user_type'])) {
			$data = array();
			$data['user_name'] = $_POST['user_name'];
			$data['password'] = $_POST['password'];
			$data['user_type'] = $_POST['user_type'];
			$data['token'] = $_SESSION['token'];
			$data['user_id'] = $_SESSION['user_id'];
			$data = json_encode($data);
			$response = json_decode(url::postData("http://localhost/invoice/user/add.php",$data),true);
			setcookie('status', $response['status'], time() + 5, "/");
		}
	}
?>