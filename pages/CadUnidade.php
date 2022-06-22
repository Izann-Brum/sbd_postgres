<?php

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\UnidadeModel as Unidade;

try {
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

<style> table {background: #FFFFFF; box-shadow: 0px 16px 32px rgba(5, 18, 34, 0.08); border-radius: 24px;  font-family: arial, sans-serif;   border-collapse: collapse;   width: 100%; padding: 32px;}  
td, th {   border: 1.5px solid #dddddd;   text-align: center;   padding: 8px; } 
tr {   background-color: #ffffff; } </style>

<?php
if (isset($_GET['MSGERROR'])){
	echo '<h2 style="color:red"><center>'.$_GET['MSGERROR'].'</h2></center>';
}
if (isset($_GET['MSG'])){
	echo '<h2 style="color:green"><center>'.$_GET['MSG'].'</h2></center>';
}
?>

<table class="table">
    <tr>
        <th>Nova Unidade</th>
    </tr>
    <tr>
        <th>Nome</th>
        <th>Endereço</th>
        <th>Cadastrar</th>
    </tr>
	<form action="./Controllers/Unidade.php" method="POST">
	<tr>
        <td><center><input type="text" class="input-group-text" name="Nome_unidade" value="" placeholder="Nome da unidade" required></center></td>
        <td><center><input type="text" class="input-group-text" name="Endereco" value="" placeholder="Endereço da unidade" required></center></td>
        
        <td><input class="btn btn-primary" type="submit" name="submit" value="Cadastrar"></td>
    </tr>
	</form>
</table>

</div>
<?php
include('../templates/footer.php');
?>