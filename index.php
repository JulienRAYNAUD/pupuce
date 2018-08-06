<?php
	// je démarre une session
	session_start();
	// J'inclus mes variables de config
	include("config.php");

	// les blocs Try/catch permettent de surveiller l'apparition d'une erreur quelle quelle soit
	try {
		//je me connecte au serveur et la bdd
		$dbh = new PDO('mysql:host=localhost;dbname=pupuce', $user, $pass);
	} catch (PDOException $e) {
		// s'il y a une erreur je la stocke dans ma variable
	    $msgKO .= "Erreur !: " . $e->getMessage() . "<br/>";
	}

	//formulaire de connexion
	if(isset($_POST['emailConnexion']) && isset($_POST['passwordConnexion']))
	{
		//vérifications :
		// si les identifiants sont vides
		if(strlen($_POST['emailConnexion']) == 0 || strlen($_POST['passwordConnexion']) == 0){
			$msgKO .= " Merci de remplir tous les champs <br>";
			} else {
				//sinon je vérifie aussi si le mail n'est bien formé
				if (!filter_var($_POST['emailConnexion'], FILTER_VALIDATE_EMAIL)) {
				$msgKO .= " Le mail n'est pas bien formé <br>";
				}
				//et si le mot de passe fait moins de 8 caractères
				if(strlen($_POST['passwordConnexion']) < 8){
				$msgKO .= " Le mot de passe doit comporter au moins 8 caractères <br>";
			}
		}

		// si je n'ai pas de message d'alert
		if(strlen($msgKO) == 0){
			// je lance la Connexion
			// je créé une requete me permettant de récupérer un users en fonction de ce qui est rentré dans le formulaire
			$query = "SELECT * FROM `Users` WHERE `Users_email` = '".$_POST['emailConnexion']."' AND `Users_pass` = '".$_POST['passwordConnexion']."'";
			//j'envois la requète au serveur
			$users = $dbh->query($query);
			// s'il y a un et un seul users renvoyé
			if($users->rowCount() == 1){
				// je recupère ses données
				$user = $users->fetch();
				// que je met en session
				$_SESSION['user'] = array("id" => $user['Users_id'], "nom" => $user['Users_nom'], "pass" => $user['Users_pass']);
				// Et je génère un message succès
				$msgOK .= "Bonjour ".$_SESSION['user']['nom'].", vous êtes bien logué";
			} else {
				$msgKO .= " Les identifiants saisis ne sont pas valides <br>";
			}
		}
	}
	?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Boutique</title>
  <link href="./boutique.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
  <?php if(!empty($msgKO)) {
    // permet d'afficher les msg d'erreurs
    ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $msgKO; ?>
  </div>
    <?php
  }
	if(!empty($msgOK)) {
      // permet d'afficher les msg de succès
    ?>
  <div class="alert alert-success" role="alert">
    <?php echo $msgOK; ?>
  </div>
    <?php
  }
//Je n'affiche le bouton de déconnexion que si l'utilisateur est logué
	if(isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
//	var_dump($_SESSION["user"]);
		?>
	<div class="logout">
		<a href="logout.php"><i class="fas fa-sign-out-alt"> Déconnexion</i></a>
	</div>
		<?php
	} ?>
	<div class="banniere">
  	<a href="index.php"><img src="images/banniere.jpg"></a>
	</div>
<!--    <h1>Boutique en ligne simplifiée</h1> -->
	    <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
	    	// s'il n'y a pas d'utilisateurs on affiche le formulaire de connexion
	    	?>
				<div class="container">
					<p><h3>Veuillez vous connectez :</h3></p>
	    	  <form id="connexion" name="connexion" method="post" action="index.php">
				  <div class="form-group">
				  	<label for="emailConnexion">Email</label>
				  	<input type="email" name="emailConnexion" class="form-control" id="emailConnexion" placeholder="Email">
				  </div>
				  <div class="form-group">
				  	<label for="passwordConnexion">Mot de passe</label>
				  	<input type="password" name="passwordConnexion" class="form-control" id="passwordConnexion" placeholder="Mot de passe">
				  </div>
				  <button type="submit" class="btn btn-primary">Envoyer</button>
				  <button type="reset" class="btn btn-secondary">Reset</button>
	      	</form>
				</div>
				<?php
	    } else { // Sinon on affiche le menu des produits ?>
        <div class="flexd">
          <a href="nourriture.php"><img src="images/nourriture.jpg"></a>
          <a href="jouets.php"><img src="images/jouets.jpg"></a>
          <a href="medicaments.php"><img src="images/medicaments.jpg"></a>
        </div>
	    <?php } ?>
	<!-- Insertion des script js de bootstrap -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
