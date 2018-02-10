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
		unset($data['token']);
		unset($data['user_id']);
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: POST");
		header('Content-Type: application/json');
		require '../db/dbutil.php';
		require '../model/product.php';
		$db = new DB();
		$db->connect();
		$query = "insert into products (product_name, quantity, unit, price) ".
		"values(:product_name, :quantity, :unit, :price)";
		$result = $db->tableUpdate($query,$data);
		if($result!=-1){
			echo json_encode(array("status"=>"success"));
		}
		else{
			echo json_encode(array("status"=>"failure"));
		}
		$db->close();
	} else {
		echo json_encode(array("status"=>"authentication error"));
	}
?>
