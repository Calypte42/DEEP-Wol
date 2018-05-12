<?php
include "BDD/bdd.php";
$bdd=connexionbd();
//include "html/entete.html";
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Authentification</title>

  	<link rel="stylesheet" href="Bootstrap/bootstrap.css">
  	<link rel = 'stylesheet' href = 'CSS/style.css' type='text/css' />

  	<script src="Bootstrap/jquery.js"></script>
  	<script src="Bootstrap/bootstrap.js"></script>
	</head>

	<body class = "bg-warning" style="background:#C0C0C0;">
	</br>
	</br>
	</br>
	</br>

<!-- Premier boite : avec le titre de la bdd -->
	<div class="container-fluid">
		<div class="text-center">
			<h1> BD DEEP-Wol </h1>
		</div>
	</div>
<!--Fin premiere boite -->

	</br>

<!-- Deuxieme boite : avec présentation de la bdd -->
	<div class="container-fluid">
		<div class="text-center">
      <h4>En collaboration avec l'Université de Montpellier, le Muséum d’Histoire Naturelle de Paris et l’association OSEA</h4>
    </div>
  </div>
<!--Fin deuxieme boite -->

	</br>

<!-- Troisieme boite : avec authentification pour la bdd -->
	<div class="container-fluid" id="authentification">
		<div class= "col-sm-4 col-sm-offset-4">
		<form method= "GET" action="./WebService/authentificationWS.php" class="form-login" style="background:#6e523f;">
			<h4 style="color:white;">Authentification</h4>
		  <div class="input-group">
		  	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" id="login" class="form-control input-sm chat-input" name="login" placeholder="Nom d'utilisateur" />
			</div>

			</br>

			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" id="mdp" name="mdp" class="form-control input-sm chat-input" placeholder="Mot de passe" />
			</div>

			</br>

			<div class="wrapper" >
				<input type="submit" name="submit" value="login"/>
			</div>
		</form>
		</div>
	</div>
<!--Fin troisieme boite -->

	</body>
</html>
