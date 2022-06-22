<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;

$LivroModel = new LivroModel($pdo);


$Cod_livro_copias = null;
$Cod_unidade_copias = null;
$Quantidade = null;
$Nome_editora = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Cod_livro'])){
		header("Location: ../../pages/copiasLivro.php?MSGERROR=Campo titulo em branco");
		die();
	}elseif (empty($_POST['Cod_unidade'])){
		header("Location: ../../pages/copiasLivro.php?MSGERROR=Campo unidade em branco");
		die();
	}elseif (empty($_POST['Qt_copias']) || intval($_POST['Qt_copias']) < 1){
		header("Location: ../../pages/copiasLivro.php?MSGERROR=Campo quantidade está incorreto");
		die();
	}else {
		$Cod_livro_copias = $_POST['Cod_livro'];
		$Cod_unidade_copias = $_POST['Cod_unidade'];
		$Quantidade = $_POST['Qt_copias'];

		
		try {
			$LivroModel->insertInLivroCopias($Cod_livro_copias, $Cod_unidade_copias, $Quantidade);
			header("Location: ../../pages/copiasLivro.php?MSG=Cópias cadastradas com sucesso");	
		} catch (\PDOException $e) {
			echo $e->getMessage();
			// header("Location: ../../pages/copiasLivro.php?MSG=Erro ao Cadastrar Cópias");	
		}
        
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Qt_copias'])){
		header("Location: ../../pages/copiasLivro.php?MSGERROR=Campo Quantidade em Branco");
		die();
	}else {
		$Cod_livro_copias = $_POST['Cod_livro'];
		$Cod_unidade_copias = $_POST['Cod_unidade'];
		$Quantidade = $_POST['Qt_copias'];

		try {
			$LivroModel->updateCopias($Cod_livro_copias, $Cod_unidade_copias, $Quantidade);
			header("Location: ../../pages/copiasLivro.php?MSG=Alterado com Sucesso");
		} catch (\PDOException $e) {
			header("Location: ../../pages/copiasLivro.php?MSG=Erro ao Alterar Quantidade");
		}
        
	}
} elseif($_POST['submit']=='Deletar'){
	$Cod_livro_copias = $_POST['Cod_livro'];
	$Cod_unidade_copias = $_POST['Cod_unidade'];
	try {
		$LivroModel->ddeleteFromCopias($Cod_livro_copias, $Cod_unidade_copias);
		header("Location: ../../pages/copiasLivro.php?MSG=Deletado com Sucesso");	
	} catch (\PDOException $e) {
		header("Location: ../../pages/copiasLivro.php?MSG=Erro ao Deletar Cópias");	
	}
	
}
?>