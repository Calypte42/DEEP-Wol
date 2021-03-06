<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>

    	<!-- FORMULAIRE D'AJOUT DE SITE -->

		<div class= "col-sm-7">
			<?php
			if(isset($_REQUEST['idGrotte'])){
				$RetourId=$_REQUEST['idGrotte'];
				$Retour=$_REQUEST['grotte'];

				echo "<form method='POST' action='tableauSite.php?idGrotte=$RetourId&grotte=$Retour'>";
				echo "<input type='submit' value='Revenir au tableau des sites' />";
				echo "</form>";
			}
			?>
			</br>
			<div id='divAjoutSite'>
			<form  id="ajoutSite"  method="GET" action = "WebService/ajoutSiteWS.php" onsubmit="return controleSite(this, false);"> <!-- reference au formulaire -->
			<p>
				<legend class="scheduler-border"> Ajout d'un site </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">

					<?php
					/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */
					if(isset($_REQUEST['idGrotte'])){
						echo "<label style='display: block; width:115px; float:left;' for='idGrotteForm'>Dans la grotte </label>";
						echo "<input type='hidden' name='idGrotte' value=$RetourId>";
						echo "<input type='hidden' name='grotte' value=$Retour>";
						echo "<select style='width:200px;' data-placeholder='Choisissez une grotte...' class='chosen-select' name='idGrotteForm'>";
						$requete='SELECT id, nomCavite from Grotte ORDER BY NomCavite';
						$value=requete($bdd,$requete);
						foreach ($value as $array) {
                            $id = $array['id'];
                            $nomCavite = $array['nomcavite'];
							if($nomCavite==$Retour){
								echo "<option selected value=\"$id\">$nomCavite</option>";
							}else{
								echo "<option value=\"$id\">$nomCavite</option>";
                            }
						}
						echo "</select>";
					} else {
						echo "<label style='display: block; width:115px; float:left;' for='idGrotteForm'> Grotte </label>";
						echo "<select style='width:200px;' data-placeholder='Choisissez une grotte...' class='chosen-select' name='idGrotteForm'>";
						$requete='SELECT id, nomCavite from Grotte ORDER BY NomCavite';
						$value=requete($bdd,$requete);
						foreach ($value as $array) {
                            $id = $array['id'];
                            $nomCavite = $array['nomcavite'];
							echo "<option value=\"$id\">$nomCavite</option>";
						}
						echo "</select>";
					}

					?>
					</br></br>

					<?php
					/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */
					echo "<label style='display: block; width:115px; float:left;' for='codeEquipeSpeleo'>Equipe spéléo </label>";
					echo "<select style='width:200px;' data-placeholder='Choisissez une équipe...' class='chosen-select' name='codeEquipeSpeleo' id='listeEquipeSpeleo' onchange='ajoutDiv(this.options[this.selectedIndex].value, \"divEquipeSpeleo\")'>"; /* On cree une liste deroulante vide */
                    echo "<option disabled selected value></option>";
					$requete='SELECT codeEquipe from EquipeSpeleo';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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

					<label style="display: block; width:115px; float:left;">Numéro de site</label>
					<input required = "required" type="text" id ="numSite" name="numSite" size="40"/> * </br></br>

					<label style="display: block; width:115px; float:left;">Profondeur</label>
					<!-- Mettre number -->
					<input type="number" id ="profondeur" name="profondeur" size = "5"/></br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

					<!-- Mettre number -->

					<label style="display: block; width:115px; float:left;" for='typeSol'>Type de sol</label>

                <?php
                    echo "<select style='width:200px;' data-placeholder='Choisissez un type de sol...' class='chosen-select' name='typeSol' id='typeSol' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivSol\", \"autreSol\")'>";
                    $requete='SELECT DISTINCT typeSol from Site ORDER BY typeSol';
                    $value=requete($bdd,$requete);
                    foreach ($value as $array) {
                        foreach ($array as $key => $valeur) {
                            if (!($valeur == "") and $valeur != "Indéterminé") {
                                echo "<option value=\"$valeur\">$valeur</option>";
                            }
                        }
                    }
                    echo "<option value='Indéterminé'>Indéterminé</option>";
                    echo "<option value='autre'>[Ajouter]</option>";
                    echo "</select>";
                ?>
                    <div id="autreDivSol" style="display:none;">Ajouter un type de sol : <input id="autreSol" type="text" name="autreSol" /> *</div>

                    </br></br>

                    <!-- Mettre number -->
					<label style="display: block; width:115px; float:left;">Distance à l'entrée</label>
					<input required type="number" id ="distanceEntree" name="distanceEntree" size="10"/> metres *</br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

					<label style="display: block; width:115px; float:left;">Présence d'eau</label>
					<input type="radio" id="presenceEauOui" name="presenceEau" value="true"/>
					<label for="presenceEauOui">oui</label>
					<input type = "radio" id="presenceEauNon" name = "presenceEau" value="false">
					<label for="presenceEauNon">non</label>
          <input type = "radio" id="presenceEauNull" name = "presenceEau" value="null" checked>
					<label for="presenceEauNull">indéterminé</label>

					</br>
					</br>

					<input type="submit" name="nom" value="Valider et ajouter un nouveau site"> &nbsp;&nbsp;
					<?php
					if(isset($_REQUEST['idGrotte'])){
						echo "<input type='submit' name='nom' value='Valider et ajouter un nouveau piège'>&nbsp;&nbsp";
						echo "<input type='submit' name='nom' value='Valider et revenir au tableau des sites'>";
					}
					?>
					</div>
				</div>
			</div> <!-- ferme divAjoutSite-->
			
			</p>
			</form>

		</div> <!--ferme col-sm-->

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
	</div> <!-- div ferme row de consultationModification-->
</div> <!-- ferme div container-fluid de consultationModification-->

<?php
include 'HTML/pied.html';
?>
