<?php
	function authenticate($data) {
		if($data==null) {
			return false;
		}
		if(strcmp($data['token'],md5($data['user_id'])==0)){
			return true;
		}
		return false;
	}
	$data = json_decode(file_get_contents("php://input"),true);
	$output = array();
	if(authenticate($data)) {
		require_once '../db/dbutil.php';
		require_once '../model/product.php';
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET");
		header('Content-Type: application/json');
		$db = new DB();
		$db->connect();
		
		$output['order_status'] = array();
		$output['order_log'] = array();
		if(isset($data['order']) && count($data['order'])!=0){
			$count = count($data['order']);
			$items_added = 0; 
			foreach($data['order'] as $order) {
				if(isset($order['product_id']) && isset($order['order_quantity'])){
					$query = "select * from products where product_id=:product_id";
					$products = $db->select($query, array("product_id"=>$order['product_id']),"Product");
					if(count($products)>0){
						$product = $products[0];
						if($product->quantity >= $order['order_quantity']) {
							$query = "update products set quantity = quantity-:order_quantity where product_id = :product_id";
							$result = $db->tableUpdate($query , $order);
							if($result>0){
								$order_status = array("product_id"=>$product->product_id,"product_name"=>$product->product_name,"quantity"=>$order['order_quantity'],"amount"=>$product->price * $order['order_quantity']);
								array_push($output['order_status'],$order_status);
								$items_added+=1;
							} else {
								array_push($output['order_log'], "error occured while adding ".$product->product_name);
							}	
						} 
						else {
							array_push($output['order_log'], $product->product_name." is not available enough to meet your request"); 
						}
					} else{
						array_push($output['order_log'], "couldn't find product ".$order['product_id']);
					}
				} else {
					array_push($output['order_log'], "error processing a request");
				}
			}
			if($count>$items_added){
				$output['status_code'] = 200;
				$output['status'] = "some products are not available; please look at order_log for more information";
			}
			else {
				$output['status_code'] = 200;
				$output['status'] = "Order placed successfully";
			}
		}
		else{
			$output['status_code'] = 304;
			$output['status'] = "Please provide order details";
		}
	}
	else {
		$output['status_code'] = 305;
		$output['status'] = "authentication error";
	}
	echo json_encode($output);
?>