<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\EmprestimoModel as EmprestimoModel;

try {
    $EmprestimoModel = new EmprestimoModel($pdo);
    $Emprestimos = $EmprestimoModel->pegar_unidade_livro_aluno();

} catch (\PDOException $e) {
    echo $e->getMessage();
    header("Location: ../../pages/emprestimosPendentes.php?MSGERROR=Erro ao Acessar DB Emprestimos");
}

?>

<?php
include('../templates/header.php');
?>

<div id="bb1" style = "min-height: 100vh;">
<?php
if (isset($_GET['MSGERROR'])){
	echo '<h2 style="color:red"><center>'.$_GET['MSGERROR'].'</h2></center>';
}
if (isset($_GET['MSG'])){
	echo '<h2 style="color:green"><center>'.$_GET['MSG'].'</h2></center>';
}
?>

<style> table {background: #FFFFFF; box-shadow: 0px 16px 32px rgba(5, 18, 34, 0.08); border-radius: 24px;  font-family: arial, sans-serif;   border-collapse: collapse;   width: 100% !important; padding: 32px;}  
td, th {  border: 1.5px solid #dddddd;   text-align: center;   padding: 8px; } 
tr {   background-color: #ffffff; } </style>
<table class="table">
    <tr>
        <th>Empréstimos Pendentes</th>
    </tr>
    <tr>
        <th>Unidade</th>
        <th>Aluno</th>
        <th>Livro</th>
        <th>Data do Empréstimo</th>
        <th>Data de Devolução</th>
        <th>Comandos</th>
    </tr>
	
        <?php foreach ($Emprestimos as $Emprestimo) : ?>
	<tr>
        <form action="./Controllers/Emprestimo.php" method="POST">
        <td><center><input type="text" name="Nome_unidade" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Nome_unidade'])?>" readonly></center></td>
        <input type="hidden" name="Cod_unidade" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Cod_unidade'])?>">
        
        <td><center><input type="text" name="Nome" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Nome'])?>" readonly></center></td>
        <input type="hidden" name="Num_cartao" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Num_cartao'])?>"> 

        <td><center><input type="text" name="Titulo" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Titulo'])?>" readonly></center></td>
        <input type="hidden" name="Cod_livro" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Cod_livro'])?>">

        <td><center><input type="text" name="Data_emprestimo" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Data_emprestimo'])?>" readonly></center></td>
        <td><center><input type="text" name="Data_devolucao" class="input-group-text" value="<?php echo htmlspecialchars($Emprestimo['Data_devolucao'])?>" ></center></td>

        <td><input class="btn btn-danger" type="submit" name="submit" value="Devolver"></td>
        </form>
    </tr>
    <?php endforeach; ?>
	
</table>

</div>

<?php
include('../templates/footer.php');
?>