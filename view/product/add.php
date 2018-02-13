<?php
	require 'menu.php';
	require '../util/urllib.php';
	$data = array();
	if(isset($_POST['product_name']) && isset($_POST['quantity']) && isset($_POST['unit']) && isset($_POST['price'])){
		$data['product_name'] = $_POST['product_name'];
		$data['quantity'] = $_POST['quantity'];
		$data['unit'] = $_POST['unit'];
		$data['price'] = $_POST['price'];
		$data['token'] = $_SESSION['token'];
		$data['user_id'] = $_SESSION['user_id'];
		$data = json_encode($data);
		$response = json_decode(url::postData("http://localhost/invoice/product/create.php",$data),true);
		echo "<div class='status'> ".$response['status']."</div>";
	}

?>
<a href="http://localhost/invoice/view/user/forms"> go back</a>  