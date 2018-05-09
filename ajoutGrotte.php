<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';
?>

		<!-- FORMULAIRE D'AJOUT DE GROTTE -->

		<div class= "col-sm-7">
			<form action="tableauGrotte.php">
				<input type="submit" value="Revenir au tableau des grottes" />
			</form>
			</br>
			<form  id="ajoutGrotte"  method="POST" action = "WebService/ajoutGrotteWS.php" onsubmit="return controleGrotte(this);"> <!-- reference au formulaire -->
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
								echo "<label style='display: block; width:110px; float:left;' for='typeCavite'> Type de cavité </label>";
								echo "<select name='typeCavite' id='typeCavite' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivCavite\", \"autreCavite\")'>";
								$requete='SELECT DISTINCT typeCavite from Grotte ORDER BY typeCavite';
								$value=requete($bdd,$requete);
								foreach ($value as $array) {
									foreach ($array as $key => $valeur) {
                                        if ($valeur != "Indéterminé") {
                                            echo "<option value=\"$valeur\">$valeur</option>";
                                        }
									}
								}
                                echo "<option value='Indéterminé'>Indéterminé</option>";
                                echo "<option value='autre'>Autre</option>";
								echo "</select>";
							?>
                                <div id="autreDivCavite" style="display:none;">Ajouter un type de cavité : <input id="autreCavite" type="text" name="autreCavite" /> *</div>
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

							<label style="display: block; width:110px; float:left;" for='typeAcces'>Type d'accès</label>
                        <?php
                            echo "<select name='typeAcces' id='typeAcces' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivTypeAcces\", \"autreTypeAcces\")'>";
                            $requete='SELECT DISTINCT typeAcces from Grotte ORDER BY typeAcces';
                            $value=requete($bdd,$requete);
                            foreach ($value as $array) {
                                foreach ($array as $key => $valeur) {
                                    if ($valeur != "Indéterminé") {
                                        echo "<option value=\"$valeur\">$valeur</option>";
                                    }
                                }
                            }
                            echo "<option value='Indéterminé'>Indéterminé</option>";
                            echo "<option value='autre'>Autre</option>";
                            echo "</select>";
                        ?>
                            <div id="autreDivTypeAcces" style="display:none;">Ajouter un type d'accès : <input id="autreTypeAcces" type="text" name="autreTypeAcces" /> *</div>

                            </br></br>

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
                            <input type = "radio" id="accesPublicNull" name = "accesPublic" value="NULL" checked>
        					<label for="accesPublicNull">indéterminé</label>

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

		<div class= "col-sm-3" style = "float:right;">
		<div id="divSystemeHydrographique" style="display:none;">
				<form  id="formSystemeHydrographique"  method="post" onsubmit="return ajaxAjout('./WebService/ajoutSystemeHydrographiqueWS.php', 'divSystemeHydrographique', this.id, 'listeSystemeHydrographique','affichageSystemeHydrographique')">
					<fieldset style = "padding-left:5px;" >
						<legend class="scheduler-border"> Ajout système hydrographique </legend>
							<label>nom</label>
							<input class="valeurs" type="text" id ="nom" name="nom" required size="30" maxlength="30"/></br></br>
							<label>département</label>
							<input class="valeurs" type="number" id ="departement" name="departement"/></br></br>
              <label>pays</label>
              <input class="valeurs" placeholder="FR" type="text" id ="pays" name="pays" required size="4" maxlength="4"/></br></br>
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
