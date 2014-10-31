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
	
	
	
	//$mypdf->Ln(3);
	//$mypdf->SetFont('Arial','I',8);
	//$mypdf->Cell(24,10,"Classificado por: ",0,0);
	//$mypdf->Cell(0,0,"Periodo ",0,0,'R');
	 
	$mypdf->Ln(18);
	$mypdf->SetFont('Arial','B',11);
	$mypdf->Ln(5);
	$mypdf->SetFillColor(205,205,205);
	$mypdf->Cell(-3);
	$mypdf->Cell(33,7,'Data  ',1,0,'C','True');
	//$mypdf->Cell(5);
	$mypdf->Cell(23,7,'Hora',1,0,'C','True');
	$mypdf->Cell(25,7,"Nota",1,0,'C','True');
	$mypdf->Cell(33,7,"Data Emi.",1,0,'C','True');
	$mypdf->Cell(33,7,"Data Che.",1,0,'C','True');
	$mypdf->Cell(50,7,utf8_decode('Usuário'),1,0,'C','True');
	//$mypdf->Ln(3);
	//$mypdf->Cell(15,10,'','BLR',0,'C','True');
	
	
	$mypdf->Ln(3);
	//-------------------------------------
	$count=-1;
	$qtd=0;
	foreach ($log as $key => $value){
		$count++;
	}
	foreach ($log as $key => $value){
		$data= substr($log[$key]['DATA'] ,6,2) .'/'. substr($log[$key]['DATA'] ,4,2) .'/'. substr($log[$key]['DATA'] ,0,4) ;
		$hora= substr($log[$key]['HORA'] ,0,2) .':'.  substr($log[$key]['HORA'] ,2,2); 
		
		$mypdf->SetFont('Arial','',10);
		$mypdf->Ln(5);
		$mypdf->SetFillColor(255,255,255);
		$mypdf->Cell(-3);
		$mypdf->Cell(33,7,	$data 	,0,0,'C','True');
		//$mypdf->Cell(5);
		$mypdf->Cell(23,7,	$hora 	,0,0,'C','True');
		$mypdf->Cell(25,7,	$log[$key]['NOTENT'] 	,0,0,'C','True');
		$mypdf->Cell(33,7,	$log[$key]['SQL_NEDATEMI']	,0,0,'C','True');
		$mypdf->Cell(33,7,	$log[$key]['SQL_NEDATCHE']	,0,0,'C','True');
		$mypdf->Cell(50,7,	utf8_decode($log[$key]['USUARIO']) 	,0,0,'C','True');
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