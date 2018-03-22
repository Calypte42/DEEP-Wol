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
		<fieldset>
		<legend>Ajout d'un système hydrographique</legend>
		</br>
			<form  id="ajoutSystemeHydrographique"  method="post">
				<label>nom</label>
				<input type="text" id ="nom" name="nom" size="30"/></br></br>
			
				<label>département</label>
				<input type="number" id ="departement" name="departement"/></br></br>
			</form>
		</fieldset>
	</body>
</html>
