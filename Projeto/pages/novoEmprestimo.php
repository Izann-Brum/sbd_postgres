<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\CadastroUsuarioModel as UsuarioModel;
use ConexaoPHPPostgres\UnidadeModel as Unidade;

try {
    $LivroModel = new LivroModel($pdo);
    $Livros = $LivroModel->all();
    $Books = $LivroModel->getLivroAutor();
	
	$UsuarioModel = new UsuarioModel($pdo);
    $Usuarios = $UsuarioModel->all();

    $UnidadeModel = new Unidade($pdo);
    $Unidades = $UnidadeModel->all();

} catch (\PDOException $e) {
    echo $e->getMessage();
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

<style> table {background: #FFFFFF; box-shadow: 0px 16px 32px rgba(5, 18, 34, 0.08); border-radius: 24px;  font-family: arial, sans-serif;   border-collapse: collapse;   width: 100%; padding: 32px;}  
td, th {   border: 1.5px solid #dddddd;   text-align: center;   padding: 8px; } 
tr {   background-color: #ffffff; } </style>
<table class="table">
    <tr>
        <th>Novo Empréstimo</th>
    </tr>
    <tr>
        <th>Aluno</th>
        <th>Livro</th>
        <th>Unidade</th>
        <th>Total em dias</th>
        <th>Adicionar</th>
    </tr>
	<form action="./Controllers/Emprestimo.php" method="POST">
	<tr>
        <td><center><select class="input-group-text" required name="Num_cartao">
		<?php foreach ($Usuarios as $Usuario) : ?>
		<option value="<?php echo ($Usuario['Num_cartao'])?>"><?php echo htmlspecialchars($Usuario['Nome'])?></option>
		<?php endforeach; ?>
		</select></center></td>

        <td><center><select class="input-group-text" required name="Cod_livro">
		<?php foreach ($Books as $Book) : ?>
		<option value="<?php echo ($Book['Cod_livro'])?>"><?php echo htmlspecialchars($Book['Titulo'])?></option>
		<?php endforeach; ?>
		</select></center></td>

        <td><center><select class="input-group-text" required name="Cod_unidade">
		<?php foreach ($Unidades as $Unidade) : ?>
		<option value="<?php echo ($Unidade['Cod_unidade'])?>"><?php echo htmlspecialchars($Unidade['Nome'])?></option>
		<?php endforeach; ?>
		</select></center></td>
        
        <td><center><input type="number" name="qt_dias" value="" class="input-group-text" required></center></td>

        <td><input class="btn btn-primary" type="submit" name="submit" value="INSERIR"></td>
    </tr>
	</form>
</table>

</div>

<?php
include('../templates/footer.php');
?>