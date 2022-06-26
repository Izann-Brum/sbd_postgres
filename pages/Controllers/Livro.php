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
$Titulo = null;
$Nome_autor = null;
$Nome_editora = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Titulo'])){
		header("Location: ../../pages/CadLivro.php?MSGERROR=Campo título em branco");
		die();
	}elseif (empty($_POST['Nome_autor'])){
		header("Location: ../../pages/CadLivro.php?MSGERROR=Campo autor em branco");
		die();
	}elseif (empty($_POST['Nome_editora'])){
		header("Location: ../../pages/CadLivro.php?MSGERROR=Campo editora em branco");
		die();
	}else {
		$Titulo = $_POST['Titulo'];
		$Nome_autor = $_POST['Nome_autor'];
		$Nome_editora = $_POST['Nome_editora'];

		try {
			$LivroModel->insert($Titulo, $Nome_editora, $Nome_autor);
			header("Location: ../../pages/CadLivro.php?MSG=Cadastrado com sucesso");	
		} catch (\PDOException $e) {
			$sr = serialize($e);

			$nome_key = "LIVRO_Titulo_key";

			if (strpos($sr, $nome_key) !== false) {
				header("Location: ../../pages/CadLivro.php?MSGERROR=Titulo do livro indisponível");
			}else {
				header("Location: ../../pages/CadLivro.php?MSGERROR=Erro não especificado");
			}	
		}
        
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Cod_livro'])){
		header("Location: ../../pages/livrosCadastrados.php?MSGERROR=Campo codigo do livro em branco");
		die();
	} elseif (empty($_POST['Titulo'])){
		header("Location: ../../pages/livrosCadastrados.php?MSGERROR=Campo titulo em branco");
		die();
	}else {
		$Cod_livro = $_POST['Cod_livro'];
		$Titulo = $_POST['Titulo'];

		try {
			$LivroModel->update($Cod_livro, $Titulo);
			header("Location: ../../pages/livrosCadastrados.php?MSG=Alterado com sucesso");	
		} catch (\PDOException $e) {
			$sr = serialize($e);

			$nome_key = "LIVRO_Titulo_key";

			if (mb_strpos($sr, $nome_key) == true) {
				header("Location: ../../pages/livrosCadastrados.php?MSGERROR=Titulo do livro indisponível");
			}else {
				header("Location: ../../pages/livrosCadastrados.php?MSGERROR=Erro não especificado");
			}
		}
        
	}
} elseif($_POST['submit']=='Deletar'){
	$Cod_livro = $_POST['Cod_livro'];

	try {
		$LivroModel->ddelete($Cod_livro);
		header("Location: ../../pages/livrosCadastrados.php?MSG=Deletado com sucesso");	
	} catch (\PDOException $e) {
		header("Location: ../../pages/livrosCadastrados.php?MSG=Erro ao deletar livro");	
	}
	
}
?>