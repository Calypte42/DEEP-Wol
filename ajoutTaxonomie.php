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
		<!-- FORMULAIRE D'AJOUT DE LA TAXONOMIE -->

		<form  id="ajoutTaxonomie"  method="GET" action = "ajoutTaxonomieWS.php"> <!-- reference au formulaire -->
		<p>
			<fieldset>
			<legend>Ajout d'une taxonomie</legend>
			</br>

				<label>Classe</label>
				<input type="text" id ="classeTaxo" name="classeTaxo" size="40"/></br></br>

		        <label>Ordre</label>
				<input type="text" id ="ordreTaxo" name="ordreTaxo" size="40"/></br></br>

		        <label>Famille</label>
				<input type="text" id ="familleTaxo" name="familleTaxo" size="40"/></br></br>

		        <label>Sous-famille</label>
				<input type="text" id ="sousFamilleTaxo" name="sousFamilleTaxo" size="40"/></br></br>

		        <label>Genre</label>
				<input type="text" id ="genreTaxo" name="genreTaxo" size="40"/></br></br>

		        <label>Espèce</label>
				<input type="text" id ="especeTaxo" name="especeTaxo" size="40"/></br></br>

   					<label>Photo</label>
				<input type="file" id ="photo" name="photo" size="15" placeholder = "lien de la photo"/></br></br>

				<input type="submit" name="nom" value="Valider et ajouter une nouvelle taxonomie">

			</fieldset>
		</form>
	</body>
</html>
