<?php
echo ' 1a ';
include '../../database/models.php';
include_once '../../database/database.ini.php';
date_default_timezone_set('America/Sao_Paulo');

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\EmprestimoModel as EmprestimoModel;

try {
	$EmprestimoModel = new EmprestimoModel($pdo);
	$CopiasModel = new LivroModel($pdo);

	$Emprestimo = $EmprestimoModel->all();
	echo ' 2  ';

} catch (\PDOException $e) {
	echo ' 2.1 ';
	echo $e->getMessage();
}

$Data_emprestimo = null;
$Data_devolucao = null;
$Cod_unidade = null;
$Cod_livro = null;
$Numero_cartao = null;
$Copias = null;
$Cod_unidade_integer = null;
$Cod_livro_integer = null;
$resultado = null;
$qt_Dias = null;
echo ' 3 ';

if ($_POST['submit']=='INSERIR'){
	if (empty($_POST['Cod_livro'])){
		header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Livro em branco!");
		die();
	} elseif (empty($_POST['Cod_unidade'])) {
		header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Unidade em branco!");
		die();
	} elseif (empty($_POST['Num_cartao'])) {
		header("Location: ../../pages/novoEmprestimo.php?MSGERROR=Aluno em branco!");
		die();
	} else {
		$Numero_cartao = $_POST['Num_cartao'];
		$Cod_livro = $_POST['Cod_livro'];
		$Cod_unidade = $_POST['Cod_unidade'];

		$Data_emprestimo = date('Y/m/d');
		
		$qt_Dias = intval($_POST['qt_dias']);
		
		$resultado = date('Y/m/d', strtotime("+{$qt_Dias} days",strtotime($Data_emprestimo)));
		
        	$Data_devolucao = date('d/m/Y', strtotime($resultado));
		$Data_emprestimo = date('d/m/Y', strtotime($Data_emprestimo));
		
		echo ' 4 ';
				
		try {
			echo '  4.1  ';
			$Copias = $CopiasModel->QuantidadeCopias($Cod_unidade, $Cod_livro);
			echo '  4.2  ';
			
			if ($Copias > 0) {
			try {
        		$EmprestimoModel->insert($Cod_livro, $Cod_unidade, $Numero_cartao, $Data_emprestimo, $Data_devolucao);
			
			    $EmprestimoModel->diminuirCopias($Cod_livro, $Cod_unidade);

				header("Location: ../../pages/emprestimosPendentes.php?MSG=Livro emprestado com sucesso!");
			} catch (\PDOException $e) {
				$sr = serialize($e);

				$nome_key = '"LIVRO_EMPRESTIMO_pk"';

				if (strpos($sr, $nome_key) !== false) {
					header("Location: ../../pages/pagess/novoEmprestimo.php?MSGERROR=Usário já possuí título");
				}else {
					header("Location: ../../pages/pagess/novoEmprestimo.php?MSGERROR=Erro não especificado");
				}
				}	
			}else{
				header("Location: ../../pages/pagess/novoEmprestimo.php?MSGERROR=Livro indisponível nesta unidade");
				die();
			}
		}catch (\PDOException $e) {
			header("Location: ../../pages/pagess/novoEmprestimo.php?MSGERROR=Erro nao especificado");
		}	

		
	}

} elseif($_POST['submit']=='Devolver'){
	$Numero_cartao = $_POST['Num_cartao'];
	$Cod_livro = $_POST['Cod_livro'];
	$Cod_unidade = $_POST['Cod_unidade'];
	
	try {
		$EmprestimoModel->ddelete($Numero_cartao, $Cod_livro, $Cod_unidade);
		$EmprestimoModel->aumentarCopias($Cod_livro, $Cod_unidade);
		header("Location: ../../pages/emprestimosPendentes.php?MSG=Devolvido com sucesso!");
	} catch (\PDOException $e) {
		header("Location: ../../pages/emprestimosPendentes.php?MSGERROR=Erro ao deletar empréstimo");
	}
	
}
?>
