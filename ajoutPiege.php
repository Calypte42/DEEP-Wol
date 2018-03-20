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
		<!-- FORMULAIRE D'AJOUT DE PIEGE -->

		<form  id="ajoutPiege"  method="post" action = ""> <!-- reference au formulaire -->
		<p>
			<fieldset>
			<legend>Ajout d'un piège</legend>
			</br>

				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='grotte'>Grotte </label>";
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

				/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */

				echo "<label for='site'>Numéro du site </label>";
				echo "<select name='site'>"; /* On cree une liste deroulante vide */

				$requete='SELECT numSite from Site ORDER BY numSite';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option>$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
				?>

				</br></br>

				<label>Code du piège</label>
				<input type="text" id ="CodePiege" name="CodePiege" size="20"/></br></br>

				<label>Date de pose</label>
				<input type="date" id ="datePose" name="datePose"/></br></br>

				<label>Heure de pose</label>
				<input type="time" id ="heurePose" name="heurePose"/></br></br>

				<label>Date de récupération</label>
				<input type="date" id ="dateRecup" name="dateRecup"/></br></br> <!-- type text pour simplifier la saisie -->

				<label>Heure de récupération</label>
				<input type="time" id ="heureRecup" name="heureRecup"/></br></br>

				<label>Date de tri</label>
				<input type="date" id ="dateTri" name="dateTri"/></br></br>

				<label>Problèmes recontrés</label> </br>
				<textarea id="probleme" name="probleme" rows = "5" cols = "40"></textarea>

				</br>
				</br>

				<input type="submit" name="nom" value=" Valider et ajouter un nouveau piege"> &nbsp;&nbsp;
				<input type="submit" name="nom" value=" Valider et aller à la page suivante">

			</fieldset>
		</p>
		</form>
	</body>
</html>
