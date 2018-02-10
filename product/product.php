<?php
	require '../db/dbutil.php';
	require '../model/product.php';

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET");
	header('Content-Type: application/json');

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
	} else{
		echo json_encode(array('status' => 'authentication failure'));
	}
	
	?>