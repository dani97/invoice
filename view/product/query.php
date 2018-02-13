<!DOCTYPE html>
<html>
<head>
	<title>Query </title>
</head>
<body>
<?php
	require 'menu.php';
	require '../util/urllib.php';
	$data = array();
	if(isset($_POST['product_id'])){
		$data['product_id'] = $_POST['product_id'];
		$data['token'] = $_SESSION['token'];
		$data['user_id'] = $_SESSION['user_id'];
		$data = json_encode($data);
		$response = json_decode(url::postData("http://localhost/invoice/product/product.php",$data),true);
		echo "<p> ".$response['status']."</p>";
		echo "<div class='status'>";
		if($response['status']=="success") {
			echo "<p> Product Name: ".$response['data'][0]['product_name']."</p>";
			echo "<p> Quantity: ".$response['data'][0]['quantity']." ".$response['data'][0]['unit']."</p>";
			echo "<p> Price: ".$response['data'][0]['price']."</p>";
		}
		echo "</div>";
	}
	else{
		echo "<script>alert('invalid data')</script>";
	}
?>
</body>
</html>