<?php
	$data = json_decode(file_get_contents("php://input"),true);
	function authenticate($data) {
		if(strcmp($data['token'],md5($data['user_id'])==0)){
			return true;
		}
		return false;
	}
	if(authenticate($data)){
		unset($data['token']);
		unset($data['user_id']);
		require_once '../db/dbutil.php';
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET");
		header('Content-Type: application/json');
		$db = new DB();
		$db->connect();
		if(isset($data['product_id'])) {
			$query = "delete from products where product_id = :product_id";
			$result = $db->tableUpdate($query, $data);
			if($result>0) {
				echo json_encode(array("status"=>"product successfully deleted"));
			}
			else if($result==0) {
				echo json_encode(array("status"=>"product not found"));
			}
			else {
				echo json_encode(array('status' => "product could not be deleted" ));
			}
		}
		else {
			echo json_encode(array('status' => "please send product id"));
		}
	}
	else {
		echo json_encode(array("status"=>"authentication error"));
	}
?>