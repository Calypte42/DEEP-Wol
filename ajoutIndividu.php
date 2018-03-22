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
		<!-- FORMULAIRE D'AJOUT D'INDIVIDU -->

		<form  id="ajoutIndividu"  method="post" action = ""> <!-- reference au formulaire -->
		<p>
			<fieldset>
			<legend>Ajout d'un individu</legend>
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

				<?php

				/* on veut recuperer les valeurs de code de piege deja existantes dans la bdd */

				echo "<label for='piege'>Code du piège </label>";
				echo "<select name='piege'>"; /* On cree une liste deroulante vide */

				$requete='SELECT codePiege from Piege ORDER BY codePiege';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option>$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
				?>

				</br></br>

				<label>Numéro de l'individu</label>
				<input type="text" id ="numIndiv" name="numIndiv" size="20"/></br></br> <!-- recuperer la valeur precedemment remplie -->

				<label>Forme de stockage</label>  <!-- menu deroulant -->
					<select name="formeStockage" id="formeStockage">
						<option selected value="individuEntier">Individu entier</option> <!-- par défaut -->
						<option value="ADNextraitChelex">ADN extrait chelex</option>
						<option value="ADNextraitColonne">ADN extrait colonne</option>
						<option value="EnrichissementGenomeBacterien">Enrichissement génome bactérien</option>
						<option value="Pool">Pool</option>
					</select>

				(si selection de pool alors envoi vers formulaire) <input type = "button" value = "ajouter un pool">

		        </br></br>

				<label>Lieu de stockage</label>
				<input type="text" id ="lieuStockage" name="lieuStockage" size="20"/></br></br>

				<label>Niveau d'identification</label>  <!-- menu deroulant -->
					<select name="formeStockage" id="formeStockage">
						<option value="hypothetique">Hypothétique</option>
						<option value="valide">Validé</option>
					</select>

		        </br></br>

				<label>Infecté par bactérie</label>  <!-- menu deroulant -->
					<select name="infectionBacterie" id="infectionBacterie">
						<option value="oui">oui</option>
						<option value="non">non</option>
						<option selected value="nonDetermine">non déterminé</option>
					</select>

		        </br></br>
		        <!-- ajout des attributs de taxonomie sous forme de liste déroulante, en fieldset inclu dans le formulaire individu -->
				<form  id="ajoutTaxonomie"  method="post" action = ""> <!-- reference au formulaire -->
				<p>
					<fieldset>
					<legend>Ajout d'une taxonomie</legend>
					</br>

					<?php

					/* on veut recuperer les valeurs de classe deja existantes dans la bdd */

					echo "<label for='classe'>Classe </label>";
					echo "<select name='classe'>"; /* On cree une liste deroulante vide */

					$requete='SELECT classe from Taxonomie ORDER BY classe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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

					/* on veut recuperer les valeurs de ordre deja existantes dans la bdd */

					echo "<label for='ordre'>Ordre </label>";
					echo "<select name='ordre'>"; /* On cree une liste deroulante vide */

					$requete='SELECT ordre from Taxonomie ORDER BY ordre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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

					/* on veut recuperer les valeurs de famille deja existantes dans la bdd */

					echo "<label for='famille'>Famille </label>";
					echo "<select name='famille'>"; /* On cree une liste deroulante vide */

					$requete='SELECT famille from Taxonomie ORDER BY famille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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

					/* on veut recuperer les valeurs de sous-famille deja existantes dans la bdd */

					echo "<label for='sousFamille'>Sous-famille </label>";
					echo "<select name='sousFamille'>"; /* On cree une liste deroulante vide */

					$requete='SELECT sousfamille from Taxonomie ORDER BY sousfamille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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

					/* on veut recuperer les valeurs de genre deja existantes dans la bdd */

					echo "<label for='genre'>Genre </label>";
					echo "<select name='genre'>"; /* On cree une liste deroulante vide */

					$requete='SELECT genre from Taxonomie ORDER BY genre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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

					/* on veut recuperer les valeurs de genre deja existantes dans la bdd */

					echo "<label for='espece'>Espèce </label>";
					echo "<select name='espece'>"; /* On cree une liste deroulante vide */

					$requete='SELECT espece from Taxonomie ORDER BY espece';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
					foreach ($value as $array) { /* On parcourt les resultats possibles */
						foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
							echo "<option>$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
						}
					}

					echo "</select>";
					?>

					</fieldset>
				</form>
				</br>

				<input type="submit" name="nom" value="Valider et ajouter un nouvel individu">

			</fieldset>
		</p>
		</form>
	</body>
</html>
