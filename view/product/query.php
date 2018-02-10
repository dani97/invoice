<!DOCTYPE html>
<html>
<head>
	<title>Query </title>
</head>
<body>
<?php
	session_start();
	require '../util/urllib.php';
	$data = array();
	if(isset($_POST['product_id'])){
		$data['product_id'] = $_POST['product_id'];
		$data['token'] = $_SESSION['token'];
		$data['user_id'] = $_SESSION['user_id'];
		$data = json_encode($data);
		$response = json_decode(url::postData("http://localhost/invoice/product/product.php",$data),true);
		echo "<p> ".$response['status']."</p>";
		if($response['status']=="success") {
			echo "<p> Product Name: ".$response['data'][0]['product_name']."</p>";
			echo "<p> Qunatity: ".$response['data'][0]['quantity']." ".$response['data'][0]['unit']."</p>";
			echo "<p> Price: ".$response['data'][0]['price']."</p>";
		}
	}
	else{
		echo "<script>alert('invalid data')</script>";
	}
?>
<a href="http://localhost/invoice/view/user/forms"> go back</a>  
</body>
</html>