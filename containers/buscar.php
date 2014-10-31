

<div align="center">
	<div  id="consulta"  style="background-color:#E9E7E7;border-radius: 8px;box-shadow: 0 15px 20px rgba(0, 0, 0, .175); height: 250px;width:900px; border-style: double;">
		<br>	
		<br><br>
		<div>
			<div style="padding-left:100px">
				<table align="left">
					<tr>
						<th>	<label> Data: </label></tr>
				</table>		
				<br>				<table align="left">
					<tr>
						<th>	<label>  De: </label>	</th>
						<th style="padding-left:19px">	<input type="date" name="data_de" class="form-control" style="width:210px; "  />	</th>
						<th style="padding-left:10px">	<label> Até: </label>	</th>
						<th style="padding-left:19px">	<input type="date" name="data_ate" class="form-control" style="width:210px; "  />	</th>
					</tr>
				</table>
			</div>
			<input type="button"  name="consultar" id="consultar" value="Consultar" align="center"  class="btn btn-primary btn-lg ">
		</div>

	</div>
	<div id="tabela"  style="background-color:#E9E7E7;border-radius: 8px;box-shadow: 0 15px 20px rgba(0, 0, 0, .175); height: 380px;width:600px; border-style: double;">
		<img src="..\img\loader.gif" id="load_2" style="width:40px" height="40px" />	 
		<br>
		<div align="left" style="width:500px; ">
			<a href="#" id="print"> <img src="..\img\Icon-Printer.png" width="35px"> </a>
		</div>	
		<table class="table table-hover table-bordered" style="width:500px;  ">
			<thead style="background-image: linear-gradient(to bottom, #699BF7, #2F75F7); display: table-row; ">
				<tr>
					<th width="150px">
						Data
					</th>
					<th width="90px">
						Hora
					</th>
					<th width="190px">
						Usuário
					</th>
					<th width="50px">						
					</th>
					<th width="20px">						
					</th>
				</tr>
			</thead>
			<tbody id="p1" style=" height: 235px; overflow-y: auto; display: block; width:100%;  float: left">
			</tbody>
		</table>
	</div>

	<!-- ------------------------------------------------------------------------------------------------- -->

	<div id="tabela_2"  style="background-color:#E9E7E7;border-radius: 8px;box-shadow: 0 15px 20px rgba(0, 0, 0, .175); height: 410px;width:900px; border-style: double;">
		<br>
		<img src="..\img\loader.gif" id="load" style="width:25px" height="25px" />
		<div style="width:800px" align="right">
			<a href="#" id="print_2" style="align:left"> <img src="..\img\Icon-Printer.png" width="35px"> </a>
			<input type="button"  name="voltar" id="voltar" value="voltar" align="left"  class="btn btn-primary btn ">
		</div>
		<table class="table table-hover table-bordered" style="width:800px; ">
			<thead style="background-image: linear-gradient(to bottom, #699BF7, #2F75F7); display: table-row; ">
				<tr>
					<th width="60px">
						Nota
					</th>
					<th width="100px">
						Cod.Bus.
					</th>
					<th width="90px">
						Nat. Int.
					</th>
					<th width="90px">
						Nat. Ope.
					</th>
					<th width="150px">
						Data Emi.
					</th>
					<th width="150px">
						Data Che.
					</th>
					<th width="150px">
						Valor Total
					</th>
					<th width="20px">
						
					</th>
				</tr>
			</thead>
			<tbody id="p2" style=" height: 280px; overflow-y: auto; display: block; width:100%;  float: left">
			</tbody>
		</table>
	</div>
	
</div>


<script>
	$("#tabela").hide();
	$("#tabela_2").hide();
	$("#load").hide();
	$("#load_2").hide();
	$("input[name=consultar]").click(function(){
		var de= $("input[name=data_de]").val().substr(0,4) + $("input[name=data_de]").val().substr(5,2) + $("input[name=data_de]").val().substr(8,2);
		console.log(de);
		var ate= $("input[name=data_ate]").val().substr(0,4) + $("input[name=data_ate]").val().substr(5,2) + $("input[name=data_ate]").val().substr(8,2);
		console.log(ate);
		$("#load_2").fadeIn();

		$.ajax({
			type: "POST",
			data: {flag: 1, de:de, ate:ate},
			url: "../logic/logic.php",
			datatype: "html",
			success: function(result, status){
				console.log(result);
				if(result==0) 	alert("Nenhum resultado obtido!");
				else{						
					$("#tabela").fadeIn();
					$("#consulta").hide();
					//$("tr#linha").remove();
					var jsonretorno = JSON.parse(result);
					$(jsonretorno).each(function(ind, elem){
						var data= elem.DATA.substr(6,2) +'/'+ elem.DATA.substr(4,2) +'/'+ elem.DATA.substr(0,4);
						var hora= elem.HORA.substr(0,2) + ':' + elem.HORA.substr(2,2);
						$("#p1").append('<tr> <td  width="148px"> '+data+' </td>  <td width="90px"> '+hora+' </td>   <td width="190px"> '+elem.USUARIO+' </td>   <td  width="50px"> <a href="#" id="tab_2_'+elem.ID_LOG+'">  <img src="../img/Oxygen-Icons.org-Oxygen-Actions-go-next.ico" width="25px" height="25px" />   </a> </td>  </tr>');
					
						$("#tab_2_"+elem.ID_LOG+"").click(function(){
							console.log("tabela 2");
							$("#tabela").hide();
							$("#tabela_2").fadeIn();
							$("#load").fadeIn();

							$.ajax({
								type: "POST",
								data: {flag: 4, log:elem.ID_LOG},
								url: "../logic/logic.php",
								datatype: "html",
								success: function(result, status){
									$("#p2").empty();
									console.log(result);
									var jsdois = JSON.parse(result);
									$(jsdois).each(function(ind2, elem2){																		
										$("#p2").append('<tr> <td  width="60px"> '+elem2.NOTENT+' </td>   <td  width="100px"> '+elem2.SQL_DECODBUS+' </td> <td  width="90px"> '+elem2.SQL_NENATINT+' </td>  <td  width="90px"> '+elem2.SQL_NENATFIS+' </td>      <td  width="150px"> '+elem2.SQL_NEDATEMI+' </td>     <td width="150px"> '+elem2.SQL_NEDATCHE+' </td>    <td width="150px"> R$ '+elem2.SQL_NETOTNOT+' </td>   <!-- <td> <a href="#" id="print_3_'+elem2.NOTENT+'" > $ </a> </td>  -->  </tr>');
										$("#print_3_"+elem2.NOTENT+"").click(function(){
											console.log(elem2.NOTENT);
										});
									});
									$("#load").hide();
								},
								complete: function(result){
									console.log(status);
								}
							});	
						});
					});
					$("#load_2").hide();
				}
			},
			complete: function(result){
				console.log(status);
			}
		});	
	});

	


	$("input[name=voltar]").click(function(){
		$("#tabela_2").hide();
		$("#tabela").fadeIn();
	});

	$("#print").click(function(){
		console.log("Imprimir!");	
		window.open("../relatorios/transferencia.php","_blank");
	});
	$("#print_2").click(function(){
		console.log("Imprimir 2!");	
		window.open("../relatorios/notas.php","_blank");
	});
</script>

