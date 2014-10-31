<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Imóveis</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

	
	<script type="text/javascript" src="js/jquery.min.js" ></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
	
	
	<link rel="shortcut icon" href="img\Untitled-1.png" type="image/x-icon">
	
  </head>
  <body background="img\background-page.jpg">
   
	
	<br><br>
	
<div id="div-into" />
	<div align="center" style="padding-top:50px; " >
		<div align="center">
			<img src="img\loader.gif" align="center" id="load" style="width:40px; " height="40px" />
		</div>
		<br>
		<div class="container" align="center"  style="background-color:#E9E7E7;border-radius: 8px;box-shadow: 0 15px 20px rgba(0, 0, 0, .175); height: 310px;width:310px">
			<img src="img\logo-rei-soft.png" style="padding-top:20px;">
			<br>
			<br><br>
			<input type="text" name="usuario" autofocus style="border-radius: 3px;border: 1px solid #ccc; width:240px; height:30px;" placeholder="   Usuário"> <br>
			<input type="password" name="senha" style="border-radius: 3px;border: 1px solid #ccc; width:240px; height:30px;" placeholder="   Senha" > <br><br>
			<input type="button"  name="entrar" value="ENTRAR" align="center" style="width:100px" class="btn btn-default ">
			<br><br>
			<!--	<a href="#" id="a-alterar-senha">Alterar Senha </a>	-->
		</div>	
	</div>
	
	
	<br>
	<br><br><br><br><br>

	<div class="container" align="center"  style="position:relative; vertical-align:middle ;background-image: linear-gradient(to bottom, #758ff2, #96aaf6); border-style:solid; border-color: #344996 ; border-radius: 4px;box-shadow: 0 15px 20px rgba(0, 0, 0, .175); height: 60px;width:100%">
		<div align="left">
			<label  style=" align:left; margin-top:14px; font-size:19px"> Feira de Santana - Ba:</label> 
			<label style="font-wiegth:normal; margin-left:15px"> Av. Maria Quitéria, nº 1972 - Tel.: (75) 3604-0900 </label>
			<img src="img\logo-rei-soft.png" align="right" style="margin-top:5px" width="60px" height="45px">
		</div>
	</div>

	<script>
		$("#load").hide();
		$("input[name=entrar]").click(function(){
			window.location.href= "pags/inicio.php";
		});
		/*
		$(function(){
			
			$("input[name=entrar]").click(function(){
				//$("#div-into")load.("pags/inicio.php");
				$("#load").show();

				var user= $("input[name=usuario]").val();
				console.log(user);
				var senha= $("input[name=senha]").val();
				console.log(senha);	

				$.ajax({
					type: "POST",
					data: {flag: 2, user:user, senha:senha},
					url: "logic/logic.php",
					datatype: "html",
					success: function(result,status){
						console.log(result);
						if(result!=1){
							window.location.href= "pags/inicio.php";
							console.log("entrou");
							$("#load").hide();
						}else{
							alert("Usuário ou senha incorretos!");
							$("#load").hide();
						}
					},
					complete: function(result){
						console.log(status);
					}
				});	
			});

			$("body").keypress(function(event) {
	    		if (event.which == 13) {
	    			console.log("enter!");
	    			$("#load").show();

					var user= $("input[name=usuario]").val();
					console.log(user);
					var senha= $("input[name=senha]").val();
					console.log(senha);	

					$.ajax({
						type: "POST",
						data: {flag: 2, user:user, senha:senha},
						url: "logic/logic.php",
						datatype: "html",
						success: function(result,status){
							console.log(result);
							if(result!=1){
								window.location.href= "pags/inicio.php";
								console.log("entrou");
								$("#load").hide();
							}else{
								alert("Usuário ou senha incorretos!");
								$("#load").hide();
							}
						},
						complete: function(result){
							console.log(status);
						}
					});	
	    		}
	    	});
		});
		*/
	</script>
  </body>
</html>