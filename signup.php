<?php
	//Je démarre la session
	//I start the session
	session_start();
	//Si un utilisateur est déjà logué
	//If a user is already logged in
	if(isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
		//Je le renvoi vers l'index
		//I redirect him to the index
		header("Location: index.php");
		exit;
	} else {
	//Sinon j'inclus mes variables de config
	//Otherwise I include my configuration variables
	include("config.php");

	//Les blocs try/catch permettent de surveiller l'apparition d'une erreur quelle qu'elle soit
	//Try/catch blocks are used to monitor the occurrence of any error
	try {
		//Je me connecte au serveur et à la bdd
		//I connect to the server and the database
		$dbh = new PDO('mysql:host=localhost;dbname=pupuce', $user, $pass);
	} catch (PDOException $e) {
		//S'il y a une erreur je la stocke dans ma variable
		//If there is an error I store it in my variable
	   $msgKO .= "Erreur !: " . $e->getMessage() . "<br/>";
	}

	//Traitement du formulaire d'inscription
	//Processing the registration form
	if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pseudo'])){
		$_POST['email'] = strtolower(htmlspecialchars($_POST['email']));
		$_POST['password'] = htmlspecialchars($_POST['password']);
		$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
		//Vérifications :
		//Si au moins un des champs à saisir est resté vide
		//If at least one of the fields to enter has remained empty
		if(strlen($_POST['password']) == 0 || strlen($_POST['email']) == 0 || strlen($_POST['pseudo']) == 0){
			//Je génère un message d'erreur
			//I generate an error message
			$msgKO .= " Merci de remplir tous les champs <br>";
		} else {
			//Sinon je vérifie si le mail est bien formé
			//If not I check if the mail is well formed
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			//Si ce n'est pas le cas je génère un message d'erreur
			//If it is not the case I generate an error message
			$msgKO .= " Le mail n'est pas bien formé <br>";
			}
			//Et si le mot de passe fait moins de 8 caractères
			//And if the password is less than 8 characters
			if(strlen($_POST['password']) < 8){
			//Si c'est le cas je génère un message d'erreur
			//If this is the case I generate an error message
			$msgKO .= " Le mot de passe doit comporter au moins 8 caractères <br>";
			}
			//Je vérifie aussi si le pseudo fait plus de 6 caractères
			//I also check if the nickname is longer than 6 characters
			if(strlen($_POST['pseudo']) > 6){
			//Si c'est le cas je génère un message d'erreur
			//If this is the case I generate an error message
			$msgKO .= " Le nom d'utilisateur ne doit pas dépasser 6 caractères <br>";
			}
		}

		//Si je n'ai pas de message d'alerte
		//If I do not have an alert message
		if(strlen($msgKO) == 0){
			//Je créé une requete me permettant de vérifier si l'email saisi existe déjà
			//I create a request to check if the entered email already exists
			$query = "SELECT * FROM `Users` WHERE `Users_email` = '".$_POST['email']."'";
			//J'envois la requète au serveur
			//I send the request to the server
			$users = $dbh->query($query);
			//Si l'email saisi n'existe pas encore
			//If the entered email does not exist yet
			if($users->rowCount() == 0){
				$query = "INSERT INTO `Users` (`Users_id`, `Users_nom`, `Users_email`, `Users_pass`, `Users_droits`) VALUES (NULL, '".$_POST['pseudo']."', '".$_POST['email']."', '".$_POST['password']."', 'User')";
				$dbh->exec($query);
				//Je créé une requete me permettant de récupérer un Users en fonction de ce qui est rentré dans le formulaire
				//I create a request that allows me to retrieve a User based on what is entered in the form
				$query = "SELECT * FROM `Users` WHERE `Users_email` = '".$_POST['email']."' AND `Users_pass` = '".$_POST['password']."'";
				//echo $query;
				//J'envois la requète au serveur
				//I send the request to the server
				$users = $dbh->query($query);
				//Je recupère ses données
				//I recover his data
				$user = $users->fetch();
				//Que je met en session
				//That I put in session
				$_SESSION['user'] = array("id" => $user['Users_id'], "nom" => $user['Users_nom'], "pass" => $user['Users_pass'], "droits" => $user['Users_droits']);
				//Et je renvoi vers l'index en passant la variable login a "success"
				//And I redirect to the index by passing the variable login as "success"
				header("Location: index.php?signup=success");
				exit;
			//Si l'email saisi existe déjà je génère un message d'erreur
			//If the entered email already exists I generate an error message
			} else {
				$msgKO .= " L'adresse email saisie est déjà assignée à un compte existant <br>";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
		<!--la balise meta viewport-->
		<!--the meta viewport tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--le lien vers bootstrap css-->
		<!--the link to bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--cdn fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--css maison-->
		<!--home made css-->
    <link href="boutique.css" type="text/css" rel="stylesheet">
    <title>Inscription Boutique</title>
  </head>
  <body>
    <?php
    //Affichage des messages d'erreur
		//Display of error messages
		if(!empty($msgKO)) {
    ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $msgKO; ?>
    </div>
    <?php
    }
  	?>
		<!-- Affichage du bouton de connexion -->
		<!-- Display of the login button -->
		<div class="login">
			<a href="login.php">&nbsp;<i class="fas fa-sign-in-alt"> Se connecter</i></a><br>
		</div>
		<!-- Affichage de la bannière du site -->
		<!-- Display of the website banner -->
  	<div class="banniere">
    	<a href="index.php"><img class="lien" src="images/banniere.jpg"></a>
  	</div>
	  <div class="container">
	  	<p><h3>Inscription :</h3></p>
			<!-- Affichage du formulaire -->
			<!-- Display of the form -->
	    <form id="connexion" name="connexion" method="post" action="signup.php">
	    	<div class="form-group">
	    		<label for="email">Email</label>
	    		<input type="email" name="email" class="form-control" id="email" placeholder="Email">
	    	</div>
	    	<div class="form-group">
	    		<label for="password">Mot de passe</label>
	    		<input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
	    	</div>
				<div class="form-group">
					<label for="pseudo">Nom d'utilisateur</label>
					<input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Nom d'utilisateur (6 caractères max.)">
				</div>
	    	<button type="submit" class="btn btn-primary">S'inscrire</button>
	    	<button type="reset" class="btn btn-secondary">Reset</button>
	    </form>
			<p><h6>Vous avez déjà un compte ? <a href="login.php">Connectez-vous !</a></h6></p>
  	</div>
  	<!-- Insertion des script js de bootstrap -->
		<!-- Insertion of bootstrap JS script -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  </body>
</html>
<?php
	}
