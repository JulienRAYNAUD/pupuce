<?php
  session_start();
  //On vérifie qu'un utiliseur est connecté pour ne pas permettre d'arriver sur cette page en tapant directement son adresse
  if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
    //Si aucun utiliseur n'est connecté on redirige vers l'index qui oblige à se connecter
     header("Location: index.php");
     exit;
  } else {
    // J'inclus mes variables de config
    include("config.php");?>
          <!DOCTYPE html>
          <html lang="fr">
            <head>
              <title>Ajout de Médicaments</title>
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
          <?php
          //On vérifie si le formulaire a été validé
          if(isset($_POST['submitMedicament'])){
            // On vérifie si tous les champs sont remplis
            if(empty($_POST['nom']) || empty($_POST['description']) || empty($_POST['image']) || empty($_POST['prix']) || empty($_POST['quantiteStock'])){
                // Si non, on avertit l'utilisateur
              ?><div class="alert alert-danger" role="alert">Veuillez remplir tous les champs !</div><?php
              $msgKO .= " Veuillez remplir tous les champs !<br>";
                // On limite la description à 64 caractères max car la bdd n'en accepte pas plus
            }else if(strlen($_POST['description']) > 64){
                ?><div class="alert alert-danger" role="alert">La description ne doit pas dépasser 64 caractères !</div><?php
                $msgKO .= " La description ne doit pas dépasser 64 caractères !<br>";
              }
              // si je n'ai pas de message d'alert
          		if(strlen($msgKO) == 0){
            try {
              //je me connecte au serveur et la bdd
              $dbh = new PDO('mysql:host=localhost;dbname=pupuce;charset=utf8', $user, $pass);
            } catch (PDOException $e) {
              // s'il y a une erreur je la stocke dans ma variable
                $msgKO .= "Erreur !: " . $e->getMessage() . "<br/>";
            }
            $query = "INSERT INTO `produits` (`nom`, `description`, `image`, `prix`, `quantiteStock`, `TypeProduit`) VALUES ('".$_POST['nom']."', '".$_POST['description']."', '".$_POST['image']."', '".$_POST['prix']."', '".$_POST['quantiteStock']."', 'M')";
            $dbh->exec($query);
          //  echo $query;
          header("Location: medicaments.php?operation=ajout");
          exit;
          }
          }
          ?>
        	<div class="container-fluid mb-5">
            <h1>Ajouter un médicament</h1>
            <div class="row">
              <div class="col-sm-4">
                <form id="ajouterMedicament" name="ajouterMedicament" method="post" action="ajouterMedicament.php">
                  <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" class="form-control form-control-sm" id="nom" placeholder="Nom">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control form-control-sm" id="description" placeholder="Description">
                  </div>
                  <div class="form-group">
                    <label for="image">Image</label>
                    <input type="url" name="image" class="form-control form-control-sm" id="image" placeholder="URL de l'image">
                  </div>
                  <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="number" name="prix" class="form-control form-control-sm" id="prix" placeholder="Prix en €">
                  </div>
                  <div class="form-group">
                    <label for="prix">Quantité stock</label>
                    <input type="number" name="quantiteStock" class="form-control form-control-sm" id="quantiteStock" placeholder="Quantité">
                  </div>
                  <button type="submit" class="btn btn-primary" name="submitMedicament" id="submitMedicament">Ajouter le médicament</button>
                  <a class="btn btn-danger" href="medicaments.php#tablo">Annuler</a>
      <br><br>
      <a href="index.php"><i class="fas fa-home">&nbsp;</i>Retour à l'accueil</a><br>
              </form>
            </div>
          </div>

          </div>
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

        </body>
      </html>
<?php
}
