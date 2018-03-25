<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>ajoutDonnées</title>
		<script type="text/javascript" src=""></script>
		<link rel = 'stylesheet' href = 'css/style.css' type='text/css' />
	</head>

	<body>
		<!-- Formulaire ajout auteur dans BDD -->
		<fieldset>
		<legend>Ajout d'un auteur</legend>
		</br>
			<form  id="auteur"  method="post">
				<label>nom</label>
				<input type="text" id ="nomAuteur" name="nomAuteur" size="50"/></br></br>

				<label>prénom</label>
				<input type="text" id ="prenomAuteur" name="prenomAuteur" size = "50"/></br></br>
			</form>
		</fieldset>
	</body>
</html>
