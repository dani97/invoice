<?php
	session_start();
	require '../util/urllib.php';
	$data = array();
	if(isset($_POST['product_id'])){
		$data['product_id'] = $_POST['product_id'];
		$data['token'] = $_SESSION['token'];
		$data['user_id'] = $_SESSION['user_id'];
		$data = json_encode($data);
		$response = json_decode(url::postData("http://localhost/invoice/product/delete.php",$data),true);
		setcookie('status', $response['status'], time() + (86400 ), "/");
	}
?>
<a href="http://localhost/invoice/view/user/forms"> go back</a>  