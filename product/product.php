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
		$result["status"] = "success";
		$result["data"] = $db->select($query,$params,"Product");
	}
	else if(isset($data['product_name'])) {
		$params = array("product_name" => $data['product_name']);
		$query = "select * from products where product_name=:product_name";
		$result["status"] = "success";
		$result["data"] = $db->select($query,$params,"Product");
	}
	else {
		$result['status'] = "error";
	}
	echo json_encode($result);
	$db->close();
	?>