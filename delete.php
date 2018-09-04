<?php
session_start();
//On vérifie qu'un utiliseur est connecté pour ne pas permettre d'arriver sur cette page en tapant directement son adresse
//Si aucun utiliseur n'est connecté on redirige vers l'index
if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
   header("Location: index.php");
   exit;
}
//Si un utilisateur non administrateur est connecté on redirige vers l'index
if(isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
  if($_SESSION['user']['droits'] == "User"){
   header("Location: index.php");
   exit;
  }
  if($_SESSION['user']['droits'] == "Administrator"){
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
  header("Location: ".$_POST['pageretour'].".php?operation=suppr");
}
  ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <!--la balise meta viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--le lien vers bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--cdn fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--css maison-->
    <link href="boutique.css" type="text/css" rel="stylesheet">
    <title>Suppression produit</title>
  </head>
  <body style="text-align: center">
    <br>
    <form class="form-horizontal" action="delete.php" method="post">
      <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
      <input type="hidden" name="pageretour" value="<?php echo $_GET['pageretour'];?>">
      <div class="alert alert-danger" role="alert">
        Confirmez vous la suppression du produit "<?php echo $_GET['description']; ?>" ?
      </div>
      <br />
      <div class="form-actions">
        <button type="submit" class="btn btn-danger">OK</button>&nbsp;
        <a class="btn btn-light" href="<?php echo $_GET['pageretour']; ?>.php#tablo">Annuler</a>
      </div>
      <p>

    </form>
  </body>
</html>
<?php
  }
}
