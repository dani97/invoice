<?php
	session_start();
	require '../util/urllib.php';
	require 'invoice.php';
	$data = array();
	$data['token'] = $_SESSION['token'];
	$data['user_id'] = $_SESSION['user_id'];
	$data['order'] = json_decode($_POST['json'],true);
	//print_r($data['order']);
	if(count($data)!=0) {
		$data = json_encode($data);
		$response = json_decode(url::postData("http://localhost/invoice/checkout/cart.php",$data),true);
		setcookie('status', $response['status'], time() + (86400 ), "/");
		if($response['status_code'] == 200){
			$pdf = new InvoicePDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$header = array('Product Id','Product Name','Quantity','Price');
			$pdf->FancyTable($header,$response['order_status']);
			$pdf->Output();
			$pdf->close();
		}
}

?>