

<script type="text/javascript" src="..\js/jquery.min.js" ></script>
	<script type="text/javascript" src="..\js/bootstrap.min.js"></script>
	<script type="text/javascript" src="..\js/bootstrap.js"></script>
	<link href="..\css/bootstrap.min.css" rel="stylesheet">
	<meta charset="utf-8">

<div align="center">
	<div  style=" height: 270px;width:600px; ">
		
		<div id="consulta">
			<br>					<!--action="../logic/upload.php"-->
			<label>		Cadastrar Proprietário	</label>
			<form  action="../logic/upload.php" method="post" enctype="multipart/form-data" name="cadastro" >
							
				<br>
				<div class="form-group">
	                <label for="concept" align="right" class="col-sm-2 control-label">Nome</label>
	                <div class="col-sm-7">
	                    <input type="text" name="nome" class="form-control" align="left" style="width:100%; align:left" id="concept" name="concept">
	                </div>
	            </div>
	            <br>
	            <div class="form-group">
	                <label for="concept" align="right" class="col-sm-2 control-label">CPF</label>
	                <div class="col-sm-5">
	                    <input type="text" name="cpf" class="form-control" align="left" style="width:100%; align:left" id="concept" name="concept">
	                </div>
	            </div>
	            <br>
	            <div class="form-group">
	                <label for="concept" align="right" class="col-sm-2 control-label">RG</label>
	                <div class="col-sm-5" align="left">
	                	<input type="text" name="rg" class="form-control" align="center" style="width:100%; align:center" id="concept" name="concept">
	                </div>
	            </div>
	            <br>
	            <div class="form-group">
	                <label for="concept" align="right" class="col-sm-2 control-label">Data de Nascimento</label>
	                <div class="col-sm-3">
	                    <input type="date" name="nasc" class="form-control" align="left" style="width:140%; align:left" id="concept" name="concept">
	                </div>
	            </div>
	            

	            <br>
	            <div class="form-group" style="width:455px" align="center">
		            <input type="button"   name="cad_prop" id="cad_prop" value="Cadastrar" align="center"  class="btn btn-primary btn-lg ">
				</div>
			</form>
		</div>
		<!--
		<a href="#"><img alt="140x140" src="http://lorempixel.com/140/140/" class="img-rounded" /> </a>
		<a href="#"><img alt="140x140" src="http://lorempixel.com/140/140/" class="img-rounded" /> </a>
		-->
	</div>
</div>





<script>


	$("input[name=cad_prop]").click(function(){
		$("input[name=cad_prop]").click(function(){
			var nome= $("input[name=nome]").val();
			var rg= $("input[name=rg]").val();
			var cpf= $("input[name=cpf]").val();
			var nasc= $("input[name=nasc]").val().substr(0,4) + $("input[name=nasc]").val().substr(5,2) + $("input[name=nasc]").val().substr(8,2);
			console.log(nasc)
			
			$.ajax({
				type: "POST",
				data: {flag:0 ,nome:nome, rg:rg, cpf:cpf, nasc:nasc},
				url: "../logic/logic.php",
				datatype:"html",
				success: function(result,status){
					console.log(result);
					if(result == 1){ 	
						alert("Proprietário inserido com sucesso!");
						window.close("../containers/proprietario_2.php", "_blank", "height=345, width=650");
					}
					else{ 
						alert("Proprietário já existente!");
						$("input[name=nome]").val("");
						$("input[name=rg]").val("");
						$("input[name=cpf]").val("");
						$("input[name=nasc]").val("");
					}
				},
				complete: function(result){
					console.log(status);
					console.log("FINALIZADO!");
				}
			});
		});
	});
	
	function sleep(milliseconds) {
	  var start = new Date().getTime();
	  for (var i = 0; i < 1e7; i++) {
	    if ((new Date().getTime() - start) > milliseconds){
	      break;
	    }
	  }
	  alert("TEMPO!");

	};

	$("#load").hide();

	

	



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





