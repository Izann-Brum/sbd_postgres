<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\CadastroUsuarioModel as UsuarioModel;

try {
	$UsuarioModel = new UsuarioModel($pdo);	
} catch (\PDOException $e) {
	echo $e->getMessage();
}


$Nome_usuario = null;
$Endereco = null;
$Telefone = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/CadUsuario.php?MSGERROR=Nome em branco");
		die();
	}elseif(empty($_POST['Telefone'])){
		header("Location: ../../pages/CadUsuario.php?MSGERROR=Telefone em branco");
		die();
	}else {
		$Nome_usuario = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];

		try {
			
			$UsuarioModel->insert($Nome_usuario, $Endereco, $Telefone);
			header("Location: ../../pages/CadUsuario.php?MSG= Usuário ".$Nome_usuario." cadastrado com sucesso");
		} catch (\PDOException $e) {

			$sr = serialize($e);

			$nome_key = "USUARIO_Nome_key";
			$telefone_key = "USUARIO_Telefone_key";

			if (strpos($sr, $nome_key) !== false) {
				header("Location: ../../pages/CadUsuario.php?MSGERROR=Nome de usuário indisponível");
			}elseif (strpos($sr, $nome_key) !== false) {
				header("Location: ../../pages/CadUsuario.php?MSGERROR=Telefone de usuário indisponível");
			}
			else {
				header("Location: ../../pages/CadUsuario.php?MSGERROR=Erro não especificado");
			}
		
		}
        
		
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/usuariosCadastrados.php?MSGERROR=Nome em Branco");
		die();
	} elseif (empty($_POST['Telefone'])){
		header("Location: ../../pages/usuariosCadastrados.php?MSGERROR=Data de Nascimento em Branco");
		die();
	} else {
		$Numero_cartao = $_POST['Num_cartao'];
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];

		try {
			$UsuarioModel->update($Numero_cartao, $Nome, $Endereco, $Telefone);
			header("Location: ../../pages/usuariosCadastrados.php?MSG=Alterado com Sucesso");
		} catch (\PDOException $e) {
			$sr = serialize($e);

			$nome_key = "USUARIO_Nome_key";
			$telefone_key = "USUARIO_Telefone_key";

			if (mb_strpos($sr, $nome_key) == true) {
				header("Location: ../../pages/CadUsuario.php?MSGERROR=Nome de usuário indisponível");
			}elseif (mb_strpos($sr, $telefone_key) == true) {
				header("Location: ../../pages/CadUsuario.php?MSGERROR=Telefone de usuário indisponível");
			}
			else {
				header("Location: ../../pages/CadUsuario.php?MSGERROR=Erro não especificado");
			}
		}
        
	}
} elseif($_POST['submit']=='Deletar'){
	$Numero_cartao = $_POST['Num_cartao'];

	try {
		$UsuarioModel->ddelete($Numero_cartao);
		header("Location: ../../pages/usuariosCadastrados.php?MSG=Deletado com Sucesso");	
	} catch (\PDOException $e) {
		header("Location: ../../pages/usuariosCadastrados.php?MSG=Erro ao Deletar Usuário");	
	}
	
}
?>

<!--// FUNÇÃO BOA PARA COMPARAR DUAS STRINGS
	// if (str_contains('Olá mundo', 'Ola')) {
	// 	echo 'true';
	// }else {
	// 	echo 'false';
	// } -->