<?php
session_start();

include '../database/models.php';
include_once '../database/database.ini.php';

use ConexaoPHPPostgres\AutorModel as AutorModel;
try {
   
    $AutorModel = new AutorModel($pdo);
   
    $Nome = $_SESSION['Nome'];
   
    $Livros = $AutorModel->teste($Nome);
    // echo($Nome);

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
        <th>Codigo do livro </th>
        <th>Titulo </th>
    </tr>

     <?php foreach ($Livros as $Livro) : ?>
    <tr>
		<form action="../pages/Controllers/Autor.php" method="POST">
        
        <td><center><input type="text" name="Cod_livro" class="input-group-text" value="<?php echo htmlspecialchars($Livro['Cod_livro'])?>" readonly></center></td>

        <td><center><input type="text" name="Titulo" class="input-group-text" value="<?php echo htmlspecialchars($Livro['Titulo'])?>" readonly></center></td>
		
		</form>
    </tr>
    <?php endforeach; ?>

     <tr>
        <th>Selecione o autor</th>
    </tr>
        <form action="../pages/Controllers/Autor.php" method="POST">

        <td><center><select class="input-group-text" name="Nome_autor">
        <?php foreach ($Autores as $Autor) : ?>
		<option value="<?php echo ($Autor['Nome'])?>"><?php echo htmlspecialchars($Autor['Nome'])?></option>
		<?php endforeach; ?>
            
        <td><input class="btn btn-success" type="submit" name="submit" value="Procurar" style ="margin-right: 16px;"></td>  
        <?php
            
        ?>
        </form>
       
</table>
</div>
<!-- --------------------------------------------------------------------------------------------------- -->




<?php
include('../templates/footer.php');
?>
