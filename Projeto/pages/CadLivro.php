<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\LivroModel as LivroModel;
use ConexaoPHPPostgres\EditoraModel as EditoraModel;
use ConexaoPHPPostgres\AutorModel as AutorModel;
try {
    $LivroModel = new LivroModel($pdo);
    $Livros = $LivroModel->all();
	
	$EditoraModel = new EditoraModel($pdo);
    $Editoras = $EditoraModel->all();

    $AutorModel = new AutorModel($pdo);
    $Autores = $AutorModel->all();
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
        <th>Novo Livro</th>
    </tr>
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Editora</th>
        <th>Cadastrar</th>
    </tr>
	<form action="./Controllers/Livro.php" method="POST">
	<tr>
        <td><center><input type="text" name="Titulo" value="" placeholder="Titulo do livro" class="input-group-text" required></center></td>
        
        <td><center><select class="input-group-text" name="Nome_autor">
        <?php foreach ($Autores as $Autor) : ?>
		<option value="<?php echo ($Autor['Nome'])?>"><?php echo htmlspecialchars($Autor['Nome'])?></option>
		<?php endforeach; ?>

        <td><center><select class="input-group-text" name="Nome_editora">
		<?php foreach ($Editoras as $Editora) : ?>
		<option value="<?php echo ($Editora['Nome'])?>"><?php echo htmlspecialchars($Editora['Nome'])?></option>
		<?php endforeach; ?>

		</select></center></td>
        <td><input class="btn btn-primary" type="submit" name="submit" value="Cadastrar"></td>
    </tr>
	</form>
</table>

</div>

<?php
include('../templates/footer.php');
?>