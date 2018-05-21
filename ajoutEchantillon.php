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
				$RetourPiege=$_REQUEST['piege'];
				echo "<form method='POST' action='tableauEchantillon.php?piege=$RetourPiege&nomGrotte=$RetourNomGrotte
				&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>";
				echo "<input type='submit' value='Revenir au tableau des échantillons' />";
				echo "</form>";
			}
			?>



			</br>
			<!-- FORMULAIRE D'AJOUT D'ECHANTILLON -->
			<form  id="ajoutIndividu"  method="POST" action = "WebService/ajoutEchantillonWS.php" onsubmit="return controleEchantillon(this, false);"> <!-- reference au formulaire -->
			<p>

					<legend class="scheduler-border"> Ajout d'un échantillon </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">

						<?php
						if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){
							echo "<label style='display: block; width:170px; float:left;' for='idGrotteForm'>Dans la grotte </label>";
							echo "<input type='hidden' name='idGrotte' value=$RetourIdGrotte>";
							echo "<input type='hidden' name='nomGrotte' value=$RetourNomGrotte>";
							echo "<select style='width:200px;' data-placeholder='Choisissez une grotte...' class='chosen-select' name='idGrotteForm' onchange='majSite(this.options[this.selectedIndex].value, true); cacherPiege();'>";
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

							echo "<label style='display: block; width:170px; float:left;' for='idSiteForm'>Dans le site </label>";
							echo "<input type='hidden' name='idSite' value=$RetourIdSite>";
							echo "<input type='hidden' name='site' value=$RetourNomSite>";
                            echo "<div id='choixSite' style='display: inline'>";
							echo "<select style='width:200px;' data-placeholder='Choisissez un site...' class='chosen-select' name='idSiteForm'>";
                            echo "<option disabled selected value></option>";
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
                            echo "</br></br>";

							/* rajout menu déroulant piege avec piege sélectionné auparavant */
							echo "<label style='display: block; width:170px; float:left;' for='codePiege'>Dans le piège </label>";

                            echo "<div id='choixPiege' style='display: inline'>";
							echo "<select style='width:200px;' data-placeholder='Choisissez un piège...' class='chosen-select' name='codePiege'>";
                            echo "<option disabled selected value></option>";
							$requete='SELECT codepiege from piege ORDER BY codepiege';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
									if($valeur==$RetourPiege){
										echo "<option selected value=\"$RetourPiege\">$RetourPiege</option>";
									}else{
										echo "<option value=\"$valeur\">$valeur</option>";}
								}
							}
							echo "</select>";
                            echo "<input type='hidden' name='ajoutPiege' value='' />";
                            echo "</div>";
						}else {

						/* rajout menu déroulant grotte  */

							echo "<label style='display: block; width:170px; float:left;' for='idGrotteForm'> Grotte </label>";
                            echo "<select style='width:200px;' data-placeholder='Choisissez une grotte...' class='chosen-select' name='idGrotteForm' onchange='majSite(this.options[this.selectedIndex].value, true); cacherPiege();'>";
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

							echo "<label style='display: block; width:170px; float:left;' for='idSiteForm'> Site </label>";
                            echo "<div id='choixSite' style='display: none'>";
                            echo "<input type='hidden' name='ajoutSite' value='' />";
                            echo "</div>";
							echo "</br></br>";

						/* rajout menu déroulant piege  */

							echo "<label style='display: block; width:170px; float:left;' for='codePiege'> Piege </label>";
                            echo "<div id='choixPiege' style='display: none'>";
                            echo "<input type='hidden' name='ajoutPiege' value='' />";
                            echo "</div>";
						}
						?>



						</br></br>
						<label style="display: block; width:170px; float:left;" for="type">Type d'échantillon</label>
							<select name="type" id='choixType'>
									<option value="Pool"> Pool</option>
									<option selected value="Individu">Individu</option>
							</select>

						<br/><br/>

						<div id='disparaitreSiIndividu' style="display:none">
						<label style="display: block; width:170px; float:left;" for='nombreIndividu'>Nombre d'individus</label>
						<input type="number" name="nombreIndividu" id="nombreIndividu" min="0" />
					</div>
						</br></br>

						<label style="display: block; width:170px; float:left;">Numéro de l'échantillon</label>
						<input required type="text" id ="numEchantillon" name="numEchantillon" maxlength="20" size="20"/> *</br></br> <!-- recuperer la valeur precedemment remplie -->


							<?php
							echo "<label style='display: block; width:170px; float:left;' for='formeStockage'> Forme de stockage </label>";
							echo "<select style='width:200px;' data-placeholder='Choisissez une forme de stockage...' class='chosen-select' name='formeStockage' id='listeFormeStockage' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivFormeStockage\", \"autreFormeStockage\")'>";
                            echo "<option disabled selected value></option>";
                            $requete='SELECT DISTINCT formeStockage from Echantillon ORDER BY formeStockage';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
                                    echo "<option value=\"$valeur\">$valeur</option>";
								}
							}
                            echo "<option value='autre'>[Ajouter]</option>";
							echo "</select>";
							?>
                            <div id="autreDivFormeStockage" style="display:none;">Ajouter une forme de stockage : <input id="autreFormeStockage" type="text" name="autreFormeStockage" /> *</div>
							&nbsp;


		       	</br></br>

						<?php
						echo "<label style='display: block; width:170px; float:left;' for='lieuStockage'> Lieu de stockage </label>";
						echo "<select style='width:200px;' data-placeholder='Choisissez un lieu de stockage...' class='chosen-select' name='lieuStockage' id='listeLieuStockage' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivLieuStockage\", \"autreLieuStockage\")'>";
                        echo "<option disabled selected value></option>";
                        $requete='SELECT DISTINCT lieuStockage from Echantillon ORDER BY lieuStockage';
						$value=requete($bdd,$requete);
						foreach ($value as $array) {
							foreach ($array as $key => $valeur) {
                                echo "<option value=\"$valeur\">$valeur</option>";
							}
						}
                        echo "<option value='autre'>[Ajouter]</option>";
						echo "</select>";
						?>
                        <div id="autreDivLieuStockage" style="display:none;">Ajouter un lieu de stockage : <input id="autreLieuStockage" type="text" name="autreLieuStockage" /> *</div>
						&nbsp;


				    </br></br>

						<label style="display: block; width:170px; float:left;">Infecté par bactérie</label>  <!-- menu deroulant -->
							<select name="infecteBacterie" id="infecteBacterie">
								<option value="oui">oui</option>
								<option value="non">non</option>
								<option selected value="nonDetermine">non déterminé</option>
							</select>

              <div id="apparaitreSiInfecteBacterie" style="display:none">
                <?php
                echo"<select data-placeholder='Choisissez une ou plusieurs bactérie(s)' class='chosen-select-width' multiple id='bacterie' name='bacterie[]'>"; /* On cree une liste deroulante */
                $requete='SELECT DISTINCT clade from CorrespondanceEchantillonBacterie ORDER BY clade';  /* On prepare une requete permettant de recupere l'ensemble des valeurs qui nous interessent   */
                  $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
                  foreach ($value as $array) { /* On parcours les resultats possible (ici 1 seul) */
                      foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
                          echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
                    }
                  }
                  echo "</select>";
                  ?>

                  <input type = "button" id="affichageBacterie" value = "ajouter une bactérie" onclick="affichageDiv('divBacterie', this.id)">
              </div>

				    </br></br>
				        <!-- ajout des attributs de taxonomie sous forme de liste déroulante, en fieldset inclu dans le formulaire Echantillon -->
						<form  id="ajoutTaxonomie"  method="GET" action = "ajoutIndividuWS.php"> <!-- reference au formulaire -->
						<p>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border"> Taxonomie </legend>
								<div class = "row">

								<div class="control-group">

									<div class="controls bootstrap-timepicker">
										<div class = "col-sm-6" style = "border-right:1px solid lightgrey;">
									</br>
										<?php
										/* on veut recuperer les valeurs de classe deja existantes dans la bdd */
										echo "<label style='display: block; width:90px; float:left;' for='classe'>Classe </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='classe' id='classe' onchange=\"ajaxMajTaxo('classe');\">"; /* On cree une liste deroulante vide */
                                        echo "<option selected value></option>";
                                        echo "<option value=\"Indetermine\">Indetermine</option>";
                                        $requete='SELECT DISTINCT classe from Taxonomie WHERE classe !=\'\' ORDER BY classe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										/* on veut recuperer les valeurs de ordre deja existantes dans la bdd */
										echo "<label style='display: block; width:90px; float:left;' for='ordre'>Ordre </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='ordre' id='ordre' onchange=\"ajaxMajTaxo('ordre');\">"; /* On cree une liste deroulante vide */
                                        echo "<option selected value></option>";
                                        echo "<option value=\"Indetermine\">Indetermine</option>";
                                        $requete='SELECT DISTINCT ordre from Taxonomie WHERE ordre != \'\' ORDER BY ordre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:90px; float:left;' for='famille'>Famille </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='famille' id='famille' onchange=\"ajaxMajTaxo('famille');\">"; /* On cree une liste deroulante vide */
                                        echo "<option selected value></option>";
                                        echo "<option value=\"Indetermine\">Indetermine</option>";
                                        $requete='SELECT DISTINCT famille from Taxonomie WHERE famille != \'\' ORDER BY famille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:90px; float:left;' for='sousFamille'>Sous-famille </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='sousFamille' id='sousFamille' onchange=\"ajaxMajTaxo('sousFamille');\">"; /* On cree une liste deroulante vide */
                                        echo "<option selected value></option>";
                                        echo "<option value=\"Indetermine\">Indetermine</option>";
                                        $requete='SELECT DISTINCT sousfamille from Taxonomie WHERE sousFamille != \'\' ORDER BY sousfamille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:90px; float:left;' for='genre'>Genre </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='genre' id='genre' onchange=\"ajaxMajTaxo('genre');\">"; /* On cree une liste deroulante vide */
                                        echo "<option selected value></option>";
                                        echo "<option value=\"Indetermine\">Indetermine</option>";
                                        $requete='SELECT DISTINCT genre from Taxonomie WHERE genre != \'\' ORDER BY genre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:90px; float:left;' for='espece'>Espèce </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='espece' id='espece' onchange=\"ajaxMajTaxo('espece');\">"; /* On cree une liste deroulante vide */
                                        echo "<option selected value></option>";
                                        echo "<option value=\"Indetermine\">Indetermine</option>";
                                        $requete='SELECT DISTINCT espece from Taxonomie WHERE espece != \'\' ORDER BY espece';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
										$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
										foreach ($value as $array) { /* On parcourt les resultats possibles */
											foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
												echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
											}
										}

										echo "</select>";
										?>

										</br></br>

									</div> <!-- ferme la col-sm -->
									<div class = "col-sm-6" style = "margin-top:70px;">
									</br>
                  <a href="" onclick="window.open(this.href, 'newwindow',
                  'width=300,height=250'); return false;" id="lienImageTaxo" ><img src="" id="imageTaxo" /></a>
                </br>
                </br>
                </br>

									</div>
								</div>
										</fieldset>
									</form>

						<label style="display: block; width:170px; float:left;">Niveau d'identification</label>  <!-- menu deroulant -->
							<select name="niveauIdentification" id="niveauIdentification">
								<option value="hypothetique">Hypothétique</option>
								<option value="valide">Validé</option>
								<option value="incomplet">Incomplet</option>
							</select>

						</br></br>

						<?php
						/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */
						echo "<label style='display: block; width:170px; float:left;' for='idAuteur'>Auteur  </label>";
						echo "<select style='width:120px;' data-placeholder='Choisir une personne' class='chosen-select' id='listePersonne' name='idAuteur' onchange='ajoutDiv(this.options[this.selectedIndex].value, \"divPersonne\")'>"; /* On cree une liste deroulante vide */
                        echo "<option disabled selected value></option>";
                        $requete='SELECT id,initiale from Personne ORDER BY initiale';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							echo "<option value=\"";
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								if($key=='id'){
									echo "$valeur\">";
								}
								else{
									echo "$valeur "; /* Que l'on ajoute dans la liste deroulante */
								}
							}
							echo "</option>";
						}
                        echo "<option value='autre'>[Ajouter]</option>";
						echo "</select>";
						?>

						</br></br>



						<input type="submit" name="nom" value="Valider et ajouter un nouvel échantillon"> &nbsp;&nbsp;&nbsp;

						<?php
						if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){
							echo "<input type='submit' name='nom' value='Valider et revenir au tableau des échantillons'>";
						}
						?>
						</div>
					</div>
					
			</p>
			</form>
		</div> <!--ferme div col-sm-->

				<div class= "col-sm-3" style = "float:right; margin-top:800px;">
					<div id="divPersonne" style="display:none;">
						<form  id="formPersonne"  method="POST" onsubmit="return ajaxAjout('./WebService/ajoutPersonneWS.php', 'divPersonne', this.id, 'listePersonne')">
							<fieldset style = "padding-left:5px;">
								<legend class="scheduler-border"> Ajout d'une personne </legend>
									<label style = "float:left;">Veuillez ne renseigner que les initiales de la personne</label>
									<input class="valeurs" type="text" id="personne" name="personne" required size="5" maxlength="5"/>
									</br></br>
									<button type="submit">Ajouter une personne</button></br></br>
							</fieldset>
						</form>
					</div>

                <div class = "col-sm-20" style = "float:right; margin-top:150px;">
        			<div id="divBacterie" style="display:none;">
        					<form  id="formBacterie"  method="POST" onsubmit="return ajoutBacterie('divBacterie', this.id, 'bacterie', 'affichageBacterie')">
        						<fieldset style = "padding-left:5px;" >
        							<legend class="scheduler-border"> Ajout bactérie </legend>
        							<label style = "float:left;">Clade</label>&nbsp;
        							<input class="valeurs" type="text" id="clade" name="clade" required size="20"/> *
        							</br></br>
        							<button type="submit">Ajouter une bactérie</button></br></br>
        						</fieldset>
        					</form>
        			</div>
        		</div>


		</div> <!-- ferme div row de consultationModification -->
	</div>
	<script src='./javascript/ajoutEchantillon.js'></script>

<?php
include 'HTML/pied.html';
?>
