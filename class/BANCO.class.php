<?php

require_once("BD.class.php");
//require("phpmailer/class.phpmailer.php");

ini_set("smtp_port","465");
ini_set('max_execution_time', 120);

class BANCOGMF extends BD{

	public function getRows($codSQL){

		$result= odbc_exec($this->connect, $codSQL);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}

	// FAZ O TRATAMENTO SE HA COMANDO DE SQL NO CODIGO, RETORNA 1 PRA SIM E 0 PRA NÃO
	public function Tratamento($string){
		if($string == 'delete' || $string == 'select' || $string == 'update' || $string == 'insert' || $string == 'alter' || $string == 'table'){
			return 1;
		}else return 0;
	}

	//	---------------------- INSERTS -------------------------------------------

	public function insertProprietario($cpf, $nome, $rg, $dt_nasc){

		$query= "SELECT * FROM PROPRIETARIO WHERE CPF LIKE '".$cpf."'' ";
		$result_query= odbc_exec($this->connect, $query);
		while($rows[]= odbc_fetch_array($result_query));		unset($rows[count($rows)-1]);
		odbc_free_result($result_query);

		if(count($rows) > 0) return 0;
		else{
			$comando= "INSERT INTO PROPRIETARIO (CPF,NOME,RG,DATA_NASCIMENTO,CADASTRO)
							VALUES (".$cpf.",'".$nome."', ".$rg.", ".$dt_nasc.",".date('Y').date('m').date('d').")";
			$result= odbc_exec($this->connect, $comando);			

			//return odbc_error($result);
			return 1;
		}
	}

	public function insertInquilino($cpf, $nome, $fiador, $conjugue, $rg, $dt_nasc){


		$query= "SELECT * FROM INQUILINO WHERE CPF= ".$cpf." ";
		$result_query= odbc_exec($this->connect, $query);
		while($rows[]= odbc_fetch_array($result_query));		unset($rows[count($rows)-1]);
		odbc_free_result($result_query);

		if(count($rows) > 0) return 0;
		else{
			$comando= "INSERT INTO INQUILINO (NOME,CPF,FIADOR,CONJUGUE, RG, DATA_NASC, CADASTRO)
							VALUES ('".$nome."',".$cpf.",'".$fiador."','".$conjugue."', ".$rg.", ".$dt_nasc.",".date('Y').date('m').date('d').")";
			$result= odbc_exec($this->connect, $comando);
			//while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
			//odbc_free_result($result);

			//return $rows;
			return 1;
		}
	}

	public function insertImovel($end,$bai,$cid,$cep,$x,$y,$descri, $dt_inicio, $dt_fim, $cod_prop, $cod_iqui, $link){

		$data= date('Y').date('m').date('d');
		$comando= "INSERT INTO IMOVEL (DESCRICAO,ENDERECO,BAIRRO,CIDADE,CEP,CORDENADA_X,CORDENADA_Y,OBSERVACAO,ID_PROPRIETARIO,ID_INQUILINO, DATA, CONTRATO_INICIO, CONTRATO_FIM, LINK_CONTRATO)
				VALUES ('".$descri."','".$end."', '".$bai."', '".$cid."', ".$cep.",".$x.",".$y.",' ', ".$cod_prop.",".$cod_iqui.", ".$data.", ".$dt_inicio.", ".$dt_fim.", '".$link."') ";

		$result= odbc_exec($this->connect, $comando);
		//while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		//odbc_free_result($result);

		//return $comando;
		return odbc_error($result);
	}


	public function insertLink($link){

		$comando= "INSERT INTO LINK (DESCRICAO,ID_IMOVEL)
					VALUES ('".$link."', (SELECT MAX(ID_IMOVEL) ID_IMOVEL FROM IMOVEL)) ";

		$result= odbc_exec($this->connect, $comando);
		//while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		//odbc_free_result($result);

		//return $rows;
		return odbc_error($result);
	}

	// ----------------- SELECTS -------------------------------------

	public function selectImovel($descri,$end,$bai,$dt_de,$dt_ate, $dt_v_de,$dt_v_ate, $cod_prop, $cod_inq){

		$comando= "SELECT * FROM IMOVEL";
		if($descri!='' || $end!='' || $bai!='' || $dt_de!='' || $dt_v_de!='' || $cod_prop!='' || $cod_inq!=''){ 
			$comando= $comando. ' WHERE ';
			if($descri!='') $comando= $comando . " DESCRICAO LIKE '".$descri."' ";
			if($end!='') $comando= $comando . " ENDERECO LIKE '".$end."' ";
			if($bai!='') $comando= $comando . " BAIRRO LIKE '".$bai."' ";
			if($dt_de!='') $comando= $comando . " DATA BETWEEN ".$dt_de." and ".$dt_ate." ";
			if($dt_v_de!='') $comando= $comando . " CONTRATO_FIM BETWEEN ".$dt_v_de." and ".$dt_v_ate." ";
			if($cod_prop!='') $comando= $comando . " ID_PROPRIETARIO LIKE '".$cod_prop."' ";
			if($cod_inq!='') $comando= $comando . " ID_INQUILINO LIKE '".$cod_inq."' ";
		}

		$result= odbc_exec($this->connect, $comando);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}

	public function selectDetalheImovel($cod_imovel){

		$comando= "SELECT * FROM IMOVEL WHERE ID_IMOVEL = ".$cod_imovel." ";

		$result= odbc_exec($this->connect, $comando);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}

	public function selectPessoa($nome,$cpf,$tipo){

		if($tipo == 1)	$comando= "SELECT * FROM INQUILINO";
		if($tipo == 2)	$comando= "SELECT * FROM PROPRIETARIO";

		if($nome!='' || $cpf!='' ){ 
			$comando= $comando. ' WHERE ';
			if($nome!='') $comando= $comando . " NOME LIKE '".$nome."' ";
			if($cpf!='') $comando= $comando . " CPF LIKE '".$cpf."' ";
		}

		$result= odbc_exec($this->connect, $comando);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}


	public function selectProp($cod){

		$comando= "SELECT * FROM PROPRIETARIO WHERE ID_PROPRIETARIO = ".$cod." ";


		$result= odbc_exec($this->connect, $comando);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}


	public function selectInq($cod){

		$comando= "SELECT * FROM INQUILINO WHERE ID_INQUILINO = ".$cod." ";


		$result= odbc_exec($this->connect, $comando);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}

	//	---------------- UPDATES ---------------------------------------------


	public function updateImovel($id,$end,$bai,$cid,$cep,$x,$y,$descri){

		if($end != '')		$comando= "UPDATE IMOVEL SET ENDERECO = '".$end."' WHERE ID_IMOVEL = ".$id." ";
		if($bai != '')		$comando= "UPDATE IMOVEL SET BAIRRO = '".$bai."' WHERE ID_IMOVEL = ".$id." ";
		if($cid != '')		$comando= "UPDATE IMOVEL SET CIDADE = '".$cid."' WHERE ID_IMOVEL = ".$id." ";
		if($cep != '')		$comando= "UPDATE IMOVEL SET CEP = '".$cep."' WHERE ID_IMOVEL = ".$id." ";
		if($desc != '')		$comando= "UPDATE IMOVEL SET DESCRICAO = '".$descri."' WHERE ID_IMOVEL = ".$id." ";
		if($y != '' || $x != '')		$comando= "UPDATE IMOVEL SET CORDENADA_Y = '".$y."' , CORDENADA_X = '".$x."'  WHERE ID_IMOVEL = ".$id." ";

		$result= odbc_exec($this->connect, $comando);
		//while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		//odbc_free_result($result);

		//return $rows;
		return odbc_error($result);
	}

	public function updatePessoa($id,$tipo,$nome,$cpf,$rg,$nasc){

		if($tipo == 1){	
			if($nome != '')		$comando= "UPDATE INQUILINO SET NOME = '".$nome."' WHERE ID_INQUILINO = ".$id." ";
			if($cpf != '')		$comando= "UPDATE INQUILINO SET CPF = '".$cpf."' WHERE ID_INQUILINO = ".$id." ";
			if($rg != '')		$comando= "UPDATE INQUILINO SET RG = '".$rg."' WHERE ID_INQUILINO = ".$id." ";
			if($nasc != '')		$comando= "UPDATE INQUILINO SET DATA_NASCIMENTO = '".$nasc."' WHERE ID_INQUILINO = ".$id." ";
		}
		if($tipo == 2){	
			if($nome != '')		$comando= "UPDATE PROPRIETARIO SET NOME = '".$nome."' WHERE ID_PROPRIETARIO = ".$id." ";
			if($cpf != '')		$comando= "UPDATE PROPRIETARIO SET CPF = '".$cpf."' WHERE ID_PROPRIETARIO = ".$id." ";
			if($rg != '')		$comando= "UPDATE PROPRIETARIO SET RG = '".$rg."' WHERE ID_PROPRIETARIO = ".$id." ";
			if($nasc != '')		$comando= "UPDATE PROPRIETARIO SET DATA_NASCIMENTO = '".$nasc."' WHERE ID_PROPRIETARIO = ".$id." ";
		}

		$result= odbc_exec($this->connect, $comando);
		//while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		//odbc_free_result($result);

		//return $rows;
		return odbc_error($result);
	}

	// ---------------------------- DELETEs -----------------------------------------------

	public function deleteImovel($id){

		$comando= "DELETE FROM IMOVEL WHERE ID_IMOVEL = ".$id." ";
		$result= odbc_exec($this->connect, $comando);
		//while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		//odbc_free_result($result);

		//return $rows;
		return odbc_error($result);
	}

	public function deletePessoa($id,$tipo){

		if($tipo == 1)		$comando= "DELETE FROM INQUILINO WHERE ID_INQUILINO = ".$id." ";
		if($tipo == 2)		$comando= "DELETE FROM PROPRIETARIO WHERE ID_PROPRIETARIO = ".$id." ";
		$result= odbc_exec($this->connect, $comando);
		//while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		//odbc_free_result($result);

		//return $rows;
		return odbc_error($result);
	}
	
}



?>