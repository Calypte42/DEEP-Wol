<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<div class= "col-sm-7">

		<?php
		if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){
			$RetourNomGrotte=$_REQUEST['nomGrotte'];
			$RetourIdGrotte=$_REQUEST['idGrotte'];
			$RetourNomSite=$_REQUEST['site'];
			$RetourIdSite=$_REQUEST['idSite'];

			echo "<form method='POST' action='tableauPiege.php?idSite=$RetourIdSite&site=$RetourNomSite&idGrotte=$RetourIdGrotte&nomGrotte=$RetourNomGrotte'>";
			echo "<input type='submit' value='Revenir au tableau des pièges' />";
			echo "</form>";
		}
		?>

		</br>
		<!-- FORMULAIRE D'AJOUT DE PIEGE -->
		<form  id="ajoutPiege"  method="POST" action = "WebService/ajoutPiegeWS.php" onsubmit="return controlePiege(this, false);"> <!-- reference au formulaire -->
		<p>

				<legend class="scheduler-border"> Ajout d'un piège </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">

						<?php

						if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){

						  /* rajout menu déroulant grotte avec grotte sélectionnée auparavant */

							echo "<label style='display: block; width:150px; float:left;' for='idGrotteForm'>Dans la grotte </label>";
							echo "<input type='hidden' name='idGrotte' value=$RetourIdGrotte>";
							echo "<input type='hidden' name='nomGrotte' value=$RetourNomGrotte>";
							echo "<select style='width:200px;' data-placeholder='Choisissez une grotte...' class='chosen-select' name='idGrotteForm' onchange='majSite(this.options[this.selectedIndex].value, false);'>";
							$requete='SELECT id, nomCavite from Grotte ORDER BY NomCavite';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
                                $id = $array['id'];
                                $nomCavite = $array['nomcavite'];
								if($nomCavite==$RetourNomGrotte){
									echo "<option selected value=\"$id\">$nomCavite</option>";
								}else{
									echo "<option value=\"$id\">$nomCavite</option>";
                                }
							}
							echo "</select></br></br>";

							/* rajout menu déroulant site avec site sélectionné auparavant */

							echo "<label style='display: block; width:150px; float:left;' for='idSiteForm'>Dans le site </label>";
							echo "<input type='hidden' name='idSite' value=$RetourIdSite>";
							echo "<input type='hidden' name='site' value=$RetourNomSite>";
                            echo "<div id='choixSite' style='display: inline'>";
							echo "<select style='width:200px;' data-placeholder='Choisissez un site...' class='chosen-select' name='idSiteForm'>";
							$requete="SELECT id, numsite from Site WHERE idGrotte = $RetourIdGrotte ORDER BY numsite";
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
                                $id = $array['id'];
                                $numSite = $array['numsite'];
								if($numSite==$RetourNomSite){
									echo "<option selected value=\"$id\">$numSite</option>";
								}else{
									echo "<option value=\"$id\">$numSite</option>";
                                }
							}
							echo "</select>";
                            echo "<input type='hidden' name='ajoutSite' value='' />";
                            echo "</div>";

						}else {

						 	/* rajout menu déroulant grotte  */

							echo "<label style='display: block; width:150px; float:left;' for='idGrotteForm'> Grotte </label>";
							echo "<select style='width:200px;' data-placeholder='Choisissez une grotte...' class='chosen-select' name='idGrotteForm' onchange=\"majSite(this.options[this.selectedIndex].value, false);\">";
                            echo "<option disabled selected value></option>";
                            $requete='SELECT id, nomCavite from Grotte ORDER BY NomCavite';
    						$value=requete($bdd,$requete);
    						foreach ($value as $array) {
                                $id = $array['id'];
                                $nomCavite = $array['nomcavite'];
    							echo "<option value=\"$id\">$nomCavite</option>";
    						}
							echo "</select></br></br>";

							/* rajout menu déroulant site  */

							echo "<label style='display: block; width:150px; float:left;' for='idSiteForm'> Site </label>";
                            echo "<div id='choixSite' style='display: none'>";
                            echo "<input type='hidden' name='ajoutSite' value='' />";
                            echo "</div>";
						}
						?>

						<?php

						?>

						</br></br>

						<?php
						/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */
						echo "<label style='display: block; width:150px; float:left;' for='codeEquipeSpeleo'>Equipe qui a posé le piège</label>";
						echo "<select style='width:200px;' data-placeholder='Choisissez une équipe...' class='chosen-select' name='codeEquipeSpeleo' id='listeEquipeSpeleo' onchange='ajoutDiv(this.options[this.selectedIndex].value, \"divEquipeSpeleo\")'>"; /* On cree une liste deroulante vide */
                        echo "<option disabled selected value></option>";
						$requete='SELECT codeEquipe from EquipeSpeleo ORDER BY codeEquipe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
							}
						}
                        echo "<option value='autre'>[Ajouter]</option>";
						echo "</select>";
						?>

						</br></br>

						<label style="display: block; width:150px; float:left;">Code du piège</label>
						<input required type="text" id ="codePiege" name="codePiege" maxlength="10" size="10"/> *</br></br>

						<label style="display: block; width:150px; float:left;">Date de pose</label>
						<input type="date" id ="datePose" name="datePose"/>

						&nbsp;&nbsp;

						<label>Heure de pose</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="time" id ="heurePose" name="heurePose"/></br></br>

						<label style="display: block; width:150px; float:left;">Date de récupération</label>
						<input type="date" id ="dateRecup" name="dateRecup"/>

						&nbsp;&nbsp;

						<label>Heure de récupération</label>
						<input type="time" id ="heureRecup" name="heureRecup"/></br></br>

						<label style="display: block; width:150px; float:left;">Date de tri</label>
						<input type="date" id ="dateTri" name="dateTri"/></br></br>

						<label style="display: block; width:150px; float:left;">Temperature</label>
						<input type="number" id ="temperature" name="temperature" size = "5"/> °C</br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

						<label>Problèmes rencontrés</label> </br>
						<textarea id="probleme" name="probleme" rows = "5" cols = "40"></textarea>

						</br>
						</br>

						<input type="submit" name="nom" value="Valider et ajouter un nouveau piège"> &nbsp;&nbsp;

						<?php
						if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){
							echo "<input type='submit' name='nom' value='Valider et ajouter un nouvel échantillon'>&nbsp;&nbsp";
							echo "<input type='submit' name='nom' value='Valider et revenir au tableau des pièges'>";
						}
						?>
						</div>
				</div>
					
				</p>
				</form>
			</div>

            <div class = "col-sm-3" style = "float:right; margin-top:150px;">
                <div id="divEquipeSpeleo" style="display:none;">
                        <form  id="formEquipeSpeleo"  method="POST" onsubmit="return ajaxAjout('./WebService/ajoutEquipeWS.php', 'divEquipeSpeleo', this.id, 'listeEquipeSpeleo')">
                            <fieldset style = "padding-left:5px;" >
                                <legend class="scheduler-border"> Ajout Equipe spéleo </legend>
                                <label style = "float:left;">Equipe spéléo</label>&nbsp;
                                <input class="valeurs" type="text" id="codeEquipe" name="codeEquipe" required size="20"/> *
                                </br></br>
                                <button type="submit">Ajouter une équipe</button></br></br>
                            </fieldset>
                        </form>
                </div>
            </div>

		</div>
	</div>

<?php
include 'HTML/pied.html';
?>
