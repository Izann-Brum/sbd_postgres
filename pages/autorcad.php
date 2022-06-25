<?php
include('../templates/header.php');
?>

<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="cADASTRO AUTOR">
    <meta name="description" content="">
    <!-- <title>autocad</title> -->
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="autorcad.css" media="screen">
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
    <meta property="og:title" content="autocad">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body u-xl-mode">
    <section class="u-clearfix u-image u-section-1" id="sec-4cf6" data-image-width="6000" data-image-height="4000">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-custom-color-3 u-opacity u-opacity-90 u-radius-9 u-shape u-shape-round u-shape-1"></div>
        <h2 class="u-text u-text-body-alt-color u-text-1">CADASTRO AUTOR</h2>
        <div class="u-form u-form-1">
          <form action="../pages/Controllers/Autor.php" method="POST" style="padding: 18px;" source="email">
            <div class="u-form-group u-form-name u-label-none">
              <!-- <label for="name-ef64" class="u-label">seila</label> -->
              <input type="text" placeholder="Nome" id="name-ef64" name="Nome_autor" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white u-input-1" required="" autofocus="autofocus" maxlength="64">
            </div>
            <div class="">
              <a href="#" class="u-btn u-btn-submit u-button-style">Cadastrar</a>
              <input type="submit" value="submit" name="submit" class="u-form-control-hidden">
            </div>
         
          </form>
        </div>
      </div>
    </section>
    

  </body>
</html>

<?php
include('../templates/footer.php');
?>