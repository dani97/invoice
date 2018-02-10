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
	if(authenticate($data)) {
		unset($data['token']);
		if(isset($data['old_password']) && isset($data['new_password'])) {
			$data['old_password'] = md5($data['old_password']);
			$data['new_password'] =  md5($data['new_password']);
			$db = new DB();
			$db->connect();
			$query = "update user set password = :new_password where user_id = :user_id and password = :old_password";
			$result = $db->tableUpdate($query,$data);
			if($result>0){
				echo json_encode(array("status" => "password updation successful"));
			} else if($result==0) {
				echo json_encode(array("status" => "password updation failed"));
			} else {
				echo json_encode(array("status" => "internal error"));
			}
		}
		else{
			echo json_encode(array("status" => "invalid request"));
		}
	}
	else {
		echo json_encode(array("status" => "authentication error"));
	}	
?>