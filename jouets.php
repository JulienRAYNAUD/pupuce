<?php
  session_start();
  //On vérifie qu'un utiliseur est connecté pour ne pas permettre d'arriver sur cette page en tapant directement son adresse
  if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
     header("Location: index.php");
     exit;
  } else {
    // J'inclus mes variables de config
    include("config.php");?>
          <!DOCTYPE html>
          <html lang="fr">
            <head>
              <title>Jouets</title>
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
              <div class="logout">
                <a href="logout.php"><i class="fas fa-sign-out-alt"> Déconnexion</i></a>
              </div>
              <div class="banniere">
              	<a href="index.php"><img src="images/banniere.jpg"></a>
            	</div>
      <!--    <h1>Boutique en ligne simplifiée</h1> -->
          <br>
          <h1>Liste des jouets <a href="ajouterJouet.php" alt="Ajouter un jouet" title="Ajouter un jouet"><i class="fas fa-plus-circle"></i></a></h1>
          <div >
            <table class="table table-bordered table-hover table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>Nom</th>
                  <th>Description</th>
                  <th>Prix</th>
                  <th>Image</th>
                  <th>Modifier</th>
                  <th>Supprimer</th>
                </tr>
              </thead>
            <tbody>
      <?php
        try {
          //je me connecte au serveur et la bdd
          $dbh = new PDO('mysql:host=localhost;dbname=pupuce;charset=utf8', $user, $pass);
        } catch (PDOException $e) {
          // s'il y a une erreur je la stocke dans ma variable
            $msgKO .= "Erreur !: " . $e->getMessage() . "<br/>";
        }
        $query = "SELECT `id`,`nom`,`description`,`prix`,`image` FROM `produits` WHERE `TypeProduit` = 'J'";
        $reponse = $dbh->query($query);
        while ($donnees = $reponse->fetch()){
      ?>
                <tr>
                  <td><?php echo $donnees['nom']; ?></td>
                  <td><?php echo $donnees['description']; ?></td>
                  <td><?php echo $donnees['prix']."€"; ?></td>
                  <td><img src="<?php echo $donnees['image']; ?>" width='130'></td>
                  <td id="modifier"><i class="fas fa-pen fa-2x"></i></td>
                  <td id="supprimer"><i class="far fa-trash-alt fa-2x"></i></td>
                </tr>
      <?php
      }
      $reponse->closeCursor(); // Termine le traitement de la requête
      ?>
              </tbody>
            </table>
          </div>
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

          </body>
          </html>
<?php
}
