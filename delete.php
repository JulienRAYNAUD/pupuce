<?php
session_start();
//On vérifie qu'un utiliseur est connecté pour ne pas permettre d'arriver sur cette page en tapant directement son adresse
if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
  //Si aucun utiliseur n'est connecté on redirige vers l'index qui oblige à se connecter
   header("Location: index.php");
   exit;
} else {
include("config.php");
//On vérifie si le formulaire a été validé
if(isset($_POST['id'])){
  try {
    //je me connecte au serveur et la bdd
    $dbh = new PDO('mysql:host=localhost;dbname=pupuce;charset=utf8', $user, $pass);
  } catch (PDOException $e) {
    // s'il y a une erreur je la stocke dans ma variable
      $msgKO .= "Erreur !: " . $e->getMessage() . "<br/>";
  }
  $query = "DELETE FROM `produits` WHERE `id` = ".$_POST['id']."";
  $dbh->exec($query);
//  echo $query;
  header("Location: ".$_POST['pageretour'].".php#tablo");
}
  ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Suppression produit</title>
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
  <body style="text-align: center">
    <form class="form-horizontal" action="delete.php" method="post">
      <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
      <input type="hidden" name="pageretour" value="<?php echo $_GET['pageretour'];?>">
      <div class="alert alert-danger" role="alert">
        Confirmez vous la suppression du produit "<?php echo $_GET['description']; ?>" ?
      </div>
      <br />
      <div class="form-actions">
        <button type="submit" class="btn btn-danger">Oui</button>&nbsp;
        <a class="btn btn-light" href="<?php echo $_GET['pageretour']; ?>.php#tablo">Non</a>
      </div>
      <p>

    </form>
  </body>
</html>
<?php
}
