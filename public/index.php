<!DOCTYPE html>
<html>

<head>
  <title>
    Gerencia Notas Fiscais
  </title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- View Port-->
  <meta name="viewport" content=" width=devide-width, initial-scale=1.0">

  <!-- CSS -->
  <link rel="stylesheet" href="./styles/global.css">
  <link rel="stylesheet" href="styles/home.css">
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="hero-unit">

      <h2>Selecione o Arquivo XML:</h2>

      <fieldset>
        <form action="./upload-xml.php" method="POST" enctype="multipart/form-data">
          <input type="file" name="arquivo">
          <input type="submit" name="enviar-formulario">
        </form>
      </fieldset>
    </div>

    <div class="table-nfe">
      <form action="./listar_notas.php" method="post">
        <input type="submit" value="Listar" name="listar">
      </form>

    </div>

  </div> <!-- /container -->
</body>

</html>