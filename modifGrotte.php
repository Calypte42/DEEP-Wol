<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Grotte WHERE id=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$grotte=requete($bdd,$requete);
?>

        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<!-- FORMULAIRE D'AJOUT DE GROTTE -->

		<div class= "col-sm-7">
			<form action="tableauGrotte.php">
				<input type="submit" value="Revenir au tableau des grottes" />
			</form>
			</br>
			<form  id="modifGrotte"  method="POST" action = "WebService/modifGrotteWS.php" onsubmit="return controleGrotte(this, true);"> <!-- reference au formulaire -->
			<p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->

					<legend class="scheduler-border"> Modification de la grotte : <?=$grotte[0]['nomcavite']?> </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">

                            <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
                            <input type="hidden" name="nomCavitePrecedent" value="<?=$grotte[0]['nomcavite']?>"/>

							<label style="display: block; width:110px; float:left;">Nom</label>          <!-- Changer les size par rapport à la base de donnees -->
							<input required type="text" id ="nomGrotte" name="nomGrotte" size="50" value="<?=$grotte[0]['nomcavite']?>"/> * </br></br>


								<?php
								echo "<label style='display: block; width:110px; float:left;' for='typeCavite'> Type de cavité </label>";
								echo "<select style='width:200px;' data-placeholder='Choisissez un type de cavité...' class='chosen-select' name='typeCavite' id='typeCavite' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivCavite\", \"autreCavite\")'>";
								$requete='SELECT DISTINCT typeCavite from Grotte ORDER BY typeCavite';
								$value=requete($bdd,$requete);
								foreach ($value as $array) {
									foreach ($array as $key => $valeur) {
                                        if ($valeur != "") {
                                            if ($grotte[0]['typecavite'] == $valeur){
                                                echo "<option selected value=\"$valeur\">$valeur</option>";
                                            } else {
                                                echo "<option value=\"$valeur\">$valeur</option>";
                                            }

                                        }
									}
								}
                                if ($grotte[0]['typecavite'] == "") {
                                    echo "<option selected value='Indéterminé'>Indéterminé</option>";
                                } else {
                                    echo "<option value='Indéterminé'>Indéterminé</option>";
                                }
                                echo "<option value='autre'>[Ajouter]</option>";
								echo "</select>";
							?>
                                <div id="autreDivCavite" style="display:none;">Ajouter un type de cavité : <input id="autreCavite" type="text" name="autreCavite" /> *</div>
								&nbsp;


					    </br></br>

                            <?php
                            if (!empty($grotte[0]['latitude'])) {
                                $latitude = $grotte[0]['latitude'];
                                $latitudeA = explode("°", $latitude);
                                $latitude1 = $latitudeA[0];
                                if (!empty($latitudeA[1]) and trim($latitudeA[1])!="Nord" and trim($latitudeA[1])!="Sud") {
                                    $latitudeB = explode("'", $latitudeA[1]);
                                    $latitude2 = $latitudeB[0];
                                    if (!empty($latitudeB[1]) and trim($latitudeB[1])!="Nord" and trim($latitudeB[1])!="Sud") {
                                        $latitudeC = explode("\"", $latitudeB[1]);
                                        $latitude3 = $latitudeC[0];
                                        $orientationLatitude = trim($latitudeC[1]);
                                    } else {
                                        $latitude3 = "";
                                        $orientationLatitude = trim($latitudeB[1]);
                                    }
                                } else {
                                    $latitude2 = "";
                                    $latitude3 = "";
                                    $orientationLatitude = trim($latitudeA[1]);
                                }
                            } else {
                                $latitude1 = "";
                                $latitude2 = "";
                                $latitude3 = "";
                                $orientationLatitude = null;
                            }
                            ?>

							<label style="display: block; width:110px; float:left;">Latitude</label>
							<input type="number" id ="latitude" name="latitude1" value="<?=$latitude1?>" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
							°
							<input type="number" id ="latitude2" name="latitude2" value="<?=$latitude2?>" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
							'
							<input type="number" id ="latitude3" name="latitude3" value="<?=$latitude3?>" size="5" placeholder = "30"/>  <!-- type text pour simplifier la saisie -->
							"
							<select name="orientationLatitude" id="orientationLatitude">
                                <?php
                                if ($orientationLatitude == "Nord") {
                                    echo "<option selected value='Nord'>Nord</option>";
                                    echo "<option value='Sud'>Sud</option>";
                                } else {
                                    echo "<option value='Nord'>Nord</option>";
                                    echo "<option selected value='Sud'>Sud</option>";
                                }
                                ?>
							</select>

							</br></br>

                            <?php
                            if (!empty($grotte[0]['longitude'])) {
                                $longitude = $grotte[0]['longitude'];
                                $longitudeA = explode("°", $longitude);
                                $longitude1 = $longitudeA[0];
                                if (!empty($longitudeA[1]) and trim($longitudeA[1])!="Est" and trim($longitudeA[1])!="Ouest") {
                                    $longitudeB = explode("'", $longitudeA[1]);
                                    $longitude2 = $longitudeB[0];
                                    if (!empty($longitudeB[1]) and trim($longitudeB[1])!="Est" and trim($longitudeB[1])!="Ouest") {
                                        $longitudeC = explode("\"", $longitudeB[1]);
                                        $longitude3 = $longitudeC[0];
                                        $orientationLongitude = trim($longitudeC[1]);
                                    } else {
                                        $longitude3 = "";
                                        $orientationLongitude = trim($longitudeB[1]);
                                    }
                                } else {
                                    $longitude2 = "";
                                    $longitude3 = "";
                                    $orientationLongitude = trim($longitudeA[1]);
                                }
                            } else {
                                $longitude1 = "";
                                $longitude2 = "";
                                $longitude3 = "";
                                $orientationLongitude = null;
                            }
                            ?>

							<label style="display: block; width:110px; float:left;">Longitude</label>
							<input type="number" id ="longitude" name="longitude1" value="<?=$longitude1?>" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
							°
							<input type="number" id ="longitude2" name="longitude2" value="<?=$longitude2?>" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
							'
							<input type="number" id ="longitude3" name="longitude3" value="<?=$longitude3?>" size="5" placeholder = "20"/>  <!-- type text pour simplifier la saisie -->
							"
							<select name="orientationLongitude" id="orientationLongitude">
                                <?php
                                if ($orientationLongitude == "Est") {
                                    echo "<option selected value='Est'>Est</option>";
                                    echo "<option value='Ouest'>Ouest</option>";
                                } else {
                                    echo "<option value='Est'>Est</option>";
                                    echo "<option selected value='Ouest'>Ouest</option>";
                                }
                                ?>
							</select>

							</br></br>

							<label style="display: block; width:110px; float:left;" for='typeAcces'>Type d'accès</label>
                        <?php
                            echo "<select style='width:200px;' data-placeholder='Choisissez un type d'accès...' class='chosen-select' name='typeAcces' id='typeAcces' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivTypeAcces\", \"autreTypeAcces\")'>";
                            $requete='SELECT DISTINCT typeAcces from Grotte ORDER BY typeAcces';
                            $value=requete($bdd,$requete);
                            foreach ($value as $array) {
                                foreach ($array as $key => $valeur) {
                                    if ($valeur != "") {
                                        if ($grotte[0]['typeacces'] == $valeur){
                                            echo "<option selected value=\"$valeur\">$valeur</option>";
                                        } else {
                                            echo "<option value=\"$valeur\">$valeur</option>";
                                        }
                                    }
                                }
                            }
                            if ($grotte[0]['typeacces'] == "") {
                                echo "<option selected value='Indéterminé'>Indéterminé</option>";
                            } else {
                                echo "<option value='Indéterminé'>Indéterminé</option>";
                            }
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
                                if ($grotte[0]['idsystemehydrographique']==$array['id']) {
                                    echo "<option selected value=\"$id\">$nom $departement $pays</option>";
                                } else {
                                    echo "<option value=\"$id\">$nom $departement $pays</option>";
                                }

							}
                            echo "<option value='autre'>[Ajouter]</option>";
							echo "</select>";

							?>

					    </br></br>

							<label>Accès au public </label>
                            <?php
                            echo "<input type='radio' id ='accesPublicOui' name='accesPublic' value='true' ";
                            if ($grotte[0]['accespublic']) {
                                echo "checked";
                            }
                            echo "/>";
                            echo "<label for='accesPublicOui'>&nbsp;&nbsp;oui&nbsp;&nbsp;</label>";
                            echo "<input type='radio' id='accesPublicNon' name='accesPublic' value='false' ";
                            if (!empty($grotte[0]['accespublic'])) {
                                if (!$grotte[0]['accespublic']) {
                                	echo "checked";
                                }
                            }
                            echo "/>";
							echo "<label for='accesPublicNon'>non</label>";
                            echo "<input type = 'radio' id='accesPublicNull' name = 'accesPublic' value='NULL' ";
                            if (empty($grotte[0]['accespublic'])) {
                                echo "checked";
                            }
                            echo "/>";
                            ?>
        					<label for="accesPublicNull">indéterminé</label>

							</br>
							</br>

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
