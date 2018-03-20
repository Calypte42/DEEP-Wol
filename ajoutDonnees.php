<?php
include 'bdd.php';
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
		<!-- FORMULAIRE D'AJOUT DE GROTTE -->

		<form  id="ajoutGrotte"  method="post" action = ""> <!-- reference au forumlaire -->
		<p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
			<fieldset>
			<legend>Ajout d'une grotte</legend>
			</br>
				<label>Nom de la grotte</label>          <!-- Changer les size par rapport à la base de donnees -->
				<input required type="text" id ="nomGrotte" name="nomGrotte" size="15"/> * </br></br>

				<label>Type de cavité</label>  <!-- menu deroulant : a preciser les valeurs -->
					<select name="typeCavite" id="typeCavite">
						<option value="">Choix1</option>
						<option value="">Choix2</option>
						<option value="">Choix3</option>
					</select>

		        </br></br>

				<label>Latitude</label>
				<input type="text" id ="latitude" name="latitude" size="15" placeholder = "30° N"/></br></br>  <!-- type text pour simplifier la saisie -->

				<label>Longitude</label>
				<input type="text" id ="longitude" name="longitude" size="15" placeholder = "20° O"/></br></br>  <!-- type text pour simplifier la saisie -->

				<label>Type d'accès</label>
				<input type="text" id ="typeAcces" name="typeAcces" size="15"/></br></br>

				<label>Système hydrographique</label>
				<input type="text" id ="systemeHydro" name="systemeHydro" size="15"/></br></br>

				<label>Accès au public </label>
				<!--Ne pas mettre le meme id, rajouter la value
				<input type="radio" id ="accesPublic" name="accesPublic"/> oui
				<input type = "radio" id = "accesPublic" name = "accesPublic"> non-->

				<input type="radio" id ="accesPublicOui" name="accesPublic" value="oui"/>
				<label for="accesPublicOui">oui</label>
				<input type = "radio" id = "accesPublicNon" name = "accesPublic" value="non">
				<label for="accesPublicNon">non</label>

				</br>
				</br>

				<input type="submit" name="nom" value=" Valider et ajouter une nouvelle grotte"> &nbsp;&nbsp;
				<input type="submit" name="nom" value=" Valider et aller à la page suivante">

			</fieldset>
		</p>
		</form>

		</br>

		<!-- FORMULAIRE D'AJOUT DE SITE -->

		<form  id="ajoutSite"  method="post" action = ""> <!-- reference au forumlaire -->
		<p>
			<fieldset>
			<legend>Ajout d'un site</legend>
			</br>

				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='grotte'>Grotte : </label>";
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

				<label>Equipe spéleo</label>
				<input type="text" id ="equipe" name="equipe" size="15"/></br></br>

				<label>Numéro de site</label>
				<input required = "required" type="text" id ="numSite" name="numSite" size="15"/> * </br></br>

				<label>Profondeur</label>
				<!-- Mettre number -->
				<input type="number" id ="profondeur" name="profondeur" size = "5" placeholder="15"/></br></br>

				<!-- Mettre number -->
				<label>Temperature</label>
				<input type="number" id ="temperature" name="temperature" size = "5" placeholder = "10°C"/>°C</br></br> <!-- type text pour simplifier la saisie -->

				<label>Type de sol</label>
				<input type="text" id ="systemeHydro" name="systemeHydro" size="15"/></br></br>
				<!-- Mettre number -->
				<label>Distance à l'entrée (en mètre)</label>
				<input type="number" id ="systemeHydro" name="systemeHydro" size="15"/></br></br>

				<label>Présence d'eau</label>
				<!--
				<input type="radio" id ="presenceEeau" name="presenceEeau"/> oui
				<input type = "radio" id = "presenceEeau" name = "presenceEeau"> non -->

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

		</br>

		<!-- FORMULAIRE D'AJOUT DE PIEGE -->

		<form  id="ajoutPiege"  method="post" action = ""> <!-- reference au forumlaire -->
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
				<input type="text" id ="CodePiege" name="CodePiege" size="15"/></br></br>

				<label>Date de pose</label>
				<input type="date" id ="datePose" name="datePose"/></br></br>

				<label>Heure de pose</label>
				<input type="time" id ="heurePose" name="heurePose"/></br></br>

				<label>Date de récupération</label>
				<input type="date" id ="dateRecup" name="dateRecup"/></br></br> <!-- type text pour simplifier la saisie -->

				<label>Heure de récupération</label>
				<input type="time" id ="heureRecup" name="heureRecup" size="15"/></br></br>

				<label>Date de tri</label>
				<input type="date" id ="dateTri" name="dateTri"/></br></br>

				<label>Problèmes recontrés</label> </br>
				<textarea id="probleme" name="probleme" rows = "5" cols = "30"></textarea>

				</br>
				</br>

				<input type="submit" name="nom" value=" Valider et ajouter un nouveau piege"> &nbsp;&nbsp;
				<input type="submit" name="nom" value=" Valider et aller à la page suivante">

			</fieldset>
		</p>
		</form>

		</br>

		<!-- FORMULAIRE D'AJOUT D'INDIVIDU -->

		<form  id="ajoutIndividu"  method="post" action = ""> <!-- reference au forumlaire -->
		<p>
			<fieldset>
			<legend>Ajout d'un individu</legend>
			</br>

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
				<input type="text" id ="numIndiv" name="numIndiv" size="15"/></br></br> <!-- recuperer la valeur precedemment remplie -->

				<label>Forme de stockage</label>  <!-- menu deroulant -->
					<select name="formeStockage" id="formeStockage">
						<option value="individuEntier" selected = "selected">Individu entier</option> <!-- par défaut -->
						<option value="ADNextraitChelex">ADN extrait chelex</option>
						<option value="ADNextraitColonne">ADN extrait colonne</option>
						<option value="EnrichissementGenomeBacterien">Enrichissement génome bactérien</option>
					</select>

		        </br></br>

				<label>Lieu de stockage</label>
				<input type="text" id ="lieuStockage" name="lieuStockage" size="15"/></br></br>

				<label>Niveau d'identification</label>  <!-- menu deroulant -->
					<select name="formeStockage" id="formeStockage">
						<option value="hypothetique">Hypothétique</option>
						<option value="valide">Validé</option>
					</select>

		        </br></br>

				<label>Infecté par bactérie</label>  <!-- menu deroulant -->
					<select name="infectionBacterie" id="InfectionBacterie">
						<option value="oui">oui</option>
						<option value="non">non</option>
						<option selected value="nonDetermine">non déterminé</option>
					</select>

		        </br></br>
				<input type="submit" name="nom" value=" Valider et ajouter un nouvel individu">

			</fieldset>
		</p>
		</form>

		</br>

		<!-- FORMULAIRE D'AJOUT DE LA TAXONOMIE -->

		<form  id="ajoutTaxonomie"  method="post" action = ""> <!-- reference au forumlaire -->
		<p>
			<fieldset>
			<legend>Ajout d'une taxonomie</legend>
			</br>

				<label>Classe</label>
				<input type="text" id ="classeTaxo" name="classeTaxo" size="15"/></br></br>

		        <label>Ordre</label>
				<input type="text" id ="ordreTaxo" name="ordreTaxo" size="15"/></br></br>

		        <label>Famille</label>
				<input type="text" id ="familleTaxo" name="familleTaxo" size="15"/></br></br>

		        <label>Sous-famille</label>
				<input type="text" id ="sousFamilleTaxo" name="sousFamilleTaxo" size="15"/></br></br>

		        <label>Genre</label>
				<input type="text" id ="genreTaxo" name="genreTaxo" size="15"/></br></br>

		        <label>Espèce</label>
				<input type="text" id ="especeTaxo" name="especeTaxo" size="15"/></br></br>

		        <label>Photo</label>
				<input type="file" id ="photo" name="photo" size="15" placeholder = "lien de la photo"/></br></br>

				<input type="submit" name="nom" value=" Valider et ajouter une nouvelle taxonomie">

			</fieldset>
		</br>

		<!-- FORMULAIRE D'AJOUT D'UN GENE -->

		<form  id="ajoutGene"  method="post" action = ""> <!-- reference au forumlaire -->
		<p>
			<fieldset>
			<legend>Ajout d'un gène</legend>
			</br>

				<label>Nom</label>
				<input type="text" id ="nomGene" name="nomGene" size="15"/></br></br>

		        </br>

				<input type="submit" name="nom" value=" Valider et ajouter un nouveau gène">

			</fieldset>
		</p>
		</form>



	</body>
