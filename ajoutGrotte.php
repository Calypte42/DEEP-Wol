<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';
?>

        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<!-- FORMULAIRE D'AJOUT DE GROTTE -->

		<div class= "col-sm-7">
			<form action="tableauGrotte.php">
				<input type="submit" value="Revenir au tableau des grottes" />
			</form>
			</br>
			<form  id="ajoutGrotte"  method="POST" action = "WebService/ajoutGrotteWS.php" onsubmit="return controleGrotte(this, false);"> <!-- reference au formulaire -->
			<p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->

					<legend class="scheduler-border"> Ajout d'une grotte </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">

							<label style="display: block; width:110px; float:left;">Nom</label>          <!-- Changer les size par rapport à la base de donnees -->
							<input required type="text" id ="nomGrotte" name="nomGrotte" size="50"/> * </br></br>


								<?php
								echo "<label style='display: block; width:110px; float:left;' for='typeCavite'> Type de cavité </label>";
								echo "<select style='width:200px;' data-placeholder='Choisissez un type de cavité...' class='chosen-select' name='typeCavite' id='typeCavite' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivCavite\", \"autreCavite\")'>";
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
                                echo "<option value='autre'>[Ajouter]</option>";
								echo "</select>";
							?>
                                <div id="autreDivCavite" style="display:none;">Ajouter un type de cavité : <input id="autreCavite" type="text" name="autreCavite" /> *</div>
								&nbsp;


					    </br></br>

							<label style="display: block; width:110px; float:left;">Latitude</label>
							<input type="number" step="any" id ="latitude" name="latitude1" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
							°
							<input type="number"  step="any"  id ="latitude2" name="latitude2" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
							'
							<input type="number" step="any"  id ="latitude3" name="latitude3" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
							"
							<select name="orientationLatitude" id="orientationLatitude">
								<option selected value="Nord">Nord</option>
								<option value="Sud">Sud</option>
							</select>

							</br></br>

							<label style="display: block; width:110px; float:left;">Longitude</label>
							<input type="number"  step="any" id ="longitude" name="longitude1" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
							°
							<input type="number"  step="any" id ="longitude2" name="longitude2" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
							'
							<input type="number"  step="any" id ="longitude3" name="longitude3" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
							"
							<select name="orientationLongitude" id="orientationLongitude">
								<option selected value="Est">Est</option>
								<option value="Ouest">Ouest</option>
							</select>

							</br></br>

							<label style="display: block; width:110px; float:left;" for='typeAcces'>Type d'accès</label>
                        <?php
                            echo "<select style='width:200px;' data-placeholder='Choisissez un type d'accès'...' class='chosen-select' name='typeAcces' id='typeAcces' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivTypeAcces\", \"autreTypeAcces\")'>";
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
                            echo "<option value='autre'>[Ajouter]</option>";
                            echo "</select>";
                        ?>
                            <div id="autreDivTypeAcces" style="display:none;">Ajouter un type d'accès : <input id="autreTypeAcces" type="text" name="autreTypeAcces" /> *</div>

                            </br></br>

							<label>Système hydrographique</label>
							<select style='width:200px;' data-placeholder='Choisissez un système hydrographique...' class='chosen-select' name="systemeHydro" id='listeSystemeHydrographique' onchange="ajoutDiv(this.options[this.selectedIndex].value, 'divSystemeHydrographique')">
							<?php
                            echo "<option disabled selected value></option>";
                            $requete='SELECT id, nom, departement, pays from SystemeHydrographique ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
							$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
							foreach ($value as $array) { /* On parcourt les resultats possibles */
                                $id = $array['id'];
                                $nom = $array['nom'];
                                $departement = $array['departement'];
                                $pays = $array['pays'];
                                echo "<option value=\"$id\">$nom $departement $pays</option>";

							}
                            echo "<option value='autre'>[Ajouter]</option>";
							echo "</select>";

							?>

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
			</p>
			</form>


		</div>

		<div class= "col-sm-3" style = "float:right;">
		<div id="divSystemeHydrographique" style="display:none;">
				<form  id="formSystemeHydrographique"  method="post" onsubmit="return ajaxAjout('./WebService/ajoutSystemeHydrographiqueWS.php', 'divSystemeHydrographique', this.id, 'listeSystemeHydrographique')">
					<fieldset style = "padding-left:5px;" >
						<legend class="scheduler-border"> Ajout système hydrographique </legend>
							<label>nom</label>
							<input class="valeurs" type="text" id ="nom" name="nom" required size="30" maxlength="30"/></br></br>
							<label>département</label>
							<input class="valeurs" type="number" id ="departement" name="departement"/></br></br>
              <label>pays</label>
              <input class="valeurs" placeholder="FR" type="text" id ="pays" name="pays" required size="4" maxlength="4"/></br></br>
							<button type="submit">Ajouter un système hydrographique</button></br></br>
					</fieldset>
				</form>
		</div>
		</div>
	</div>
</div>

<?php
include 'HTML/pied.html';
?>
