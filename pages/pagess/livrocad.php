<?php
include '../../database/models.php';
include_once '../../database/database.ini.php';

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
include('../../templates/header.php');
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="CADASTRO UNIDADE">
    <meta name="description" content="">
    <title>teste</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="teste.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.12.21, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": ""
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="teste">
    <meta property="og:type" content="website">
    <style>
    .container {
      max-width: 350px;
      margin: 50px auto;
      text-align: center;
    }
    input[type="submit"] {
      margin-bottom: 20px;
    }
    .select-block {
      width: 300px;
      margin: 110px auto 30px;
      position: relative;
    }
    select {
      width: 100%;
      height: 50px;
      font-size: 100%;
      font-weight: bold;
      cursor: pointer;
      border-radius: 0;
      background-color: #1A33FF;
      border: none;
      border: 2px solid #1A33FF;
      border-radius: 4px;
      color: white;
      appearance: none;
      padding: 8px 38px 10px 18px;
      -webkit-appearance: none;
      -moz-appearance: none;
      transition: color 0.3s ease, background-color 0.3s ease, border-bottom-color 0.3s ease;
    }
    /* For IE <= 11 */
    select::-ms-expand {
      display: none;
    }
    .selectIcon {
      top: 7px;
      right: 15px;
      width: 30px;
      height: 36px;
      padding-left: 5px;
      pointer-events: none;
      position: absolute;
      transition: background-color 0.3s ease, border-color 0.3s ease;
    }
    .selectIcon svg.icon {
      transition: fill 0.3s ease;
      fill: white;
    }
    select:hover,
    select:focus {
      color: #000000;
      background-color: white;
    }
    select:hover~.selectIcon,
    select:focus~.selectIcon {
      background-color: white;
    }
    select:hover~.selectIcon svg.icon,
    select:focus~.selectIcon svg.icon {
      fill: #1A33FF;
    }
  </style>

  </head>
  <body class="u-body u-overlap u-overlap-contrast u-xl-mode">
    <section class="u-align-center u-clearfix u-image u-shading u-section-1" id="sec-4cf6" data-image-width="6000" data-image-height="4000">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-container-style u-custom-color-4 u-group u-radius-9 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1">
            <h2 class="u-text u-text-body-alt-color u-text-default u-text-1">CADASTRO LIVRO</h2>
            <div class="u-form u-form-1">
              <form action="../Controllers/Livro.php" method="POST" source="custom" name="form" style="padding: 10px;">
                
                <!-- CAMPO TITULO -->
                <div class="u-form-group u-form-name">
                  <label for="name-9b6e" class="u-form-control-hidden u-label"></label>
                  <input type="text" placeholder="Titulo" id="name-9b6e" name="Titulo" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" maxlength="64">
                </div>

                <!-- CAMPO AUTOR -->
                <div class="u-form-group">
                  <label for="email-9b6e" class="u-form-control-hidden u-label"></label>
                    <td><center><select class="input-group-text" name="Nome_autor">
                    <?php foreach ($Autores as $Autor) : ?>
                    <option value="<?php echo ($Autor['Nome'])?>"><?php echo htmlspecialchars($Autor['Nome'])?></option>
                    <?php endforeach; ?>
                    </select></center></td>
                </div>

                <!-- CAMPO EDITORA -->
                 <div class="u-form-group">
                  <label for="email-9b6e" class="u-form-control-hidden u-label"></label>
                    <td><center><select class="input-group-text" name="Nome_editora" style="position: relative;">
                    <?php foreach ($Editoras as $Editora) : ?>
                    <option value="<?php echo ($Editora['Nome'])?>"><?php echo htmlspecialchars($Editora['Nome'])?></option>
                    <?php endforeach; ?>
                    </select></center></td>
                </div>
                <!-- <select name="Fruit">
                <option value="" disabled selected>Choose option</option>
                <option value="Apple">Apple</option>
                <option value="Banana">Banana</option>
                <option value="Coconut">Coconut</option>
                <option value="Blueberry">Blueberry</option>
                <option value="Strawberry">Strawberry</option>
                </select> -->

                <!-- BOTÃO CADASTRAR -->
                <div class="u-align-center u-form-group u-form-submit">
                  <a href="#" class="u-border-2 u-border-grey-75 u-btn u-btn-submit u-button-style u-palette-3-dark-1 u-btn-1">Cadastrar</a>
                  <input type="submit" value="Cadastrar" name="submit" class="u-form-control-hidden">
                </div>

                <div class="u-form-send-message u-form-send-success"> A sua mensagem foi enviada. </div>
                <div class="u-form-send-error u-form-send-message"> Não foi possível enviar a sua mensagem. Por favor, corrija os erros e tente novamente. </div>
                <input type="hidden" value="" name="recaptchaResponse">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </body>
</html>
<?php
include('../../templates/footer.php');
?>