<?php

require_once("BD.class.php");
//require("phpmailer/class.phpmailer.php");

ini_set("smtp_port","465");
ini_set('max_execution_time', 120);

class BANCOUSER extends BD{

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


	public function existeUser($user,$senha){

		$comando="SELECT * FROM USUARIO WHERE ";
		if($user != '' && $senha != '')		$comando= $comando . " NOME LIKE '".$user."' AND SENHA  LIKE '".$senha."' ;";
		else{
			if($user != '')		$comando= $comando . " NOME LIKE '".$user."'  ;";
			else{
				if($senha != '')		$comando= $comando . " SENHA LIKE '".$senha."'  ;";
			}
		}
		$result= odbc_exec($this->connect, $comando);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		// CASO JÁ EXISTA USUARIO RETORNA 1; CASO NÃO EXISTA RETORNA 0
		if(count($rows) > 0) 	return 1; 
		else 	return 0;
	}

	public function insertUser($user,$senha){

		$comando="INSERT INTO USUARIO (NOME,SENHA) VALUES ('".$user."', '".$senha."'); "
		$result= odbc_exec($this->connect, $codSQL);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}

	

	public function updateUser($user,$senha){

		$result= odbc_exec($this->connect, $codSQL);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}

	public function updateSenha($user,$senha_nova){

		$result= odbc_exec($this->connect, $codSQL);
		while($rows[]= odbc_fetch_array($result));		unset($rows[count($rows)-1]);
		odbc_free_result($result);

		return $rows;
	}

	
	
}



?>