<?php

	session_start();
	
	require_once("../class/BD.class.php");
	require_once("../fpdf.php");
	date_default_timezone_set('America/Sao_Paulo');
	
	
	class PDF extends FPDF {
		//Page footer
		function Footer()
		{
			//Position at 1.5 cm from bottom
			$this->SetY(-15);
			//Arial italic 8
			$this->SetFont('Arial','I',8);
			//Page number
			$this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
			$this->Cell(0,10,'Rei Software',0,0,'R');
		}
	}
	
	$mypdf= new PDF();
	$log= $_SESSION['aux'];


	
	$mypdf->AddPage('P', 'A4');
	
	//$mypdf->Ln(0);
	$mypdf->SetFont('Arial','B',22);
	
	$mypdf->Ln(5);
	$mypdf->Cell(80);
	$mypdf->Cell(39,20,utf8_decode("Relatório de Notas Transferidas"),0,0,'C');

	$mypdf->Cell(-110);
	$mypdf->Ln(-15);
	$mypdf->Image('C:\wamp\www\Sistema Validades\img\Untitled-1.png');
	$mypdf->Ln(-19);
	$mypdf->Cell(120);
	
	$mypdf->SetFont('Arial','I',10);
	//$mypdf->Cell(24,10,"Rei Informatica",0,0);
	$mypdf->Cell(0,0,'Data: '.date("d/m/Y"),0,0,'R');
	//$mypdf->Ln(5);

	$data= substr($log[0]['DATA'] ,6,2) .'/'. substr($log[0]['DATA'] ,4,2) .'/'. substr($log[0]['DATA'] ,0,4) ;
	$hora= substr($log[0]['HORA'] ,0,2) .':'.  substr($log[0]['HORA'] ,2,2); 
	
	
	//$mypdf->Ln(3);
	//$mypdf->SetFont('Arial','I',8);
	//$mypdf->Cell(24,10,"Classificado por: ",0,0);
	//$mypdf->Cell(0,0,"Periodo ",0,0,'R');
	$mypdf->Ln(22);
	$mypdf->SetFont('Arial','I',10);
	$mypdf->Cell(22);
	$mypdf->Cell(10,0,$data .' - '. $hora,0,0,'R');
	$mypdf->SetFont('Arial','B',11);
	$mypdf->Ln(5);
	$mypdf->SetFillColor(205,205,205);
	$mypdf->Cell(-6);
	$mypdf->Cell(19,7,"Nota",1,0,'C','True');
	$mypdf->Cell(25,7,"Cod. Bus.",1,0,'C','True');
	$mypdf->Cell(25,7,'Nat. Int.  ',1,0,'C','True');
	//$mypdf->Cell(5);
	$mypdf->Cell(25,7,'Nat. Ope.',1,0,'C','True');
	$mypdf->Cell(33,7,"Data Emi.",1,0,'C','True');
	$mypdf->Cell(33,7,"Data Che.",1,0,'C','True');
	$mypdf->Cell(40,7,"Valor",1,0,'C','True');
	//$mypdf->Ln(3);
	//$mypdf->Cell(15,10,'','BLR',0,'C','True');
	
	
	$mypdf->Ln(3);
	//-------------------------------------
	$qtd=0;
	foreach ($log as $key => $value){
		
		$mypdf->SetFont('Arial','',10);
		$mypdf->Ln(5);
		$mypdf->SetFillColor(255,255,255);
		$mypdf->Cell(-6);
		$mypdf->Cell(19,7,	$log[$key]['NOTENT'] 	,0,0,'C','True');
		$mypdf->Cell(25,7,	utf8_decode(ltrim($log[$key]['SQL_DECODBUS'])) 	,0,0,'C','True');
		$mypdf->Cell(25,7,	$log[$key]['SQL_NENATINT'] 	,0,0,'C','True');
		//$mypdf->Cell(5);
		$mypdf->Cell(25,7,	$log[$key]['SQL_NENATFIS'] 	,0,0,'C','True');
		$mypdf->Cell(33,7,	$log[$key]['SQL_NEDATEMI']	,0,0,'C','True');
		$mypdf->Cell(33,7,	$log[$key]['SQL_NEDATCHE']	,0,0,'C','True');
		$mypdf->Cell(40,7,	'R$ ' . $log[$key]['SQL_NETOTNOT']	,0,0,'C','True');
		//$mypdf->Cell(-20);
		$mypdf->Ln(6);
		$mypdf->Cell(190,7,"---------------------------------------------------------------------------------------------------------------------------------------------------------",0,0,'C','True');
		$qtd++;
	}
	
	$mypdf->Ln(13);
	$mypdf->SetFont('Arial','B',10);
	$mypdf->Cell(60,7,utf8_decode( "Quantidade total: " . $qtd ),0,0,'C','True');
	//$mypdf->Line(0,50,1000,50);
	//$mypdf->Ln(6);

	
	
	
	//echo $log[0]['RECEBER'];
	$mypdf->Output();
	
	
	



?>