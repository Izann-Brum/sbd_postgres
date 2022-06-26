<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\AutorModel as AutorModel;

try {
	$AutorModel = new AutorModel($pdo);
	$LivroModel = new LivroModel($pdo);
} catch (\PDOException $e) {
	echo $e->getMessage();
}

$Cod_livro = null;
$Nome_autor = null;
$Nome = null;


if ($_POST['submit']=='Cadastrar'){

	if (empty($_POST['Nome'])){
		header("Location: ../../pages/pagess/autorcad.php?MSGERROR=Campo nome em branco");
		die();
	} else {
		$Nome_autor = $_POST['Nome'];
		
		try {
			$AutorModel->insert($Nome_autor);
			header("Location: ../../pages/CadAutor.php?MSG=".$Nome_autor. " cadastrado com sucesso");	
		} catch (\PDOException $e) {
			$sr = serialize($e);

			$nome_key = "LIVRO_AUTOR_Nome_unique";

			if (strpos($sr, $nome_key) !== false) {
				header("Location: ../../pages/pagess/autorcad.php?MSGERROR=Nome do autor indisponível");
			}else {
				header("Location: ../../pages/pagess/autorcad.php?MSGERROR=Erro não especificado");
			}	
		}
        
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/CadAutor.php?MSGERROR=Nome em Branco");
		die();
	} else {
		$Cod_autor = $_POST['Cod_autor'];
		$Nome_autor = $_POST['Nome'];
		try {
			$AutorModel->update($Cod_autor, $Nome_autor);
			header("Location: ../../pages/CadAutor.php?MSG=Alterado com sucesso");	
		} catch (\PDOException $e) {
			header("Location: ../../pages/CadAutor.php?MSGERROR=Não foi possível Alterar");	
		}
        
	}
} elseif($_POST['submit']=='Deletar'){
	$Cod_autor = $_POST['Cod_autor'];
	try {
	$AutorModel->ddelete($Cod_autor);
	header("Location: ../../pages/CadAutor.php?MSG=Deletado com sucesso");	
	} catch (\PDOException $e) {
		header("Location: ../../pages/CadAutor.php?MSGERROR=Não foi possível deletar");	
	}
	
}elseif($_POST['submit']=='Procurar'){
	session_start();
	$Nome = $_POST['Nome_autor'];
	$_SESSION['Nome']  = $Nome;
	try {
	 header("Location: ../../pages/teste.php?MSG=Livros do autor ". $Nome. "");	
	} catch (\PDOException $e) {
		$e->getMessage();
		header("Location: ../../pages/CadAutor.php?MSGERROR= erro: ". $e);	
	}
	
}
?>

<!-- MSG=Livros do autor ". $Nome. " -->