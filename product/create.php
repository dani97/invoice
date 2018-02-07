<?php
	session_start();
	if(isset($_SESSION['user_type']) && (strcmp($_SESSION['user_type'],"admin") 
		|| (strcmp($_SESSION['user_type'],"employee")))){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: POST");
		header('Content-Type: application/json');
		require '../db/dbutil.php';
		require '../model/product.php';

		function arrayToObject(array $array, $className) {
	    return unserialize(sprintf(
	        'O:%d:"%s"%s',
	        strlen($className),
	        $className,
	        strstr(serialize($array), ':')
	    ));
		}

		function validateProduct($product){
			var_dump(get_class_vars("Product"));
		}

		$data = json_decode(file_get_contents("php://input"),true);
		$db = new DB();
		$db->connect();
		$query = "insert into products (product_name, quantity, unit, price) ".
		"values(:product_name, :quantity, :unit, :price)";
		$result = $db->tableUpdate($query,$data);
		if($result){
			echo json_encode(array("status","success"));
		}
		else{
			echo json_encode(array("status","failure"));
		}
		$db->close();
	} else {
		echo json_encode(array("status"=>"authentication error"));
	}
?>
