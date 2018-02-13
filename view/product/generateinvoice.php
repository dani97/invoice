<?php
	require 'invoice.php';
	$pdf = new InvoicePDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$header = array('Product Id','Product Name','Quantity','Price');
	$pdf->FancyTable($header,$response['order_status']);
	$pdf->Output();
	$pdf->close();
?>