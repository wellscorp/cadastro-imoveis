<?php
 class BD{

	var $connect = null;
	
	//var $instancia = 'SRV-REI\SQLEXPRESS'; // 10.51.0.250\SQL2005
	var $instancia = 'WELL\SQLEXPRESS';  //NUTRISRV02
	var $user = 'sa';
	var $password = 'sa'; //senha
	
	var $bdnutri = 'MA_IMOBILIARIA'; //S8_Real
	
	public function __construct() 
    { 
		$this->connect = $this->getConnNUTRI();
    }  

	public function getConnNUTRI(){
	
		if(is_null($this->connect)){
			$this->connect = odbc_connect('DRIVER={SQL Server};SERVER='.$this->instancia.';DATABASE='.$this->bdnutri, $this->user, $this->password);
		}
		return $this->connect;
	}
	
	public function __destruct() 
    { 
		odbc_close($this->connect);
    } 
}
 

 
?>