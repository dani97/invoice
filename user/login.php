<?php
	session_start();
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST");
	header('Content-Type: application/json');
	require_once '../db/dbutil.php';
	require_once '../model/user.php';
	$data = json_decode(file_get_contents("php://input"),true);
	$db = new DB();
	$db->connect();
	$data['password'] = md5($data['password']);
	$query = "select * from user where user_id = :user_id and password = :password";
	$result = $db->select($query, $data,"User");
	if(count($result)==0){
		echo json_encode(array("status"=>"invalid userid"));
	}
	else{
		echo json_encode(array('status' => "login success", "token" => md5($result[0]->user_id),"user_type" => $result[0]->user_type));
	}
?>