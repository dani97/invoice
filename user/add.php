<?php
		require '../db/dbutil.php';
		require '../model/user.php';
		$data = json_decode(file_get_contents("php://input"),true);
		function authenticate($data) {
		if($data==null) {
			return false;
		}
		if(strcmp($data['token'],md5($data['user_id'])==0)){
			$db = new DB();
			$db->connect();
			$query = "select user_type from user where user_id = :user_id";
			$result = $db->fetch($query,array("user_id"=>$data["user_id"]));
			if($result[0]['user_type']=="admin"){
				return true;
			}
			return false;
		}
		return false;
		}
		if(authenticate($data)){
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: POST");
			header('Content-Type: application/json');
			unset($data['token']);
			unset($data['user_id']);
			$db = new DB();
			$db->connect();
			$data['password'] = md5($data['password']);
			$query = "insert into user (user_name, password, user_type) values (:user_name, :password, :user_type)";
			$result = $db->tableUpdate($query,$data);
			$db->close();
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