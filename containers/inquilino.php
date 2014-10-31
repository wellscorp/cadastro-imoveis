<script type="text/javascript" src="../js/cadastro.js" ></script>

<div align="center">
	<div  style="background-color:#E9E7E7;border-radius: 8px;box-shadow: 0 15px 20px rgba(0, 0, 0, .175); height: 350px;width:800px; border-style: double; ">
		<br>
		<div id="consulta">
			<br>					<!--action="../logic/upload.php"-->
			<form  action="../logic/upload.php" method="post" enctype="multipart/form-data" name="cadastro" >
							
				<br>
				<div class="form-group">
	                <label for="concept" align="right" class="col-sm-2 control-label">Nome</label>
	                <div class="col-sm-7">
	                    <input type="text" class="form-control" name="nome" align="left" style="width:100%; align:left" id="concept" name="concept">
	                </div>
	            </div>
	            <br>
	            <div class="form-group">
	                <label for="concept" align="right" class="col-sm-2 control-label">CPF</label>
	                <div class="col-sm-3">
	                    <input type="text" class="form-control" name="cpf" align="left" style="width:138%; align:left" id="concept" name="concept">
	                </div>
	            </div>
	            <br>
	            <div class="form-group">
	                <label for="concept" align="right" class="col-sm-2 control-label">Conjugue</label>
	                <div class="col-sm-7" align="left">
	                	<input type="text" class="form-control" name="conjugue" align="center" style="width:100%; align:center" id="concept" name="concept">
	                </div>
	            </div>
	            <br>
	            <div class="form-group">
	                <label for="concept" align="right" class="col-sm-2 control-label">Fiador</label>
	                <div class="col-sm-7" align="left">
	                	<input type="text" class="form-control" name="fiador" align="center" style="width:100%; align:center" id="concept" name="concept">
	                </div>
	            </div>
	            <br>
	            
	            

	            
	            <div class="form-group" style="width:755px" align="right">
		            <input type="button"   name="cad_iqui" id="cad_iqui" value="Cadastrar" align="center"  class="btn btn-primary btn-lg ">
				</div>
			</form>
		</div>
		<img src="..\img\loader.gif" id="load" style="width:40px" height="40px" />
		<!--
		<a href="#"><img alt="140x140" src="http://lorempixel.com/140/140/" class="img-rounded" /> </a>
		<a href="#"><img alt="140x140" src="http://lorempixel.com/140/140/" class="img-rounded" /> </a>
		-->
	</div>
</div>





<script>

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





