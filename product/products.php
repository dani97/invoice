<?php
	require '../db/dbutil.php';
	require '../model/product.php';
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
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET");
		header('Content-Type: application/json');
		$db = new DB();
		$db->connect();
		$query = "select * from products";
		$result = array();
		$result['status'] = "success";
		$result['data'] = $db->select($query,array(),"Product");
		$db->close();
		echo json_encode($result);
	}
	else{
		echo json_encode(array('status' => 'authentication failure'));
	}
?>