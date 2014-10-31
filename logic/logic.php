<?php

session_start();

require_once("../class/BD.class.php");
require_once("../class/BANCO.class.php");
$banco= new BANCOGMF();

date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL);

//if($_FILES['file']['name']) 	$flag= '1';
//else 	$flag= $_POST['flag'];

if(isset($_POST['x']))		$_SESSION['x']= $_POST['x'];
if(isset($_POST['y']))		$_SESSION['y']= $_POST['y'];

switch($_POST['flag']){
	// INSERIR PROPRIETARIO
	case '0':	
		$nome= $_POST['nome'];
		$cpf= $_POST['cpf'];	
		$rg= $_POST['rg'];
		$nasc= $_POST['nasc'];

		$query= $banco->insertProprietario($cpf, $nome, $rg, $nasc);
		echo json_encode($query);	// VERIFICAR SE ESTAR VAZIO (SEM ERRO) OU TEM VALOR (COM ERRO)
	break;

	// INSERIR INQUILINO
	case '1':		
		$nome= $_POST['nome'];
		$cpf= $_POST['cpf'];
		$conjugue= $_POST['conjugue'];
		$fiador= $_POST['fiador'];
		$rg= $_POST['rg'];
		$dt_nasc= $_POST['dt_nasc'];

		$query= $banco->insertInquilino($cpf, $nome, $fiador, $conjugue,$rg,$dt_nasc);
		echo json_encode($query);	// VERIFICAR SE ESTAR VAZIO (SEM ERRO) OU TEM VALOR (COM ERRO)
	break;

	// INSERIR IMOVEL
	case '2':

		$descri= $_SESSION['descri'];
		$end= $_SESSION['end'];
		$num= $_SESSION['num'];
		$cid= $_SESSION['cid'];
		$bai= $_SESSION['bai'];
		$dt_ini= substr($_SESSION['dt_ini'],0,4) . substr($_SESSION['dt_ini'],5,2) . substr($_SESSION['dt_ini'],8,2);
		$dt_fim= substr($_SESSION['dt_fim'],0,4) . substr($_SESSION['dt_fim'],5,2) . substr($_SESSION['dt_fim'],8,2);
		$cep= $_SESSION['cep'];
		if($_SESSION['x']!='')		$x= $_SESSION['x'];
		else 	$x=0;
		if($_SESSION['y']!='')		$y= $_SESSION['y'];
		else 	$y=0;
		$link= $_SESSION['CONTRATO'];
		$img= $_SESSION['IMG'];
		// CASO NÃO HAJA CODIGO FAZER A SELEÇÃO DO ULTIMO INSERIDO NO BANDO
		if($_SESSION['prop'] !='')		$cod_prop= $_SESSION['prop'];
		else 	$cod_prop= "(SELECT MAX(ID_PROPRIETARIO) ID_PROPRIETARIO FROM PROPRIETARIO)";
		if($_SESSION['inq'] != '')		$cod_iqui= $_SESSION['inq'];
		else 	$cod_iqui= "(SELECT MAX(ID_INQUILINO) ID_INQUILINO FROM INQUILINO)";

		$query= $banco->insertImovel($end,$bai,$cid,$cep,$x,$y,$descri, $dt_ini, $dt_fim, $cod_prop, $cod_iqui,$link);
		foreach ($img as $key => $value) {
			$query_2= $banco->insertLink($img[$key]);
		}
		echo json_encode($query);	// VERIFICAR SE ESTAR VAZIO (SEM ERRO) OU TEM VALOR (COM ERRO)
	break;

		
	
	case '3':

		$user= $_POST['user'];
		$_SESSION['USER']= $user;
		$senha= md5($_POST['senha']);

		$query_2= $banco->conferirUser($user,$senha);
		if(empty($query_2) ){
			$_SESSION['USUARIO']=1;
			echo json_encode(1);					// NENHUM USUARIO ENCONTRADO			
		}
		else{ 	
			$_SESSION['USUARIO']=0;
			echo json_encode(0);					// JÁ EXISTE USUARIO!!			
		}
	break;

	// ALTERAR SENHA!
	case '4':

		$senha_atual= md5($_POST['senha_atual']);
		$senha_nova= md5($_POST['senha_nova']);
		$user= $_SESSION['USER'];		// CRIAR SESSAO PARA LOGIN DO USUARIO

		$query= $banco->alterarSenha($user,$senha_atual,$senha_nova);
		if( $query=="" )	echo json_encode(1);		//CASO TENHA FEITO A ALTERAÇÃO
		else 		echo json_encode(0);				//CASO DE ERRO
	break;

	// CRIAR USUARIO!
	case '5':
		$user= $_POST['user'];
		$senha= md5($_POST['senha']);
		$query_2= $banco->conferirUser($user,'');
		if(!empty($query_2) )	echo json_encode(0);	// USUARIO JÁ EXISTE 
		else{ 	
			$query_2= $banco->inserirUser($user,$senha);
			echo json_encode(1);						// USUARIO INSERIDO
		}
	break;	

	// PESQUISAR IMOVEIS
	case '6':
		$descri= $_POST['descri'];
		$end= $_POST['end'];
		$bai= $_POST['bai'];
		$dt_ini= $_POST['dt_ini'];
		$dt_fim= $_POST['dt_fim'];
		$dt_v_ini= $_POST['dt_v_ini'];
		$dt_v_fim= $_POST['dt_v_fim'];
		$cod_prop= $_POST['cod_prop'];
		$cod_inq= $_POST['cod_inq'];

		$query= $banco->selectImovel($descri,$end,$bai,$dt_ini,$dt_fim, $dt_v_ini,$dt_v_fim,$cod_prop,$cod_inq);
		
		foreach ($query as $key => $value) {			
			$query_2= $banco->selectProp($query[$key]['ID_PROPRIETARIO']);
			$query_3= $banco->selectInq($query[$key]['ID_INQUILINO']);
			foreach ($query_2 as $key2 => $value2) {
				$query[$key]['PROPRIETARIO'] = $query_2[$key2]['NOME'];
			}
			foreach ($query_3 as $key3 => $value3) {
				$query[$key]['INQUILINO'] = $query_3[$key3]['NOME'];
			}
		}
		
		echo json_encode($query);
	break;

	// PESQUISAR PESSOAS
	case '7':
		$nome= $_POST['nome'];
		$cpf= $_POST['cpf'];
		// INQUILINO = 1 ; PROPRIETARIO = 2
		$tipo= $_POST['tipo'];	

		$query= $banco->selectPessoa($nome,$cpf,$tipo);
		echo json_encode($query);
	break;

	// OBTER INFORMAÇÕES DETALHADAS DE IMOVEIS
	case '8':
		$cod_imovel= $_POST['cod_imovel'];

		$query= $banco->selectDetalheImovel($cod_imovel);
		echo json_encode($query);
	break;
}

?>