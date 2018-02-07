<?php
	require '../db/dbutil.php';
	require '../model/product.php';

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET");
	header('Content-Type: application/json');
	
	$db = new DB();
	$db->connect();
	$query = "select * from products";
	$result = $db->select($query,array(),"Product");
	$db->close();
	echo json_encode($result);
?>