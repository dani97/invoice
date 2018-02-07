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
		if(isset($data['product_id'])) {
			$query = "delete from products where product_id = :product_id";
			$result = $db->tableUpdate($query, $data);
			if($result) {
				echo json_encode(array("status"=>"product successfully deleted"));
			}
			else {
				echo json_encode(array('status' => "product could not be deleted" ));
			}
		}
		else {
			echo json_encode(array('status' => "couldn't fetch the product"));
		}
	}
	else {
		echo json_encode(array("status"=>"authentication error"));
	}
?>