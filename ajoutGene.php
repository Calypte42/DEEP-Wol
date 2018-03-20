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
		<!-- FORMULAIRE D'AJOUT D'UN GENE -->

		<form  id="ajoutGene"  method="post" action = ""> <!-- reference au formulaire -->
		<p>
			<fieldset>
			<legend>Ajout d'un gène</legend>
			</br>
			
				<label>Nom</label>
				<input type="text" id ="nomGene" name="nomGene" size="20"/></br></br>

		        </br>

				<input type="submit" name="nom" value=" Valider et ajouter un nouveau gène">

			</fieldset>
		</p>
		</form>
	</body>
</html>
