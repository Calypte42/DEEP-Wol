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
		<!-- FORMULAIRE D'AJOUT DE SITE -->

		<form  id="ajoutSite"  method="post" action = ""> <!-- reference au formulaire -->
		<p>
			<fieldset>
			<legend>Ajout d'un site</legend>
			</br>

				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='grotte'>Grotte</label>";
				echo "<select name='grotte'>"; /* On cree une liste deroulante vide */

				$requete='SELECT NomCavite from Grotte ORDER BY NomCavite';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option>$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
				?>

				</br></br>

				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='equipeSpeleo'>Equipe spéléo </label>";
				echo "<select name='equipeSpeleo'>"; /* On cree une liste deroulante vide */

				$requete='SELECT * from EquipeSpeleo';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option>$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
				?>	
			
				(si pas dans la liste alors l'ajouter) <input type = "button" value = "ajouter une équipe"> <!-- rajout d'un bouton ajout d'une nouvelle équipe -->	
		
				</br></br>
		
				<label>Numéro de site</label>
				<input required = "required" type="text" id ="numSite" name="numSite" size="40"/> * </br></br>

				<label>Profondeur</label>
				<!-- Mettre number -->
				<input type="number" id ="profondeur" name="profondeur" size = "5"/></br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

				<!-- Mettre number -->
				<label>Temperature</label>
				<input type="number" id ="temperature" name="temperature" size = "5"/> °C</br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

				<label>Type de sol</label>
				<input type="text" id ="typeSol" name="typeSol" size="20"/></br></br>
				<!-- Mettre number -->
				<label>Distance à l'entrée</label>
				<input type="number" id ="distanceEntree" name="distanceEntree" size="10"/> m</br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

				<label>Présence d'eau</label>
				<input type="radio" id ="presenceEauOui" name="presenceEau" value="oui"/>
				<label for="presenceEauOui">oui</label>
				<input type = "radio" id = "presenceEauNon" name = "presenceEau" value="non">
				<label for="presenceEauNon">non</label>

				</br>
				</br>

				<input type="submit" name="nom" value=" Valider et ajouter un nouveau site"> &nbsp;&nbsp;
				<input type="submit" name="nom" value=" Valider et aller à la page suivante">

			</fieldset>
		</p>
		</form>
	</body>
</html>
