<?php
	//Je démarre une session
	session_start();
	//Si aucun utilisateur n'est connecté
	if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
		//Si l'utilisateur vient de se déconnecter
		if(isset($_GET['logout'])){
			if($_GET['logout'] == "success"){
				//Je génère un message de succès
				$msgOK = "Déconnexion réussie";
	  	}
		}
	}
	//Si un utilisateur est déjà logué
	if(isset($_SESSION["user"]) || !empty($_SESSION["user"])){
		//Si l'utilisateur vient de se loguer
		if(isset($_GET['login']) && $_GET['login'] == "success"){
			//Je génère un message de succès
			$msgOK = "Bonjour ".$_SESSION['user']['nom'].", vous êtes bien connecté";
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
  	<title>Boutique</title>
	</head>
	<body>
  	<?php
		//Affichage des éventuels messages de succès
		if(!empty($msgOK)) {
    ?>
  	<div class="alert alert-success" role="alert">
    	<?php echo $msgOK; ?>
  	</div>
    	<?php
  	}
		//Je n'affiche le bouton de déconnexion que si l'utilisateur est logué
		if(isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
			//var_dump($_SESSION["user"]);
		?>
		<div class="logout">
			<a href="logout.php">&nbsp;<i class="fas fa-sign-out-alt"> Déconnexion</i></a><br>
			<?php
			//Si c'est un administrateur qui est connecté, on affiche une icône différente (cravate)
			if($_SESSION['user']['droits'] == "Administrator"){
				echo "<a href='#'>&nbsp;<i class='fas fa-user-tie'> ".$_SESSION['user']['nom']."</i></a>";
				//Sinon on affiche une icône utilisateur (sans cravate)
			}else{
			echo "<a href='#'>&nbsp;<i class='fas fa-user'> ".$_SESSION['user']['nom']."</i></a>";
			}
			?>
		</div>
		<?php
		}
		//S'il n'y a pas d'utilisateurs on affiche les boutons de connexion et d'inscription
		if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
		?>
		<div class="login">
			<a href="login.php">&nbsp;<i class="fas fa-sign-in-alt"> Se connecter</i></a><br>
			<a href="signup.php">&nbsp;<i class="fas fa-user-plus"> S'inscrire</i></a>
		</div>
		<?php
		}
		?>
		<div class="banniere">
  		<a href="index.php"><img class="lien" src="images/banniere.jpg"></a>
		</div>
<!--<h1>Boutique en ligne simplifiée</h1>-->
    <div class="flexd">
      <a href="nourriture.php"><img class="lien" src="images/nourriture.jpg"></a>
      <a href="jouets.php"><img class="lien" src="images/jouets.jpg"></a>
      <a href="medicaments.php"><img class="lien" src="images/medicaments.jpg"></a>
    </div>
		<!-- Insertion des script js de bootstrap -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>
