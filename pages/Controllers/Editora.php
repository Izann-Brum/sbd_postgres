<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\EditoraModel as EditoraModel;

try {
	$EditoraModel = new EditoraModel($pdo);
} catch (\PDOException $e) {
	echo $e->getMessage();
}

$Nome = null;
$Endereco = null;
$Telefone = null;
$Cod_editora = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/pagess/editoracad.php?MSGERROR=Campo nome em branco");
		die();
	}elseif(empty($_POST['Telefone'])){
		header("Location: ../../pages/pagess/editoracad.php?MSGERROR=Campo telefone em branco");
		die();
	}else {
		$Nome_editora = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];

		try {
			$EditoraModel->insert($Nome_editora, $Endereco, $Telefone);
			header("Location: ../../pages/editorasCadastradas.php?MSG=" .$Nome_editora. " cadastrado com sucesso");	
		} catch (\PDOException $e) {
			$sr = serialize($e);

			$nome_key = "EDITORA_Nome_key";

			if (strpos($sr, $nome_key) !== false) {
				header("Location: ../../pages/pagess/editoracad.php?MSGERROR=Nome da editora indisponível");
			}else {
				header("Location: ../../pages/pagess/editoracad.php?MSGERROR=Erro não especificado");
			}	
		}
        
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/editorasCadastradas.php?MSGERROR=Campo nome em branco");
		die();
	} elseif (empty($_POST['Telefone'])){
		header("Location: ../../pages/editorasCadastradas.php?MSGERROR=Campo telefone em branco");
		die();
	} else {
		$Cod_editora = $_POST['Cod_editora'];
		$Nome = $_POST['Nome'];
		$Telefone = $_POST['Telefone'];
		$Endereco = $_POST['Endereco'];

		try {
			$EditoraModel->update($Cod_editora, $Nome, $Endereco, $Telefone);
			header("Location: ../../pages/editorasCadastradas.php?MSG=Alterado com Sucesso");	
		} catch (\PDOException $e) {
			$sr = serialize($e);

			$nome_key = "EDITORA_Nome_key";

			if (strpos($sr, $nome_key) !== false) {
				header("Location: ../../pages/CadEditora.php?MSGERROR=Nome de editora indisponível");
			}else {
				header("Location: ../../pages/CadEditora.php?MSGERROR=Erro não especificado");
			}
		}
        
	}
} elseif($_POST['submit']=='Deletar'){
	$Nome = $_POST['Cod_editora'];
	
	try {
		$EditoraModel->ddelete($Nome);	
		header("Location: ../../pages/editorasCadastradas.php?MSG=Deletado com Sucesso");
	} catch (\PDOException $e) {
		header("Location: ../../pages/editorasCadastradas.php?MSG=Erro ao Deletar Editora");
	}
	
}
?>