<?php
		function authenticate($data) {
		if(strcmp($data['token'],md5($data['user_id'])==0)){
			return true;
		}
		return false;
		}
		if(authenticate($data)){
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: POST");
			header('Content-Type: application/json');
			require '../db/dbutil.php';
			$data = json_decode(file_get_contents("php://input"),true);
			$db = new DB();
			$db->connect();
			$data['password'] = md5($data['password']);
			$query = "insert into user (user_name, password, user_type) values (:user_name, :password, :user_type)";
			$result = $db->tableUpdate($query,$data);
			if($result) {
				echo json_encode(array("status"=>"user added successful"));
			}
			else{
				echo json_encode(array("status"=>"user could not be added"));
			}
		}
		else {
			echo json_encode(array("status"=>"authentication error"));
		}

?>