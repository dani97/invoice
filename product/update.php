<?php
	session_start();
	if(isset($_SESSION['user_type']) && (strcmp($_SESSION['user_type'],"admin") 
		|| (strcmp($_SESSION['user_type'],"employee")))){
		require_once '../db/dbutil.php';
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET");
		header('Content-Type: application/json');

		$data = json_decode(file_get_contents("php://input"),true);
		$db = new DB();
		$db->connect();
		$output = array();
		if(isset($data['product_id']) && isset($data['quantity']) && isset($data['price'])) {
			$query = "update products set quantity = :quantity, price =  :price where product_id = :product_id";
			$result = $db->tableUpdate($query, $data);
			if($result) {
				$output['status'] = "quantity,price updation successful";
			}
			else {
				$output['status'] = "quantity,price updation failed";
			}
		}
		else if(isset($data['product_id']) && isset($data['quantity'])) {
			$query = "update products set quantity = :quantity where product_id = :product_id";
			$result = $db->tableUpdate($query, $data);
			if($result) {
				$output['status'] = "quantity updation successful";
			}
			else {
				$output['status'] = "quantity updation failed";
			}
		}
		else if(isset($data['product_id']) && isset($data['price'])) {
			$query = "update products set price = :price where product_id = :product_id";
			$result = $db->tableUpdate($query, $data);
			if($result) {
				$output['status'] = "price updation successful";
			}
			else {
				$output['status'] = "price updation failed";
			}
		}
		else {
			$output['status'] = "request error";
		}
		$db->close();
		echo  json_encode($output);
	}
	else{
		echo json_encode(array("status"=>"authentication error"));
	}
?>