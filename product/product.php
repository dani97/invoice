<?php
	require '../db/dbutil.php';
	require '../model/product.php';

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET");
	header('Content-Type: application/json');

	$data = json_decode(file_get_contents("php://input"),true);
	$db = new DB();
	$db->connect();
	$result = array();
	if(isset($data['product_id'])) {
		$params = array(":product_id" => $data["product_id"]);
		$query = "select * from products where product_id=:product_id";
		$data = $db->select($query,$params,"Product");
		$count = count($data);
		if($count!=0) {
			$result["status"] = "success";
			$result["data"] = $data;
		}
		else{
			$result["status"] = "couldn't find product";
		}
	}
	else {
		$result['status'] = "error";
	}
	echo json_encode($result);
	$db->close();
	?>