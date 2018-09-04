<?php
	//Je démarre une session
	session_start();
	//Si un utilisateur est déjà logué
	if(isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
		//Je le renvoi vers l'index
		header("Location: index.php");
		exit;
	} else {
	//Sinon j'inclus mes variables de config
	include("config.php");

	//Les blocs Try/catch me permettent de surveiller l'apparition d'une erreur quelle qu'elle soit
	try {
		//Je me connecte au serveur et à la bdd
		$dbh = new PDO('mysql:host=localhost;dbname=pupuce', $user, $pass);
	} catch (PDOException $e) {
		//S'il y a une erreur je la stocke dans ma variable
	   $msgKO .= "Erreur !: " . $e->getMessage() . "<br/>";
	}

	//Formulaire de connexion
	if(isset($_POST['emailConnexion']) && isset($_POST['passwordConnexion'])){
		//Vérifications :
		//Si les identifiants sont vides
		if(strlen($_POST['emailConnexion']) == 0 || strlen($_POST['passwordConnexion']) == 0){
			$msgKO .= " Merci de remplir tous les champs <br>";
		} else {
			//Sinon je vérifie aussi si le mail n'est bien formé
			if (!filter_var($_POST['emailConnexion'], FILTER_VALIDATE_EMAIL)) {
			$msgKO .= " Le mail n'est pas bien formé <br>";
			}
			//Et si le mot de passe fait moins de 8 caractères
			if(strlen($_POST['passwordConnexion']) < 8){
			$msgKO .= " Le mot de passe doit comporter au moins 8 caractères <br>";
			}
		}

		//Si je n'ai pas de message d'alert
		if(strlen($msgKO) == 0){
			//Je créé une requete me permettant de récupérer un Users en fonction de ce qui est rentré dans le formulaire
			$query = "SELECT * FROM `Users` WHERE `Users_email` = '".$_POST['emailConnexion']."' AND `Users_pass` = '".$_POST['passwordConnexion']."'";
			//J'envois la requète au serveur
			$users = $dbh->query($query);
			//S'il y a un et un seul Users renvoyé
			if($users->rowCount() == 1){
				//Je recupère ses données
				$user = $users->fetch();
				//Que je met en session
				$_SESSION['user'] = array("id" => $user['Users_id'], "nom" => $user['Users_nom'], "pass" => $user['Users_pass'], "droits" => $user['Users_droits']);
				header("Location: index.php?login=success");
				exit;
			//Sinon je génère un message d'erreur
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
		<!--la balise meta viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--le lien vers bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--cdn fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--css maison-->
    <link href="boutique.css" type="text/css" rel="stylesheet">
    <title>Connexion Boutique</title>
  </head>
  <body>
    <?php if(!empty($msgKO)) {
    //Affichage des messages d'erreur
    ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $msgKO; ?>
    </div>
    <?php
    }
  	?>
  	<div class="banniere">
    	<a href="index.php"><img class="lien" src="images/banniere.jpg"></a>
  	</div>
	  <div class="container">
	  	<p><h3>Veuillez vous connectez :</h3></p>
	    <form id="connexion" name="connexion" method="post" action="login.php">
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
  	<!-- Insertion des script js de bootstrap -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  </body>
</html>
<?php
	}
