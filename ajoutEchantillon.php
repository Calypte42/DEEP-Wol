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

			<!--<input type='submit' value='Retour au tableau des échantillons' />
			</form>-->

			</br>
			<!-- FORMULAIRE D'AJOUT D'ECHANTILLON -->
			<form  id="ajoutIndividu"  method="POST" action = "WebService/ajoutEchantillonWS.php" onsubmit="return controleEchantillon(this);"> <!-- reference au formulaire -->
			<p>
				<!--<fieldset class="scheduler-border">-->
					<legend class="scheduler-border"> Ajout d'un échantillon </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">

						<?php
						if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){
							echo "<label style='display: block; width:170px; float:left;' for='idGrotteForm'>Dans la grotte </label>";
							echo "<input type='hidden' name='idGrotte' value=$RetourIdGrotte>";
							echo "<input type='hidden' name='nomGrotte' value=$RetourNomGrotte>";
							echo "<select name='idGrotteForm' onchange='majSite(this.options[this.selectedIndex].value, true); cacherPiege();'>";
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
							echo "<select name='idSiteForm'>";
                            echo "<option disabled selected value>Choisir un site</option>";
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
							//echo "<input type='hidden' name='codePiege' value=$RetourPiege>";
                            echo "<div id='choixPiege' style='display: inline'>";
							echo "<select name='codePiege'>";
                            echo "<option disabled selected value>Choisir un piège</option>";
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
                            echo "<select name='idGrotteForm' onchange='majSite(this.options[this.selectedIndex].value, true); cacherPiege();'>";
                            echo "<option disabled selected value>Choisir une grotte</option>";
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

						<!-- on veut recuperer les valeurs de grotte deja existantes dans la bdd */
					/*	echo "<label for='grotte'>Dans la $RetourNomGrotte </label>";
							echo "<input type='hidden' value=$RetourIdGrotte name='idGrotte'>";
							echo "<input type='hidden' value=$RetourNomGrotte name='nomGrotte'>";
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


						on veut recuperer les valeurs de numero de site deja existantes dans la bdd
						echo "<label for='numSite'>Numéro du $RetourNomSite </label>";
						echo "<input type='hidden' value=$RetourIdSite name='idSite'>";
						echo "<input type='hidden' value=$RetourNomSite name='site'>";

						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


						echo "<label for='codePiege'>Piège $RetourPiege </label>";
						echo "<input type='hidden' name='codePiege' value=$RetourPiege>"; -->

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
						<input required type="text" id ="numEchantillon" name="numEchantillon" size="20"/> *</br></br> <!-- recuperer la valeur precedemment remplie -->

						<!--<label style="display: block; width:170px; float:left;">Forme de stockage</label>
							<select name="formeStockage" id="formeStockage">
								<option selected value="individuEntier">Individu entier</option>
								<option value="ADNextraitChelex">ADN extrait chelex</option>
								<option value="ADNextraitColonne">ADN extrait colonne</option>
								<option value="EnrichissementGenomeBacterien">Enrichissement génome bactérien</option>
							</select>-->
							<?php
							echo "<label style='display: block; width:170px; float:left;' for='formeStockage'> Forme de stockage </label>";
							echo "<select name='formeStockage' id='listeFormeStockage' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivFormeStockage\", \"autreFormeStockage\")'>";
                            echo "<option disabled selected value>Choisir</option>";
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
							<!--<input type = "button" id="affichageFormeStockage" value = "ajouter une forme de stokage" onclick="affichageDiv('divFormeStockage', this.id)">-->

		       	</br></br>

						<?php
						echo "<label style='display: block; width:170px; float:left;' for='lieuStockage'> Lieu de stockage </label>";
						echo "<select name='lieuStockage' id='listeLieuStockage' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivLieuStockage\", \"autreLieuStockage\")'>";
                        echo "<option disabled selected value>Choisir</option>";
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
						<!--<input type = "button" id="affichageLieuStockage" value = "ajouter un lieu" onclick="affichageDiv('divLieuStockage', this.id)">-->

					<!--	<label style="display: block; width:170px; float:left;">Lieu de stockage</label>
							<select name="lieuStockage" id="lieuStockage">
								<option selected value="Montpellier">Montpellier</option>
								<option value="Paris">Paris</option>
							</select>-->

				    </br></br>

						<label style="display: block; width:170px; float:left;">Infecté par bactérie</label>  <!-- menu deroulant -->
							<select name="infecteBacterie" id="infecteBacterie">
								<option value="oui">oui</option>
								<option value="non">non</option>
								<option selected value="nonDetermine">non déterminé</option>
							</select>

              <div id="apparaitreSiInfecteBacterie" style="display:none">
                <?php
                echo"<select multiple name='bacterie'>"; /* On cree une liste deroulante */
                echo "<option selected = 'selected' value='Indetermine'>Indetermine</option>"; /*possibilité de selectionner toutes les grottes */
                $requete='SELECT DISTINCT clade from CorrespondanceEchantillonBacterie ORDER BY clade';  /* On prepare une requete permettant de recupere l'ensemble des valeurs qui nous interessent   */
                  $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
                  foreach ($value as $array) { /* On parcours les resultats possible (ici 1 seul) */
                      foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
                          echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
                    }
                  }
                  echo "</select>";
                  ?>
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
										echo "<select name='classe' id='classe' style='width:120px'>"; /* On cree une liste deroulante vide */
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
										echo "<select name='ordre' id='ordre' style='width:120px'>"; /* On cree une liste deroulante vide */
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
										echo "<select name='famille' id='famille' style='width:120px'>"; /* On cree une liste deroulante vide */
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
										echo "<select name='sousFamille' id='sousFamille' style='width:120px'>"; /* On cree une liste deroulante vide */
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
										echo "<select name='genre' id='genre' style='width:120px'>"; /* On cree une liste deroulante vide */
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
										echo "<select name='espece' id='espece' style='width:120px'>"; /* On cree une liste deroulante vide */
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
										<!--<input style="float:right; margin-right:60px;" type = "button" value = "ajouter une taxonomie">-->
										<!--<input style="display:block; margin:auto;" type = "button" value = "valider la taxonomie">-->
									</div> <!-- ferme la col-sm -->
									<div class = "col-sm-6" style = "margin-top:20px;">
									</br>
                  <a href="" onclick="window.open(this.href, 'newwindow',
                  'width=300,height=250'); return false;" id="lienImageTaxo" ><img src="" id="imageTaxo" /></a>
                </br>
                </br>
                </br>
										<p style="text-align:center;"> <b>La taxonomie que vous cherchez n'existe pas ?</b></p></br>
										<input style="display:block; margin:auto;" type = "button" value = "ajouter une taxonomie">
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
						echo "<select id='listePersonne' name='idAuteur' onchange='ajoutDiv(this.options[this.selectedIndex].value, \"divPersonne\")'>"; /* On cree une liste deroulante vide */
                        echo "<option disabled selected value>Choisir</option>";
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

					<!--	<input type = "button" id="affichageAjoutPCR" value = "ajouter une PCR">
						&nbsp;&nbsp;&nbsp;
						<input style="margin-left:15px;" type = "button" id="affichageAjoutqPCR" value = "ajouter une qPCR">

					</br></br>-->

						<input type="submit" name="nom" value="Valider et ajouter un nouvel échantillon"> &nbsp;&nbsp;&nbsp;

						<?php
						if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){
							echo "<input type='submit' name='nom' value='Valider et revenir au tableau des échantillons'>";
						}
						?>
						</div>
					</div>
					<!--</fieldset>-->
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
            <!--
                <div class = "col-sm-3" style = "float:right; margin-top:150px;">
        			<div id="divBacterie" style="display:none;">
        					<form  id="formBacterie"  method="POST" onsubmit="return ajaxAjout('./WebService/ajoutEquipeWS.php', 'divBacterie', this.id, 'bacterie')">
        						<fieldset style = "padding-left:5px;" >
        							<legend class="scheduler-border"> Ajout Equipe spéleo </legend>
        							<label style = "float:left;">Equipe spéléo</label>&nbsp;
        							<input class="valeurs" type="text" id="clade" name="clade" required size="20"/> *
        							</br></br>
        							<button type="submit">Ajouter une équipe</button></br></br>
        						</fieldset>
        					</form>
        			</div>
        		</div>
            -->

		</div> <!-- ferme div row de consultationModification -->
	</div>
	<script src='./javascript/ajoutEchantillon.js'></script>

<?php
include 'HTML/pied.html';
?>
