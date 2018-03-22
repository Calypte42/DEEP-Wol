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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!-- style Bootstrap v3.3.7 -->
		<link rel = 'stylesheet' href = 'CSS/entete.css' type='text/css' />
		<link rel = 'stylesheet' href = 'CSS/menuVertical.css' type='text/css' />
	</head>

	<body>

	<?php
	include 'HTML/entete.html';
	include 'HTML/menuVertical.html'
	?>
		<!-- FORMULAIRE D'AJOUT D'UN GENE -->

		<form  id="ajoutGene"  method="GET" action = "ajoutGeneWS.php"> <!-- reference au formulaire -->
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
