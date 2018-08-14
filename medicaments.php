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
              <title>Médicaments</title>
              <meta charset="UTF-8">
              <!--insérer ci-dessous la balise meta viewport-->
              <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              <!--insérer ci-dessous le lien vers bootstrap css-->
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
              <!--cdn fontawesome-->
              <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
              <!--css maison-->
              <link href="boutique.css" type="text/css" rel="stylesheet">
            </head>
            <body>
              <div class="logout">
                <a href="logout.php">&nbsp;<i class="fas fa-sign-out-alt"> Déconnexion</i></a>
              </div>
              <div class="banniere">
              	<a href="index.php"><img src="images/banniere.jpg"></a>
            	</div>
      <!--    <h1>Boutique en ligne simplifiée</h1> -->
          <br>
          <h1 id="tablo">Liste des médicaments <a href="ajouterMedicament.php" alt="Ajouter un médicament" title="Ajouter un médicament"><i class="fas fa-plus-circle"></i></a></h1>
          <div >
            <table class="table table-bordered table-hover table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>Nom <a href="medicaments.php?tri=nom&order=asc#tablo" title="Tri croissant"><i class="triascnom fas fa-arrow-alt-circle-down"></i></a><a href="medicaments.php?tri=nom&order=desc#tablo" title="Tri décroissant"><i class="tridescnom disphid fas fa-arrow-alt-circle-up"></i></a></th>
                  <th>Description <a href="medicaments.php?tri=description&order=asc#tablo" title="Tri croissant"><i class="triascdesc fas fa-arrow-alt-circle-down"></i></a><a href="medicaments.php?tri=description&order=desc#tablo" title="Tri décroissant"><i class="tridescdesc disphid fas fa-arrow-alt-circle-up"></i></a></th>
                  <th>Prix <a href="medicaments.php?tri=prix&order=asc#tablo" title="Tri croissant"><i class="triascprix fas fa-arrow-alt-circle-down"></i></a><a href="medicaments.php?tri=prix&order=desc#tablo" title="Tri décroissant"><i class="tridescprix disphid fas fa-arrow-alt-circle-up"></i></a></th>
                  <th>Quantité stock <a href="medicaments.php?tri=quantiteStock&order=asc#tablo" title="Tri croissant"><i class="triascqte fas fa-arrow-alt-circle-down"></i></a><a href="medicaments.php?tri=quantiteStock&order=desc#tablo" title="Tri décroissant"><i class="tridescqte disphid fas fa-arrow-alt-circle-up"></i></a></th>
                  <th>Image</th>
                  <th colspan="2">Edition</th>
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
        $query = "SELECT `id`,`nom`,`description`,`prix`,`image`,`quantiteStock` FROM `produits` WHERE `TypeProduit` = 'M'";
        if(isset($_GET['tri']) & isset($_GET['order'])){
          //on vérifie les valeurs ce qui permet d'éviter l'affichage d'une erreur si l'URL de tri est modifié (un caractère ajouté à la fin par exemple)
          if(($_GET['tri'] == "nom" || $_GET['tri'] == "description" || $_GET['tri'] == "prix" || $_GET['tri'] == "quantiteStock") & ($_GET['order'] == "asc" || $_GET['order'] == "desc")){
          $query .= " ORDER BY `".$_GET['tri']."` ".$_GET['order']."";
          }
        }
        $reponse = $dbh->query($query);
        while ($donnees = $reponse->fetch()){
      ?>
                <tr>
                  <td><?php echo $donnees['nom']; ?></td>
                  <td><?php echo $donnees['description']; ?></td>
                  <td><?php echo $donnees['prix']."€"; ?></td>
                  <td><?php echo $donnees['quantiteStock']; ?></td>
                  <td><img src="<?php echo $donnees['image']; ?>" width='130'></td>
                  <td><a class="btn btn-info" href="modifierMedicament.php?id=<?php echo $donnees['id']; ?>">Modifier</a></td>
                  <td><a class="btn btn-danger" href="delete.php?id=<?php echo $donnees['id']; ?>&description=<?php echo $donnees['description']; ?>&pageretour=medicaments">Supprimer</a></td>
                </tr>
      <?php
      }
      $reponse->closeCursor(); // Termine le traitement de la requête
      ?>
              </tbody>
            </table>
          </div>
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<?php
  if(isset($_GET['tri']) & isset($_GET['order'])){
    if($_GET['tri'] == "nom" & $_GET['order'] == "asc"){
?>
          <script>
          $(".tridescnom").toggleClass("disphid");
          $(".triascnom").toggleClass("disphid");
          </script>
<?php
    }
    if($_GET['tri'] == "description" & $_GET['order'] == "asc"){
?>
          <script>
          $(".tridescdesc").toggleClass("disphid");
          $(".triascdesc").toggleClass("disphid");
          </script>
<?php
    }
    if($_GET['tri'] == "prix" & $_GET['order'] == "asc"){
?>
          <script>
          $(".tridescprix").toggleClass("disphid");
          $(".triascprix").toggleClass("disphid");
          </script>
<?php
    }
    if($_GET['tri'] == "quantiteStock" & $_GET['order'] == "asc"){
?>
          <script>
          $(".tridescqte").toggleClass("disphid");
          $(".triascqte").toggleClass("disphid");
          </script>
<?php
    }
  }
?>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        </body>
      </html>
<?php
}
