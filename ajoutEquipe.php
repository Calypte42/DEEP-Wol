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
		<!-- Formulaire ajout éuipe dans BDD -->

		<form  id="ajoutEquipe"  method="post">
			<label>Equipe spéleo</label>
			<input type="text" id ="equipeSpeleo" name="equipeSpeleo" size="20"/></br></br>
		</form>
	</body>
</html>
