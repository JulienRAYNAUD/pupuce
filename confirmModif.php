<?php
session_start();
//On vérifie qu'un utiliseur est connecté pour ne pas permettre d'arriver sur cette page en tapant directement son adresse
if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
  //Si aucun utiliseur n'est connecté on redirige vers l'index qui oblige à se connecter
   header("Location: index.php");
   exit;
} else {
  ?>
  <!DOCTYPE html>
  <html lang="fr">
    <head>
      <title>Modifier</title>
      <meta charset="UTF-8">
      <!--insérer ci-dessous la balise meta viewport-->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!--insérer ci-dessous le lien vers bootstrap css-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
      <!--cdn fontawesome-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      <!--css maison-->
      <link href="boutique.css" type="text/css" rel="stylesheet">
    </head>
    <body>
      <div>
        <a href="logout.php">&nbsp;<i class="fas fa-sign-out-alt"> Déconnexion</i></a>
      </div>
<!--    <h1>Boutique en ligne simplifiée</h1> -->

  <hr>

  <div class="alert alert-success" role="alert">
    Le produit a bien été modifié !
  </div>
    <div class="container-fluid">
  <a href="index.php"><i class="fas fa-home">&nbsp;</i>Retour à l'accueil</a><br><br>
  <a href="nourriture.php#tablo"><i class="far fa-arrow-alt-circle-left">&nbsp;</i>Aller à la liste des nourritures</a><br>
  <a href="jouets.php#tablo"><i class="far fa-arrow-alt-circle-left">&nbsp;</i>Aller à la liste des jouets</a><br>
  <a href="medicaments.php#tablo"><i class="far fa-arrow-alt-circle-left">&nbsp;</i>Aller à la liste des médicaments</a>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
<?php
}
