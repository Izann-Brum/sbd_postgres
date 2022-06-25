<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

use ConexaoPHPPostgres\UnidadeModel as Unidade;

try {
	$UnidadeModel = new Unidade($pdo);
} catch (\PDOException $e) {
	echo $e->getMessage();
}

$Cod_unidade = null;
$Nome_unidade = null;
$Endereco = null;

if ($_POST['submit']=='Cadastrar'){
	if (empty($_POST['Nome'])){
		header("Location: ../../pages/CadUnidade.php?MSGERROR=Nome em branco");
		die();
	}
	elseif (empty($_POST['Endereco'])) {
		header("Location: ../../pages/CadUnidade.php?MSGERROR=Cidade em branco");
		die();
	}else {
		$Nome_unidade = $_POST['Nome'];
        $Endereco = $_POST['Endereco'];
		try {
			$UnidadeModel->insert($Nome_unidade, $Endereco);
			header("Location: ../../pages/CadUnidade.php?MSG=Cadastrado com Sucesso");		
		} catch (\PDOException $e) {
			$sr = serialize($e);

			$nome_key = "UNIDADE_BIBLIOTECA_Nome_key";

			if (mb_strpos($sr, $nome_key) == true) {
				header("Location: ../../pages/CadUnidade.php?MSGERROR=Nome da unidade indisponível");
			}else {
				header("Location: ../../pages/CadUnidade.php?MSGERROR=Erro não especificado");
			}
		}
    
	}
} elseif($_POST['submit']=='Alterar'){
	if (empty($_POST['Nome_unidade'])){
		header("Location: ../../pages/unidadesCadastradas.php?MSGERROR=Campo nome em branco");
		die();
	}elseif (empty($_POST['Endereco'])) {
		header("Location: ../../pages/unidadesCadastradas.php?MSGERROR=Campo endereco em branco");
		die();	
	}else {
		$Nome_unidade = $_POST['Nome_unidade'];
        $Endereco = $_POST['Endereco'];
		$Cod_unidade = $_POST['Cod_unidade'];

		try {			
        	$UnidadeModel->update($Cod_unidade, $Nome_unidade, $Endereco);
			header("Location: ../../pages/unidadesCadastradas.php?MSG=Alterado com Sucesso");
		} catch (\PDOException $e) {
			$sr = serialize($e);

			$nome_key = "UNIDADE_BIBLIOTECA_Nome_key";

			if (mb_strpos($sr, $nome_key) == true) {
				header("Location: ../../pages/unidadesCadastradas.php?MSGERROR=Nome da unidade indisponível");
			}else {
				header("Location: ../../pages/unidadesCadastradas.php?MSGERROR=Erro não especificado");
			}
		}
	}
} elseif($_POST['submit']=='Deletar'){
	$Cod_unidade = $_POST['Cod_unidade'];
	$UnidadeModel->ddelete($Cod_unidade);
	header("Location: ../../pages/unidadesCadastradas.php?MSG=Deletado com Sucesso");
}