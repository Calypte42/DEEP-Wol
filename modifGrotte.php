<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Grotte WHERE id=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$grotte=requete($bdd,$requete); /* value recupere la reponse de la requete */
?>


		<!-- FORMULAIRE D'AJOUT DE GROTTE -->
			<div class= "col-sm-10">
			<form method="POST" action="tableauGrotte.php">
				<input type="submit" value="Revenir au tableau des grottes" />
			</form>

			</br>

			<form  id="ajoutGrotte"  method="POST" action = "WebService/modifGrotteWS.php"> <!-- reference au formulaire -->
			<p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
			<!--<fieldset class="scheduler-border fieldset-auto-width">-->
				<legend class="scheduler-border"> Modification de la <?=$grotte[0]['nomcavite']?></legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
					</br>
          <input type="hidden" name="id" value="<?=$_GET['id']?>"/>

					<label style="display: block; width:110px; float:left;">Nom</label>          <!-- Changer les size par rapport à la base de donnees -->
					<input required type="text" id ="nomGrotte" name="nomGrotte" value="<?=$grotte[0]['nomcavite']?>" size="50"/> * </br></br>

					<!--<label style="display: block; width:110px; float:left;">Type de cavité</label>
						<select name="typeCavite" id="typeCavite">
							<option value="Standard">Standard</option>
							<option value="Choix2">Choix2</option>
							<option value="Choix3">Choix3</option>
						</select>-->
						<?php
						echo "<label style='display: block; width:110px; float:left;' for='TypeCavite'> Type de cavité </label>";
						echo "<select name='typeCavite'>";
						$requete='SELECT DISTINCT typeCavite from Grotte ORDER BY typeCavite';
						$value=requete($bdd,$requete);
						foreach ($value as $array) {
							foreach ($array as $key => $valeur) {
								echo "<option value=\"$valeur\">$valeur</option>";
							}
						}
						echo "</select>";
					?>
						&nbsp;
						<input type = "button" id="affichageTypeCavite" value = "ajouter un type de cavité" onclick=""> <!-- rajout d'un bouton ajout d'une nouvelle équipe -->



		      </br></br>

					<label style="display: block; width:110px; float:left;">Latitude</label>
					<input type="text" id ="latitude" name="latitude1" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
					°
					<input type="text" id ="latitude2" name="latitude2" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
					'
					<input type="text" id ="latitude3" name="latitude3" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
					"
					<select name="orientationLatitude" id="orientationLatitude">
						<option selected value="Nord">Nord</option>
						<option value="Sud">Sud</option>
					</select>

					</br></br>

					<label style="display: block; width:110px; float:left;">Longitude</label>
					<input type="text" id ="longitude" name="longitude1" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
					°
					<input type="text" id ="longitude2" name="longitude2" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
					'
					<input type="text" id ="longitude3" name="longitude3" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
					"
					<select name="orientationLongitude" id="orientationLongitude">
						<option selected value="Est">Est</option>
						<option value="Ouest">Ouest</option>
					</select>

					</br></br>

					<label style="display: block; width:110px; float:left;">Type d'accès</label>
					<input type="text" id ="typeAcces" name="typeAcces" value="<?=$grotte[0]['typeacces']?>" size="20"/></br></br>

					<label>Système hydrographique</label>
						<select name="systemeHydro" id='listeSystemeHydrographique'>
						<?php
						$requete='SELECT id, nom from SystemeHydrographique ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
		        	$nom = $array['nom'];
		          $id = $array['id'];
		          echo "<option value=\"$id\"";
		          if ($grotte[0]['idsystemehydrographique']==$array['id']) {
		          	echo "selected";
		          }
		          echo ">$nom</option>";
						}
						echo "</select>";
						?>

						<input type = "button" id="affichageSystemeHydrographique" value = "ajouter un système hydrographique">

		        </br></br>

						<label>Accès au public</label>&nbsp;&nbsp;
						<?php
            echo "<input type='radio' id ='accesPublicOui' name='accesPublic' value='true'";
            if ($grotte[0]['accespublic']) {
            	echo "checked";
            }
            echo "/>";
            echo "<label for='accesPublicOui'>&nbsp;&nbsp;oui&nbsp;&nbsp;</label>";
            echo "<input type='radio' id='accesPublicNon' name='accesPublic' value='false'";
            if ($grotte[0]['accespublic']) {
            	echo "checked";
            }
            echo "/>";
            echo "<label for='accesPublicNon'>&nbsp;&nbsp;non&nbsp;&nbsp;</label>";
						?>

						</br></br>

						<input type="submit" name="nom" value="Valider les modifications et revenir au tableau des grottes"> &nbsp;&nbsp;

					</div>
				</div>
			<!--</fieldset>-->
		</p>
		</form>

	    <div id="divSystemeHydrographique" style="display:none;">
	        <form  id="formSystemeHydrographique"  method="post">
	            <label>nom</label>
	            <input type="text" id ="nom" name="nom" required size="30"/></br></br>
	            <label>département</label>
	            <input type="number" id ="departement" name="departement"/></br></br>
	            <button type="submit">Ajouter un système hydrographique</button></br></br>
	        </form>
			</div>
		</div>
	</div>
</div>

<?php
include 'HTML/pied.html';
?>
