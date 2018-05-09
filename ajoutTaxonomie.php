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
	<form  id="ajoutTaxonomie"  method="POST" action = "WebService/ajoutTaxonomieWS.php"> <!-- reference au formulaire -->
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
						echo "<select name='' id='selectClasseTaxo'>"; /* On cree une liste deroulante vide */
						$requete='SELECT DISTINCT classe from Taxonomie ORDER BY classe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
							}
						}
						echo "<option value='Nouveau' selected>Nouvelle</option>";
						echo "</select>";
						?>

						<input type="text" id ="classeTaxo" name="classeTaxo" size="30" placeholder="Entrez ici le nom de l'element" /></br></br>

						<?php
						/* on veut recuperer les valeurs de ordre deja existantes dans la bdd */
						echo "<label style='display: block; width:100px; float:left;' for='ordre'>Ordre </label>";
						echo "<select name='' id='selectOrdreTaxo'>"; /* On cree une liste deroulante vide */
						echo "<option value=\"Nouveau\">Nouveau</option>";
						$requete='SELECT DISTINCT ordre from Taxonomie WHERE ordre != \'\' ORDER BY ordre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
							}
						}
						echo "</select>";
						?>

						<input type="text" id ="ordreTaxo" name="ordreTaxo" size="30" placeholder="Entrez ici le nom de l'element"/></br></br>

						<?php
						/* on veut recuperer les valeurs de famille deja existantes dans la bdd */
						echo "<label style='display: block; width:100px; float:left;' for='famille'>Famille </label>";
						echo "<select name='' id='selectFamilleTaxo'>"; /* On cree une liste deroulante vide */
						echo "<option value=\"Nouveau\">Nouvelle</option>";
						$requete='SELECT DISTINCT famille from Taxonomie WHERE famille != \'\' ORDER BY famille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
							}
						}
						echo "</select>";
						?>

						<input type="text" id ="familleTaxo" name="familleTaxo" size="30" placeholder="Entrez ici le nom de l'element"/></br></br>

						<?php
						/* on veut recuperer les valeurs de sous-famille deja existantes dans la bdd */
						echo "<label style='display: block; width:100px; float:left;' for='sousFamille'>Sous-famille </label>";
						echo "<select name='' id='selectSousFamilleTaxo'>"; /* On cree une liste deroulante vide */
						echo "<option value=\"Nouveau\">Nouvelle</option>";
						$requete='SELECT DISTINCT sousfamille from Taxonomie WHERE sousFamille != \'\' ORDER BY sousfamille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
							}
						}
						echo "</select>";
						?>

						<input type="text" id ="sousFamilleTaxo" name="sousFamilleTaxo" size="30" placeholder="Entrez ici le nom de l'element"/></br></br>

						<?php
						/* on veut recuperer les valeurs de genre deja existantes dans la bdd */
						echo "<label style='display: block; width:100px; float:left;' for='genre'>Genre </label>";
						echo "<select name='' id='selectGenreTaxo'>"; /* On cree une liste deroulante vide */
						echo "<option value=\"Nouveau\">Nouveau</option>";
						$requete='SELECT DISTINCT genre from Taxonomie WHERE genre != \'\' ORDER BY genre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
							}
						}
						echo "</select>";
						?>

						<input type="text" id ="genreTaxo" name="genreTaxo" size="30" placeholder="Entrez ici le nom de l'element"/></br></br>

						<label style="display: block; width:100px; float:left;">Espèce</label>
						<input type="text" id ="especeTaxo" name="especeTaxo" size="30" placeholder="Entrez ici le nom de l'element"/></br></br>

						<label style="display: block; width:100px; float:left;">Photo</label>
						<input type="file" id ="photo" name="photo" accept="image/*"/></br></br>

						<input type="submit" name="nom" value="Valider et ajouter une nouvelle taxonomie">
						<?php
						if(isset($_REQUEST['idEchantillon'])){
							echo "<input type='submit' name='nom' value='Valider et revenir au tableau'>";
						}
						?>

					</div>
				</div>
				<!--</fieldset>-->
			</p>
		</form>
	</div>
</div>
</div>
<script src="./javascript/ajoutTaxonomie.js" type="text/javascript"></script>

<?php
include 'HTML/pied.html';
?>
