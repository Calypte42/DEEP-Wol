<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'consultationModification.php';
?>
		<!-- FORMULAIRE D'AJOUT D'Echantillon -->

		<form  id="ajoutIndividu"  method="GET" action = "WebService/ajoutEchantillonWS.php"> <!-- reference au formulaire -->
		<p>
			<fieldset class="scheduler-border">
				<legend class="scheduler-border"> Ajout d'un Echantillon </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">

				</br>
				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='grotte'>Grotte </label>";
				echo "<select name='grotte'>"; /* On cree une liste deroulante vide */

				$requete='SELECT NomCavite from Grotte ORDER BY NomCavite';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
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
						echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
				?>

				</br></br>

				<?php

				/* on veut recuperer les valeurs de code de piege deja existantes dans la bdd */

				echo "<label for='codePiege'>Code du piège </label>";
				echo "<select name='codePiege'>"; /* On cree une liste deroulante vide */

				$requete='SELECT codePiege from Piege ORDER BY codePiege';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
				?>
<br/>
<label for="type">Type d'echantillon :</label>
				<select name="type">
						<option value="Pool"> Pool</option>
						<option value="Individu">Individu</option>
				</select><br/>

				A faire disparaitre si le choix est Individu:

				<label for='nombreIndividu'>Nombre d'individu dans le pool : </label>
				<input type="number" name="nombreIndividu" id="nombreIndividu" />
				</br></br>

				<label>Numéro de l'Echantillon</label>
				<input required type="text" id ="numEchantillon" name="numEchantillon" size="20"/>*</br></br> <!-- recuperer la valeur precedemment remplie -->

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
				<!--<input required type="text" id ="lieuStockage" name="lieuStockage" size="20"/>*</br></br>-->
				<select name="lieuStockage" id="lieuStockage">
					<option selected value="Montpellier">Montpellier</option> <!-- par défaut -->
					<option value="Paris">Paris</option>
				</select>

				(rajouter un lieu de stokage) <input type = "button" value = "ajouter un lieu">

				</br></br>

				<label>Niveau d'identification</label>  <!-- menu deroulant -->
					<select name="niveauIdentification" id="niveauIdentification">
						<option value="hypothetique">Hypothétique</option>
						<option value="valide">Validé</option>
					</select>

		        </br></br>

				<label>Infecté par bactérie</label>  <!-- menu deroulant -->
					<select name="infecteBacterie" id="infecteBacterie">
						<option value="oui">oui</option>
						<option value="non">non</option>
						<option selected value="nonDetermine">non déterminé</option>
					</select>

				</br></br>
				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='idAuteur'>Auteur : nom </label>";
				echo "<select name='idAuteur'>"; /* On cree une liste deroulante vide */

				$requete='SELECT id,nom,prenom from Personne ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					echo "<option value=\"";
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						if($key=='id'){
							echo "$valeur\">";
						}
						else{
						echo "$valeur "; /* Que l'on ajoute dans la liste deroulante */
					}
				}
				echo "</option>";
			}
				echo "</select>";
				?>
				<input type = "button" value = "ajouter un auteur">

		        </br></br>
		        <!-- ajout des attributs de taxonomie sous forme de liste déroulante, en fieldset inclu dans le formulaire Echantillon -->
				<form  id="ajoutTaxonomie"  method="GET" action = "ajoutIndividuWS.php"> <!-- reference au formulaire -->
				<p>
					<fieldset class="scheduler-border">
						<legend class="scheduler-border"> Taxonomie </legend>
						<div class="control-group">
							<div class="controls bootstrap-timepicker">
					</br>

					<?php

					/* on veut recuperer les valeurs de classe deja existantes dans la bdd */

					echo "<label for='classe'>Classe </label>";
					echo "<select name='classe'>"; /* On cree une liste deroulante vide */


					$requete='SELECT DISTINCT classe from Taxonomie ORDER BY classe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
					foreach ($value as $array) { /* On parcourt les resultats possibles */
						foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
							echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
						}
					}

					echo "</select>";
					?>

					</br></br>

					<?php

					/* on veut recuperer les valeurs de ordre deja existantes dans la bdd */

					echo "<label for='ordre'>Ordre </label>";
					echo "<select name='ordre'>"; /* On cree une liste deroulante vide */
					echo "<option value=\"Indetermine\">Indetermine</option>";

					$requete='SELECT DISTINCT ordre from Taxonomie WHERE ordre != \'null\' ORDER BY ordre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
					foreach ($value as $array) { /* On parcourt les resultats possibles */
						foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
							echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
						}
					}

					echo "</select>";
					?>

					</br></br>

					<?php

					/* on veut recuperer les valeurs de famille deja existantes dans la bdd */

					echo "<label for='famille'>Famille </label>";
					echo "<select name='famille'>"; /* On cree une liste deroulante vide */
					echo "<option value=\"Indetermine\">Indetermine</option>";

					$requete='SELECT DISTINCT famille from Taxonomie WHERE famille != \'null\' ORDER BY famille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
					foreach ($value as $array) { /* On parcourt les resultats possibles */
						foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
							echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
						}
					}

					echo "</select>";
					?>

					</br></br>

					<?php

					/* on veut recuperer les valeurs de sous-famille deja existantes dans la bdd */

					echo "<label for='sousFamille'>Sous-famille </label>";
					echo "<select name='sousFamille'>"; /* On cree une liste deroulante vide */
					echo "<option value=\"Indetermine\">Indetermine</option>";

					$requete='SELECT DISTINCT sousfamille from Taxonomie WHERE sousFamille != \'null\' ORDER BY sousfamille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
					foreach ($value as $array) { /* On parcourt les resultats possibles */
						foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
							echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
						}
					}

					echo "</select>";
					?>

					</br></br>

					<?php

					/* on veut recuperer les valeurs de genre deja existantes dans la bdd */

					echo "<label for='genre'>Genre </label>";
					echo "<select name='genre'>"; /* On cree une liste deroulante vide */
					echo "<option value=\"Indetermine\">Indetermine</option>";

					$requete='SELECT DISTINCT genre from Taxonomie WHERE genre != \'null\' ORDER BY genre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
					foreach ($value as $array) { /* On parcourt les resultats possibles */
						foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
							echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
						}
					}

					echo "</select>";
					?>

					</br></br>

					<?php

					/* on veut recuperer les valeurs de genre deja existantes dans la bdd */

					echo "<label for='espece'>Espèce </label>";
					echo "<select name='espece'>"; /* On cree une liste deroulante vide */
					echo "<option value=\"Indetermine\">Indetermine</option>";

					$requete='SELECT DISTINCT espece from Taxonomie WHERE espece != \'null\' ORDER BY espece';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
					$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
					foreach ($value as $array) { /* On parcourt les resultats possibles */
						foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
							echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
						}
					}

					echo "</select>";
					?>

					</fieldset>
				</form>
				</br>

				<input type="submit" name="nom" value="Valider et ajouter un nouvel echantillon">

			</fieldset>
		</p>
		</form>
<?php
include 'HTML/pied.html';
?>