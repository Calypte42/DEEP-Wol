<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'consultationModification.php';
?>
		<!-- FORMULAIRE D'AJOUT DE SITE -->

		<form  id="ajoutSite"  method="POST" action = "WebService/ajoutSiteWS.php"> <!-- reference au formulaire -->
		<p>
			<fieldset class="scheduler-border">
				<legend class="scheduler-border"> Ajout d'un site </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
			</br>

				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='grotte'>Grotte</label>";
				echo "<select name='nomGrotte'>"; /* On cree une liste deroulante vide */

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

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='equipeSpeleo'>Equipe spéléo </label>";
				echo "<select name='codeEquipeSpeleo' id='listeEquipeSpeleo'>"; /* On cree une liste deroulante vide */

				$requete='SELECT codeEquipe from EquipeSpeleo';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
				?>

				(si pas dans la liste alors l'ajouter) <input type = "button" id="affichageAjoutEquipe" value = "ajouter une équipe"> <!-- rajout d'un bouton ajout d'une nouvelle équipe -->

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
				<input required type="number" id ="distanceEntree" name="distanceEntree" size="10"/> metres *</br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

				<label>Présence d'eau</label>
				<input type="radio" id ="presenceEauOui" name="presenceEau" value="true"/>
				<label for="presenceEauOui">oui</label>
				<input type = "radio" id = "presenceEauNon" name = "presenceEau" value="false">
				<label for="presenceEauNon">non</label>

				</br>
				</br>

				<input type="submit" name="nom" value="Valider et ajouter un nouveau site"> &nbsp;&nbsp;
				<input type="submit" name="nom" value="Valider et ajouter un nouveau piege">

			</fieldset>
		</p>
		</form>

        <div id="divEquipeSpeleo" style="display:none;">
            <form  id="formEquipeSpeleo"  method="POST">
                <label>Equipe spéleo</label>
                <input type="text" id="codeEquipe" name="codeEquipe" required size="20"/> *
                <button type="submit">Ajouter une équipe</button></br></br>
            </form>
        </div>

<?php
include 'HTML/pied.html';
?>
