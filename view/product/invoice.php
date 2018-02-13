<?php
	require '../util/fpdf181/fpdf.php';

	class InvoicePDF extends FPDF {
		function Header() {
			$this->AddFont('RobotoSlab-Regular','','RobotoSlab-Regular.php');
			$this->SetFont('RobotoSlab-Regular','',32);
			$this->SetDrawColor(244,244,83);
			$this->setFillColor(244,244,66);
			$this->rect(0,0,$this->GetPageWidth(),70,'FD');
			$this->Cell(20);
			$this->Cell(20,40,"Invoice",0,0,'C');
			$this->Image('https://d30y9cdsu7xlg0.cloudfront.net/png/15906-200.png',150,10,50,50,'PNG');

		}

		function Footer() {
			$this->setFillColor(204,204,189);
			$this->rect(0,270,$this->GetPageWidth(),30,'F');
		}

		function FancyTable($header, $data)
		{
			// Colors, line width and bold font
			$this->SetFont('Arial','','12');
			$this->SetFillColor(255);
			//$this->SetTextColor(255);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
			$this->SetLeftMargin(20);
			$this->SetY(90);
			// Header
			$w = array(30, 55, 40, 45);
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],20,$header[$i],0,0,'C',true);
			$this->Ln();
			// Color and font restoration
			$this->SetFillColor(224,252,252);
			$this->SetTextColor(0);
			$this->SetFont('');
			// Data
			$fill = true;
			$total = 0;
			foreach($data as $row)
			{
				$this->SetDrawColor(255);
				$this->SetLineWidth(.1);
				$this->Cell($w[0],10,$row['product_id'],'L',0,'C',$fill);
				$this->Cell($w[1],10,$row['product_name'],'L',0,'C',$fill);
				$this->Cell($w[2],10,number_format($row['quantity']),'L',0,'C',$fill);
				$this->Cell($w[3],10,number_format($row['amount']),'L',0,'C',$fill);
				$total += $row['amount'];
				$this->Ln();
			}
			// Closing line
			//$this->Cell(array_sum($w),0,'','T');
			$this->Ln();
			$this->Ln();
			$this->SetFillColor(46,193,100);
			$this->SetTextColor(255);
			$this->Cell(85,10,"Total","L",0,'C',$fill);
			$this->Cell(85,10,number_format($total),"L",0,'C',$fill);
		}
	}
?>