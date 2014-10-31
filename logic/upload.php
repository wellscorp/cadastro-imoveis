<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once("../class/BD.class.php");
require_once("../class/BANCO.class.php");
$banco= new BANCOGMF();

date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL);


$data_1=date('Y').date('m').date('d');
$hora_1=date('H').date('i');

if ($_FILES["contrato"]["error"] > 0) {
    echo "Error: " . $_FILES["contrato"]["error"] . "<br>";
	$_SESSION['CONTRATO']= 0;
} else {
	  
	//if(file_exists("../files/" . $_FILES["file"]["name"])){
	//echo "  -  ". $_FILES["file"]["name"] . " Já existe";
	//}else{
	
	$tipo= explode("/",$_FILES["contrato"]["type"]);
	$diretorio= "C:/wamp/www/Sistema de Imoveis/files/CONTRATO_" . $data_1 . "_" . $hora_1 ."." . $tipo[1];
	move_uploaded_file($_FILES["contrato"]["tmp_name"], $diretorio );
	$_SESSION['CONTRATO']= $diretorio;
	//echo "Arquivo movido para " . "files/" . $_FILES["file"]["name"];
	//}
}
/*
for($i=0;$i<count(($_FILES["imagem"]["name"]);$i++){
	if ($_FILES["imagem"]["error"][$i] > 0) {
	    echo "Error: " . $_FILES["imagem"]["error"][$i] . "<br>";
		$_SESSION['IMAGEM']= 0;
	} else {

		$diretorio= "C:/wamp/www/Sistema de Imoveis/files/IMG_" .$i. "_" . $data_1 . "_" . $hora_1 .".txt";
		move_uploaded_file($_FILES["imagem"]["tmp_name"][$i], $diretorio );
		$_SESSION['IMAGEM']= $diretorio;
	}
}
*/
foreach ($_FILES["imagem"]["name"] as $key => $value) {
	if ($_FILES["imagem"]["error"][$key] > 0) {
	    echo "Error: " . $_FILES["imagem"]["error"][$key] . "<br>";
		$_SESSION['IMG']= 0;
	} else {

		$tipo= explode("/",$_FILES["imagem"]["type"][$key]);
		$diretorio= "C:/wamp/www/Sistema de Imoveis/files/IMG_" .$key. "_" . $data_1 . "_" . $hora_1 ."." . $tipo[1];
		move_uploaded_file($_FILES["imagem"]["tmp_name"][$key], $diretorio );
		$dir[]= $diretorio;		
	}
}
$_SESSION['IMG']= $dir;

$_SESSION['descri']= $_POST['descri'];
$_SESSION['end']= $_POST['end'];
$_SESSION['num']= $_POST['num'];
$_SESSION['cid']= $_POST['cid'];
$_SESSION['bai']= $_POST['bai'];
$_SESSION['dt_ini']= $_POST['dt_ini'];
$_SESSION['dt_fim']= $_POST['dt_fim'];
$_SESSION['cep']= $_POST['cep'];
$_SESSION['prop']= $_POST['prop'];
$_SESSION['inq']= $_POST['inq'];




?>
<body background="..\img\background-page.jpg">
	<dib style="align:center">
		<img  src="..\img\loader.gif" id="load" style="width:90px; margin-left:; margin-top:; align:center" height="90px" />
	</div>
	<script type="text/javascript" src="..\js/jquery.min.js" ></script>
	<script type="text/javascript" src="..\js/bootstrap.min.js"></script>
	<script type="text/javascript" src="..\js/bootstrap.js"></script>
<script>


	function inicio(){
		
		//$("input[name=transferir]").click(function(){

			//var dir= $("input[name=diretorio]").val();
			//var dir= $("input[name=file]").val();
			//var dir= document.getElementById("file"); 
			//var a=String.fromCharCode(92);
			//console.log(a);
			//dir = dir.split(a);
			//console.log(dir[2]);

			//if(dir=="")		alert("Diretório não especificado!");
			//else{
				//console.log(dir);

				$.ajax({
					type: "POST",
					//data: {flag: 10, dir:dir},
					data: {flag: 2},
					url: "logic.php",
					datatype: "html",
					success: function(result, status){
						console.log(result);
						/*
						if(result== '-3' || result== '-4'){
							alert("Arquivo invalido!");
							window.open("../pags/inicio.php","_self");

						}else{
							if(result== '-1'){							
								$.ajax({
									type: "POST",
									data: {flag: 0},
									url: "logic.php",
									datatype: "html",
									success: function(result, status){
										console.log(result);
										//alert("Informações transferidas com sucesso!");
										if(confirm("Informações transferidas com sucesso! \nDeseja imprimir relatório?") == true){
											$("#load").show();
											$.ajax({
												type: "POST",
												data: {flag: 4, log:''},
												url: "logic.php",
												datatype: "html",
												success: function(result, status){
													console.log(result);
													window.open("../relatorios/notas.php","_blank");
													
												},
												complete: function(result){
													console.log(status);
												}
											});	
										}else 	window.open("../pags/inicio.php","_self");;
									},
									complete: function(result){
										console.log(status);
									}
								});	
							}else{
								if(result== '-2'){
									alert("TODOS REGISTROS JÁ EXISTEM (REPETIDOS)!") 
									window.open("../pags/inicio.php","_self");

								}else{
									var x;
									result= result.split("-");
									if(confirm("Registros já existentes: "+result[0]+". \nRegistros novos: "+result[1]+". \nDeseja transferir registros novos?")== true){
										x="Transferir!";
										$.ajax({
											type: "POST",
											data: {flag: 0},
											url: "logic.php",
											datatype: "html",
											success: function(result, status){
												console.log(result);
												if(confirm("Informações transferidas com sucesso! \nDeseja imprimir relatório?") == true){
													$.ajax({
														type: "POST",
														data: {flag: 4, log:''},
														url: "logic.php",
														datatype: "html",
														success: function(result, status){
															console.log(result);
															window.open("../pags/inicio.php","_self")
															window.open("../relatorios/notas.php","_blank");
														},
														complete: function(result){
															console.log(status);
														}
													});	
												};
											},
											complete: function(result){
												console.log(status);
											}
										});
									}
									else{
										x= "Não transferir!";
										window.open("../pags/inicio.php","_self")
									}
									console.log(x);
								}
							}
						}
						*/
					},
					complete: function(result){
						console.log(status);
					}
				});		
			//}
		//});
	};
	

	inicio();



	/*
	function handleFileSelect(evt) {
	    var file = evt.target.file; // FileList object
	    console.log(file);

	    // file is a FileList of File objects. List some properties.
	    var output = [];
	    for (var i = 0, f; f = file[i]; i++) {
	      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
	                  f.size, ' bytes, last modified: ',
	                  f.lastModifiedDate.toLocaleDateString(), '</li>');
	    }
	    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
  	}

  	document.getElementById('file').addEventListener('change', handleFileSelect, false);
	*/
</script>
</body>
