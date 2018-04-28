<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';
?>

		<!-- FORMULAIRE D'AJOUT DE GROTTE -->

		<div class= "col-sm-7">
			<form method="POST" action="tableauGrotte.php">
				<input type="submit" value="Revenir au tableau des grottes" />
			</form>
			</br>
			<form  id="ajoutGrotte"  method="GET" action = "WebService/ajoutGrotteWS.php"> <!-- reference au formulaire -->
			<p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
				<!--<fieldset class="scheduler-border fieldset-auto-width">-->
					<legend class="scheduler-border"> Ajout d'une grotte </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">

							<label style="display: block; width:110px; float:left;">Nom</label>          <!-- Changer les size par rapport à la base de donnees -->
							<input required type="text" id ="nomGrotte" name="nomGrotte" size="50"/> * </br></br>

						<!--	<label style="display: block; width:110px; float:left;">Type de cavité</label>
								<select name="typeCavite" id="typeCavite">
									<option value="Choix1">Choix1</option>
									<option value="Choix2">Choix2</option>
									<option value="Choix3">Choix3</option>
								</select>-->
								<?php
								echo "<label style='display: block; width:110px; float:left;' for='TypeCavite'> Type de cavité </label>";
								echo "<select name='typeCavite' id='listeTypeCavite' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivCavite\", \"autreCavite\")'>";
								$requete='SELECT DISTINCT typeCavite from Grotte ORDER BY typeCavite';
								$value=requete($bdd,$requete);
								foreach ($value as $array) {
									foreach ($array as $key => $valeur) {
										echo "<option value=\"$valeur\">$valeur</option>";
									}
								}
                                echo "<option value='autre'>Autre</option>";
								echo "</select>";
							?>
                                <div id="autreDivCavite" style="display:none;"><input id="autreCavite" type="text" name="autre" /></div>
								&nbsp;
								<!--<input type = "button" id="affichageTypeCavite" value = "ajouter un type de cavité" onclick="affichageDiv('divTypeCavite', this.id)">-->

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
							<input type="text" id ="typeAcces" name="typeAcces" size="20"/></br></br>

							<label>Système hydrographique</label>
							<select name="systemeHydro" id='listeSystemeHydrographique'>
							<?php
							$requete='SELECT id, nom, departement, pays from SystemeHydrographique ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
							$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
							foreach ($value as $array) { /* On parcourt les resultats possibles */
                                $id = $array['id'];
                                $nom = $array['nom'];
                                $departement = $array['departement'];
                                $pays = $array['pays'];
                                echo "<option value=\"$id\">$nom $departement $pays</option>";
								//foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								//	echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
								//}
							}

							echo "</select>";

							?>
							&nbsp;
							<input type = "button" id="affichageSystemeHydrographique" value = "ajouter un système hydrographique" onclick="affichageDiv('divSystemeHydrographique', this.id)">

					    </br></br>

							<label>Accès au public </label>
							<input type="radio" id ="accesPublicOui" name="accesPublic" value="true"/>
							<label for="accesPublicOui">oui</label>
							<input type = "radio" id = "accesPublicNon" name = "accesPublic" value="false">
							<label for="accesPublicNon">non</label>

							</br>
							</br>

							<input type="submit" name="nom" value="Valider et ajouter une nouvelle grotte"> &nbsp;&nbsp;
							<input type="submit" name="nom" value="Valider et ajouter un site"> &nbsp;&nbsp;
							<input type="submit" name="nom" value="Valider et revenir au tableau des grottes"> &nbsp;&nbsp;

						</div>
					</div>
				<!--</fieldset>-->
			</p>
			</form>


		</div>

		<div class= "col-sm-3" style = "float:right; margin-top:150px;">
		<div  id="divTypeCavite" style="display:none;">
			<form  id="formTypeCavite"  method="POST" onsubmit="return ajaxAjout('./WebService/ajoutTypeCaviteWS.php', 'divTypeCavite', this.id, 'listeTypeCavite','affichageTypeCavite', 1)">
				<fieldset style = "padding-left:5px;" >
					<legend class="scheduler-border"> Ajout type cavité </legend>
						<label>Type de cavité</label>
						<input type="text" id="typeCavite" name="typeCavite" required size="20"/></br></br>
						<button type="submit">Ajouter un type de cavité</button>
						<button type="button" onclick="affichageDiv('divTypeCavite', 'affichageTypeCavite')">Annuler</button></br></br>
				</fieldset>
			</form>
		</div>
		</div>

		<div class= "col-sm-3" style = "float:right;">
		<div id="divSystemeHydrographique" style="display:none;">
				<form  id="formSystemeHydrographique"  method="post" onsubmit="return ajaxAjout('./WebService/ajoutSystemeHydrographiqueWS.php', 'divSystemeHydrographique', this.id, 'listeSystemeHydrographique','affichageSystemeHydrographique')">
					<fieldset style = "padding-left:5px;" >
						<legend class="scheduler-border"> Ajout système hydrographique </legend>
							<label>nom</label>
							<input class="valeurs" type="text" id ="nom" name="nom" required size="30"/></br></br>
							<label>département</label>
							<input class="valeurs" type="number" id ="departement" name="departement"/></br></br>
                            <label>pays</label>
                            <input class="valeurs" type="text" id ="pays" name="pays" required size="2" maxlength="2"/></br></br>
							<button type="submit">Ajouter un système hydrographique</button>
							<button type="button" onclick="affichageDiv('divSystemeHydrographique', 'affichageSystemeHydrographique')">Annuler</button></br></br>
					</fieldset>
				</form>
		</div>
		</div>
	</div>
</div>

<?php
include 'HTML/pied.html';
?>
