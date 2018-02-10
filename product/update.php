<?php
	$data = json_decode(file_get_contents("php://input"),true);
	function authenticate($data) {
		if($data==null) {
			return false;
		}
		if(strcmp($data['token'],md5($data['user_id'])==0)){
			return true;
		}
		return false;
	}
	if(authenticate($data)){
		require_once '../db/dbutil.php';
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET");
		header('Content-Type: application/json');
		unset($data['token']);
		unset($data['user_id']);
		$db = new DB();
		$db->connect();
		$output = array();
		if(isset($data['product_id']) && isset($data['quantity']) && isset($data['price'])) {
			$query = "update products set quantity = :quantity, price =  :price where product_id = :product_id";
			$result = $db->tableUpdate($query, $data);
			if($result>0) {
				$output["status"] = "quantity,price updation successful";
			}
			else if($result==0) {
				$output["status"] = "product not found";
			}
			else {
				$output["status"] = "quantity,price updation failed";
			}
		}
		else if(isset($data['product_id']) && isset($data['quantity'])) {
			$query = "update products set quantity = :quantity where product_id = :product_id";
			$result = $db->tableUpdate($query, $data);
			if($result>0) {
				$output["status"] = "quantity updation successful";
			}
			else if($result==0) {
				$output["status"] = "product not found";
			}
			else {
				$output["status"] = "quantity updation failed";
			}
		}
		else if(isset($data['product_id']) && isset($data['price'])) {
			$query = "update products set price = :price where product_id = :product_id";
			$result = $db->tableUpdate($query, $data);
			if($result>0) {
				$output["status"] = "price updation successful";
			}
			else if($result==0) {
				$output["status"] = "product not found";
			}
			else {
				$output["status"] = "price updation failed";
			}
		}
		else {
			$output["status"] = "updation information is missing";
		}
		$db->close();
		echo  json_encode($output);
	}
	else{
		echo json_encode(array("status"=>"authentication error"));
	}
?>