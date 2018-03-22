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
		<!-- FORMULAIRE D'AJOUT DE GROTTE -->
	</br>
	</br>
		<form  id="ajoutGrotte"  method="GET" action = "ajoutGrotteWS.php"> <!-- reference au formulaire -->
		<p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
			<fieldset>
			<legend>Ajout d'une grotte</legend>
			</br>
				<label>Nom de la grotte</label>          <!-- Changer les size par rapport à la base de donnees -->
				<input required type="text" id ="nomGrotte" name="nomGrotte" size="50"/> * </br></br>

				<label>Type de cavité</label>  <!-- menu deroulant : a preciser les valeurs -->
					<select name="typeCavite" id="typeCavite">
						<option value="">Choix1</option>
						<option value="">Choix2</option>
						<option value="">Choix3</option>
					</select>

		        </br></br>

				<label>Latitude</label>
				<input type="text" id ="latitude" name="latitude" size="10" placeholder = "30° N"/></br></br>  <!-- type text pour simplifier la saisie -->

				<label>Longitude</label>
				<input type="text" id ="longitude" name="longitude" size="10" placeholder = "20° O"/></br></br>  <!-- type text pour simplifier la saisie -->

				<label>Type d'accès</label>
				<input type="text" id ="typeAcces" name="typeAcces" size="20"/></br></br>

				<label>Système hydrographique</label>
				<input type="text" id ="systemeHydro" name="systemeHydro" size="30"/>
				
				<input type = "button" value = "ajouter un système hydrographique"> 

		        	</br></br>

				<label>Accès au public </label>
				<input type="radio" id ="accesPublicOui" name="accesPublic" value="true"/>
				<label for="accesPublicOui">oui</label>
				<input type = "radio" id = "accesPublicNon" name = "accesPublic" value="false">
				<label for="accesPublicNon">non</label>

				</br>
				</br>

				<input type="submit" name="nom" value="Valider et ajouter une nouvelle grotte"> &nbsp;&nbsp;
				<input type="submit" name="nom" value="Valider et aller à la page suivante">

			</fieldset>
		</p>
		</form>
	</body>
</html>
