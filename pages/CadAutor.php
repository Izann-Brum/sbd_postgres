<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\AutorModel as AutorModel;
try {
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
        <th>Autores cadastrados</th>
    </tr>
     <tr>
        <th>Nome</th>
        <th>Comandos</th>
    </tr>
     <?php foreach ($Autores as $Autor) : ?>
    <tr>
		<form action="../pages/Controllers/Autor.php" method="POST">
        
        <td><center><input type="text" name="Nome" class="input-group-text" value="<?php echo htmlspecialchars($Autor['Nome'])?>" ></center></td>
        <input type="hidden" name="Cod_autor" class="input-group-text" value="<?php echo htmlspecialchars($Autor['Cod_autor'])?>">

        <td><input class="btn btn-success" type="submit" name="submit" value="Alterar" style ="margin-right: 16px;"><input class="btn btn-danger" type="submit" name="submit" value="Deletar"></td>
		</form>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<?php
include('../templates/footer.php');
?>
