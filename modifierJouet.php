<?php
  session_start();
  //On vérifie qu'un utiliseur est connecté pour ne pas permettre d'arriver sur cette page en tapant directement son adresse
  if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
    //Si aucun utiliseur n'est connecté on redirige vers l'index qui oblige à se connecter
     header("Location: index.php");
     exit;
  } else {
    // J'inclus mes variables de config
    include("config.php");
    try {
      //je me connecte au serveur et la bdd
      $dbh = new PDO('mysql:host=localhost;dbname=pupuce;charset=utf8', $user, $pass);
    } catch (PDOException $e) {
      // s'il y a une erreur je la stocke dans ma variable
        $msgKO .= "Erreur !: " . $e->getMessage() . "<br/>";
    }
    $query = "SELECT `nom`,`description`,`prix`,`image`,`quantiteStock` FROM `produits` WHERE `id` = ".$_GET['id'];
    $reponse = $dbh->query($query);
    $donnees = $reponse->fetch();
    //On vérifie si l'image provient du dossier "images", si c'est le cas on enlève le début du lien pour n'afficher que le nom du fichier image
    if(substr($donnees['image'], 0, 7) == "images/"){
      $donnees['image'] = substr($donnees['image'], 7);
    }
/*    echo $donnees['image'];
    ?>
    <pre>
      <?php
    var_dump($donnees);
?>
</pre>
*/
?>
          <!DOCTYPE html>
          <html lang="fr">
            <head>
              <title>Modifier Jouet</title>
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

        	<div class="container-fluid mb-5">
            <h1>Modification du jouet "<?php echo $donnees['description']; ?>"</h1>
            <div class="row">
              <div class="col-sm-4">
                <form id="modifierJouet" name="modifierJouet" method="post" action="modifierJouet.php?id=<?php echo $_GET['id']; ?>">
                  <div class="form-group">
                    <label for="nom">Nom&nbsp;&nbsp;<a href="#"><i class="enablednom fas fa-pen"></i></a></label>
                    <input type="text" name="nom" class="inputnomenabled form-control form-control-sm" id="nom" value="<?php echo $donnees['nom']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="description">Description&nbsp;&nbsp;<a href="#"><i class="enableddesc fas fa-pen"></i></a></label>
                    <input type="text" name="description" class="inputdescenabled form-control form-control-sm" id="description" value="<?php echo $donnees['description']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="image">Image&nbsp;&nbsp;<a href="#"><i class="enabledimage fas fa-pen"></i></a></label>
                    <input type="text" name="image" class="inputimageenabled form-control form-control-sm" id="image" value="<?php echo $donnees['image']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="prix">Prix&nbsp;&nbsp;<a href="#"><i class="enabledprix fas fa-pen"></i></a></label>
                    <input type="number" name="prix" class="inputprixenabled form-control form-control-sm" id="prix" value="<?php echo $donnees['prix']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="prix">Quantité stock&nbsp;&nbsp;<a href="#"><i class="enabledqte fas fa-pen"></i></a></label>
                    <input type="number" name="quantiteStock" class="inputqteenabled form-control form-control-sm" id="quantiteStock" value="<?php echo $donnees['quantiteStock']; ?>" readonly>
                  </div>
                  <button type="submit" class="submitenabled btn btn-primary" name="submitJouet" id="submitJouet" disabled>Modifier le jouet</button>
      <?php
      //On vérifie si le formulaire a été validé
      if(isset($_POST['submitJouet'])){
        // On vérifie si tous les champs sont remplis
        if(empty($_POST['nom']) || empty($_POST['description']) || empty($_POST['image']) || empty($_POST['prix']) || empty($_POST['quantiteStock'])){
            // Si non, on avertit l'utilisateur
          ?><span style="color:red";>Veuillez remplir tous les champs !</span><?php
          $msgKO .= " Veuillez remplir tous les champs !<br>";
            // On limite la description à 64 caractères max car la bdd n'en accepte pas plus
        }else if(strlen($_POST['description']) > 64){
            ?><span style="color:red";>La description ne doit pas dépasser 64 caractères !</span><?php
            $msgKO .= " La description ne doit pas dépasser 64 caractères !<br>";
          }
        if(strlen($msgKO) == 0){
          if(substr($_POST['image'], 0, 4) == "http"){
            $query = "UPDATE `produits` SET `nom` = '".$_POST['nom']."', `description` = '".$_POST['description']."', `image` = '".$_POST['image']."', `prix` = '".$_POST['prix']."', `quantiteStock` = '".$_POST['quantiteStock']."' WHERE `id` = '".$_GET['id']."'";
          }else{
        $query = "UPDATE `produits` SET `nom` = '".$_POST['nom']."', `description` = '".$_POST['description']."', `image` = 'images/".$_POST['image']."', `prix` = '".$_POST['prix']."', `quantiteStock` = '".$_POST['quantiteStock']."' WHERE `id` = '".$_GET['id']."'";
      }
        $dbh->exec($query);
      //  echo $query;
      header("Location: confirmModif.php");
      exit;
      }
    }
      ?>
      <br><br>
      <a href="jouets.php#tablo"><i class="far fa-arrow-alt-circle-left">&nbsp;</i>Revenir à la liste des jouets</a><br>
      <a href="index.php"><i class="fas fa-home">&nbsp;</i>Retour à l'accueil</a>

              </form>
            </div>
          </div>

          </div>
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script>
          $(".enablednom").on("click",function (){
          $(".inputnomenabled").removeAttr("readonly");
          $(".submitenabled").removeAttr("disabled");
          });
          $(".enableddesc").on("click",function (){
          $(".inputdescenabled").removeAttr("readonly");
          $(".submitenabled").removeAttr("disabled");
          });
          $(".enabledimage").on("click",function (){
          $(".inputimageenabled").removeAttr("readonly");
          $(".submitenabled").removeAttr("disabled");
          });
          $(".enabledprix").on("click",function (){
          $(".inputprixenabled").removeAttr("readonly");
          $(".submitenabled").removeAttr("disabled");
          });
          $(".enabledqte").on("click",function (){
          $(".inputqteenabled").removeAttr("readonly");
          $(".submitenabled").removeAttr("disabled");
          });
          </script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

        </body>
      </html>
<?php
}
