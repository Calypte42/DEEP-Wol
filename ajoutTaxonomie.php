<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

			<!-- FORMULAIRE D'AJOUT DE LA TAXONOMIE -->
			<div class= "col-sm-10">
			<form  id="ajoutTaxonomie"  method="GET" action = "WebService/ajoutTaxonomieWS.php"> <!-- reference au formulaire -->
			<p>
				<!--<fieldset class="scheduler-border">-->
					<legend class="scheduler-border"> Ajout d'une taxonomie </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">
						</br>

						<fieldset class="scheduler-border">
							<legend class="scheduler-border"> Taxonomie </legend>
							<div class="control-group">
								<div class="controls bootstrap-timepicker">
								</br>
									<?php
									/* on veut recuperer les valeurs de classe deja existantes dans la bdd */
									echo "<label style='display: block; width:100px; float:left;' for='classe'>Classe </label>";
									echo "<select name='classeTaxo'>"; /* On cree une liste deroulante vide */
									$requete='SELECT DISTINCT classe from Taxonomie ORDER BY classe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
									$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
									foreach ($value as $array) { /* On parcourt les resultats possibles */
										foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
											echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
										}
									}
									echo "<option value='null' selected>Nouvelle</option>";
									echo "</select>";
									?>

									</br></br>

									<?php
									/* on veut recuperer les valeurs de ordre deja existantes dans la bdd */
									echo "<label style='display: block; width:100px; float:left;' for='ordre'>Ordre </label>";
									echo "<select name='ordreTaxo'>"; /* On cree une liste deroulante vide */
									echo "<option value=\"Nouveau\">Nouveau</option>";
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
									echo "<label style='display: block; width:100px; float:left;' for='famille'>Famille </label>";
									echo "<select name='familleTaxo'>"; /* On cree une liste deroulante vide */
									echo "<option value=\"Nouveau\">Nouveau</option>";
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
									echo "<label style='display: block; width:100px; float:left;' for='sousFamille'>Sous-famille </label>";
									echo "<select name='sousFamilleTaxe'>"; /* On cree une liste deroulante vide */
									echo "<option value=\"Nouveau\">Nouveau</option>";
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
									echo "<label style='display: block; width:100px; float:left;' for='genre'>Genre </label>";
									echo "<select name='genreTaxo'>"; /* On cree une liste deroulante vide */
									echo "<option value=\"Nouveau\">Nouveau</option>";
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

							<label style="display: block; width:100px; float:left;">Classe</label>
							<input type="text" id ="classeTaxo" name="classeTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Ordre</label>
							<input type="text" id ="ordreTaxo" name="ordreTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Famille</label>
							<input type="text" id ="familleTaxo" name="familleTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Sous-famille</label>
							<input type="text" id ="sousFamilleTaxo" name="sousFamilleTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Genre</label>
							<input type="text" id ="genreTaxo" name="genreTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Espèce</label>
							<input type="text" id ="especeTaxo" name="especeTaxo" size="40"/></br></br>

			   			<label style="display: block; width:100px; float:left;">Photo</label>
							<input type="file" id ="photo" name="photo"/></br></br>

							<input type="submit" name="nom" value="Valider et ajouter une nouvelle taxonomie">
							<input type="submit" name='nom' value="Valider et revenir au tableau" />

						</div>
					</div>
			<!--</fieldset>-->
			</p>
			</form>
		</div>
	</div>
</div>

<?php
include 'HTML/pied.html';
?>
