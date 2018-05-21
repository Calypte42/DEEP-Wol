<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Echantillon WHERE id=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$echantillon=requete($bdd,$requete); /* value recupere la reponse de la requete */
?>
            <script src="./javascript/eventListener.js" type="text/javascript"></script>
			<div class= "col-sm-7">

			<?php
				$RetourNomGrotte=$_REQUEST['nomGrotte'];
				$RetourIdGrotte=$_REQUEST['idGrotte'];
				$RetourNomSite=$_REQUEST['site'];
				$RetourIdSite=$_REQUEST['idSite'];
				$RetourPiege=$_REQUEST['piege'];
				echo "<form method='POST' action='tableauEchantillon.php?piege=$RetourPiege&nomGrotte=$RetourNomGrotte
				&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>";
				echo "<input type='submit' value='Revenir au tableau des échantillons' />";
				echo "</form>";
			?>



			</br>
			<!-- FORMULAIRE D'AJOUT D'ECHANTILLON -->
			<form  id="modifIndividu"  method="POST" action = "WebService/modifEchantillonWS.php" onsubmit="return controleEchantillon(this, true);"> <!-- reference au formulaire -->
			<p>

					<legend class="scheduler-border"> Grotte : <?=$RetourNomGrotte?> <br/>
                            Site : <?=$RetourNomSite?> <br/>
                            Piège : <?=$RetourPiege?> <br/><br/>
                            Modification de l'échantillon : <?=$echantillon[0]['numechantillon']?> </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">

                            <input type='hidden' name='id' value="<?=$id?>">
                            <input type='hidden' name='idGrotte' value="<?=$RetourIdGrotte?>">
    						<input type='hidden' name='nomGrotte' value="<?=$RetourNomGrotte?>">
                            <input type='hidden' name='idSite' value="<?=$RetourIdSite?>">
                            <input type='hidden' name='site' value="<?=$RetourNomSite?>">
                            <input type='hidden' name='codePiege' value="<?=$RetourPiege?>">
                            <input type='hidden' name='numEchantillonPrecedent' value="<?=$echantillon[0]['numechantillon']?>">
                            <input type='hidden' name='infecteBacteriePrecedent' value="<?=$echantillon[0]['infectebacterie']?>">

						</br></br>
						<label style="display: block; width:170px; float:left;" for="type">Type d'échantillon</label>
							<select name="type" id='choixType'>
                        <?php
                                if ($echantillon[0]['nombreindividu'] == 1) {
                                    echo "<option value='Pool'> Pool</option>";
                                    echo "<option selected value='Individu'>Individu</option>";
                                } else {
                                    echo "<option selected value='Pool'> Pool</option>";
                                    echo "<option value='Individu'>Individu</option>";
                                }
                        ?>
							</select>

						<br/><br/>

                        <?php
						echo "<div id='disparaitreSiIndividu' style='display:";
                        if ($echantillon[0]['nombreindividu'] == 1) {
                            echo "none";
                        } else {
                            echo "block";
                        }
                        echo "'>";
                        ?>
						<label style="display: block; width:170px; float:left;" for='nombreIndividu'>Nombre d'individus</label>
						<input type="number" name="nombreIndividu" id="nombreIndividu" min="0" value="<?=$echantillon[0]['nombreindividu']?>"/>
					</div>
						</br></br>

						<label style="display: block; width:170px; float:left;">Numéro de l'échantillon</label>
						<input required type="text" id ="numEchantillon" name="numEchantillon" maxlength="20" value="<?=$echantillon[0]['numechantillon']?>" size="20"/> *</br></br> <!-- recuperer la valeur precedemment remplie -->


							<?php
							echo "<label style='display: block; width:170px; float:left;' for='formeStockage'> Forme de stockage </label>";
							echo "<select style='width:200px;' data-placeholder='Choisissez une forme de stockage...' class='chosen-select' name='formeStockage' id='listeFormeStockage' onchange='ajoutAutre(this.options[this.selectedIndex].value, \"autreDivFormeStockage\", \"autreFormeStockage\")'>";
                            echo "<option disabled selected value></option>";
                            $requete='SELECT DISTINCT formeStockage from Echantillon ORDER BY formeStockage';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
                                    if ($echantillon[0]['formestockage'] == $valeur) {
                                        echo "<option selected value=\"$valeur\">$valeur</option>";
                                    } else {
                                        echo "<option value=\"$valeur\">$valeur</option>";
                                    }
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
                                if ($echantillon[0]['lieustockage'] == $valeur) {
                                    echo "<option selected value=\"$valeur\">$valeur</option>";
                                } else {
                                    echo "<option value=\"$valeur\">$valeur</option>";
                                }
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
                                <?php
    								echo "<option ";
                                if ($echantillon[0]['infectebacterie'] == "oui"){
                                    echo "selected";
                                }
                                    echo " value='oui'>oui</option>";
    								echo "<option ";
                                if ($echantillon[0]['infectebacterie'] == "non") {
                                    echo "selected";
                                }
                                    echo " value='non'>non</option>";
    								echo "<option ";
                                if ($echantillon[0]['infectebacterie'] == "nonDetermine") {
                                    echo "selected";
                                }
                                    echo " value='nonDetermine'>non déterminé</option>";
                                ?>
							</select>

                            <?php
                            echo "<div id='apparaitreSiInfecteBacterie' style='display:";
                            if ($echantillon[0]['infectebacterie'] == "oui"){
                                echo "block";
                            } else {
                                echo "none";
                            }
                            echo "'>";

                            $requete = "SELECT clade from CorrespondanceEchantillonBacterie WHERE idEchantillon = $id ORDER BY clade";
                            $resultat = requete($bdd, $requete);
                            $listeClade = [];

                            foreach ($resultat as $array) {
                                $listeClade[] = $array['clade'];
                            }

                            echo"<select data-placeholder='Choisissez une ou plusieurs bactérie(s)' class='chosen-select-width' multiple name='bacterie[]'>"; /* On cree une liste deroulante */
                            echo "<option ";
                            if (empty($listeClade)) {
                                echo "selected";
                            }
                            $requete='SELECT DISTINCT clade from CorrespondanceEchantillonBacterie ORDER BY clade';  /* On prepare une requete permettant de recupere l'ensemble des valeurs qui nous interessent   */
                              $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
                              foreach ($value as $array) { /* On parcours les resultats possible (ici 1 seul) */
                                  foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
                                      if (in_array($valeur, $listeClade)) {
                                          echo "<option selected value=\"$valeur\">$valeur</option>";
                                      } else {
                                          echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
                                      }
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
                                        $requete="SELECT classe, ordre, famille, sousFamille, genre, espece, photo from Taxonomie WHERE id = ".$echantillon[0]['idtaxonomie'];  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
										$taxonomie=requete($bdd,$requete); /* value recupere la reponse de la requete */
										/* on veut recuperer les valeurs de classe deja existantes dans la bdd */
										echo "<label style='display: block; width:90px; float:left;' for='classe'>Classe </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='classe' id='classe' style='width:120px' onchange=\"ajaxMajTaxo('classe');\">"; /* On cree une liste deroulante vide */
                                        echo "<option value></option>";
                                        $classe = $taxonomie[0]['classe'];
                                        if ($classe == "") {
                                            echo "<option selected value=\"Indetermine\">Indetermine</option>";
                                            $requete="SELECT DISTINCT classe from Taxonomie WHERE classe !='' ORDER BY classe";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
    										$value=requete($bdd,$requete);
                                            foreach ($value as $array) { /* On parcourt les resultats possibles */
                                                $classeTaxo = $array['classe'];
                                                echo "<option value=\"$classeTaxo\">$classeTaxo</option>"; /* Que l'on ajoute dans la liste deroulante */
    										}
                                        } else {
										    echo "<option selected value=\"$classe\">$classe</option>";
                                        }
										echo "</select>";
										?>

										</br></br>

										<?php
										/* on veut recuperer les valeurs de ordre deja existantes dans la bdd */
										echo "<label style='display: block; width:90px; float:left;' for='ordre'>Ordre </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='ordre' id='ordre' style='width:120px' onchange=\"ajaxMajTaxo('ordre');\">"; /* On cree une liste deroulante vide */
                                        echo "<option value></option>";
                                        $ordre = $taxonomie[0]['ordre'];
                                        if ($ordre == "") {
                                            echo "<option selected value=\"Indetermine\">Indetermine</option>";
                                            $requete="SELECT ordre from Taxonomie WHERE classe ='$classe' AND ordre !='' ORDER BY ordre";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
    										$value=requete($bdd,$requete);
                                            foreach ($value as $array) { /* On parcourt les resultats possibles */
                                                $ordreTaxo = $array['classe'];
                                                echo "<option value=\"$ordreTaxo\">$ordreTaxo</option>"; /* Que l'on ajoute dans la liste deroulante */
    										}
                                        } else {
										    echo "<option selected value=\"$ordre\">$ordre</option>";
                                        }
										echo "</select>";
										?>

										</br></br>

										<?php
										/* on veut recuperer les valeurs de famille deja existantes dans la bdd */
										echo "<label style='display: block; width:90px; float:left;' for='famille'>Famille </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='famille' id='famille' style='width:120px' onchange=\"ajaxMajTaxo('famille');\">"; /* On cree une liste deroulante vide */
                                        echo "<option value></option>";
                                        $famille = $taxonomie[0]['famille'];
                                        if ($famille == "") {
                                            echo "<option selected value=\"Indetermine\">Indetermine</option>";
                                            $requete="SELECT famille from Taxonomie WHERE classe ='$classe' AND ordre ='$ordre' AND famille != '' ORDER BY famille";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
    										$value=requete($bdd,$requete);
                                            foreach ($value as $array) { /* On parcourt les resultats possibles */
                                                $familleTaxo = $array['famille'];
                                                echo "<option value=\"$familleTaxo\">$familleTaxo</option>"; /* Que l'on ajoute dans la liste deroulante */
    										}
                                        } else {
										    echo "<option selected value=\"$famille\">$famille</option>";
                                        }
										echo "</select>";
										?>

										</br></br>

										<?php
										/* on veut recuperer les valeurs de sous-famille deja existantes dans la bdd */
										echo "<label style='display: block; width:90px; float:left;' for='sousFamille'>Sous-famille </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='sousFamille' id='sousFamille' style='width:120px' onchange=\"ajaxMajTaxo('sousFamille');\">"; /* On cree une liste deroulante vide */
                                        echo "<option value></option>";
                                        $sousFamille = $taxonomie[0]['sousfamille'];
                                        if ($sousFamille == "") {
                                            echo "<option selected value=\"Indetermine\">Indetermine</option>";
                                            $requete="SELECT sousFamille from Taxonomie WHERE classe ='$classe' AND ordre ='$ordre'
                                                                AND famille = '$famille' AND sousFamille != '' ORDER BY sousFamille";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
    										$value=requete($bdd,$requete);
                                            foreach ($value as $array) { /* On parcourt les resultats possibles */
                                                $sousFamilleTaxo = $array['sousfamille'];
                                                echo "<option value=\"$sousFamilleTaxo\">$sousFamilleTaxo</option>"; /* Que l'on ajoute dans la liste deroulante */
    										}
                                        } else {
										    echo "<option selected value=\"$sousFamille\">$sousFamille</option>";
                                        }
										echo "</select>";
										?>

										</br></br>

										<?php
										/* on veut recuperer les valeurs de genre deja existantes dans la bdd */
										echo "<label style='display: block; width:90px; float:left;' for='genre'>Genre </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='genre' id='genre' style='width:120px' onchange=\"ajaxMajTaxo('genre');\">"; /* On cree une liste deroulante vide */
                                        echo "<option value></option>";
                                        $genre = $taxonomie[0]['genre'];
                                        if ($genre == "") {
                                            echo "<option selected value=\"Indetermine\">Indetermine</option>";
                                            $requete="SELECT genre from Taxonomie WHERE classe ='$classe' AND ordre ='$ordre'
                                                                AND famille = '$famille' AND sousFamille = '$sousFamille' AND genre = '' ORDER BY genre";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
    										$value=requete($bdd,$requete);
                                            foreach ($value as $array) { /* On parcourt les resultats possibles */
                                                $genreTaxo = $array['genre'];
                                                echo "<option value=\"$genreTaxo\">$genreTaxo</option>"; /* Que l'on ajoute dans la liste deroulante */
    										}
                                        } else {
										    echo "<option selected value=\"$genre\">$genre</option>";
                                        }
										echo "</select>";
										?>

										</br></br>

										<?php
										/* on veut recuperer les valeurs de genre deja existantes dans la bdd */
										echo "<label style='display: block; width:90px; float:left;' for='espece'>Espèce </label>";
										echo "<select style='width:170px;' data-placeholder='Choisir...' class='chosen-select-deselect' name='espece' id='espece' style='width:120px' onchange=\"ajaxMajTaxo('espece');\">"; /* On cree une liste deroulante vide */
                                        echo "<option value></option>";
                                        $espece = $taxonomie[0]['espece'];
                                        if ($espece == "") {
                                            echo "<option selected value=\"Indetermine\">Indetermine</option>";
                                            $requete="SELECT espece from Taxonomie WHERE classe ='$classe' AND ordre ='$ordre'
                                                                AND famille = '$famille' AND sousFamille = '$sousFamille' AND genre = '$genre'
                                                                AND espece != '' ORDER BY espece";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
    										$value=requete($bdd,$requete);
                                            foreach ($value as $array) { /* On parcourt les resultats possibles */
                                                $especeTaxo = $array['espece'];
                                                echo "<option value=\"$especeTaxo\">$especeTaxo</option>"; /* Que l'on ajoute dans la liste deroulante */
    										}
                                        } else {
										    echo "<option selected value=\"$espece\">$espece</option>";
                                        }
										echo "</select>";
										?>

										</br></br>

									</div> <!-- ferme la col-sm -->
									<div class = "col-sm-6" style = "margin-top:70px;">
									</br>
                    <?php
                 echo "<a href='";
                 if (!empty($taxonomie[0]['photo'])) {
                     $photo = $taxonomie[0]['photo'];
                     echo $photo;
                 }
                 echo "' onclick=\"window.open(this.href, 'newwindow',
                        'width=300,height=250'); return false;\" id='lienImageTaxo' ><img src='";
                if (!empty($taxonomie[0]['photo'])) {
                    echo $photo;
                }
                 echo "' ";
                 if (!empty($taxonomie[0]['photo'])) {
                     echo "style='width:200px; height:200px;'";
                 }
                 echo " id='imageTaxo' /></a>";
                    ?>
                </br>
                </br>
                </br>

									</div>
								</div>
										</fieldset>
									</form>

						<label style="display: block; width:170px; float:left;">Niveau d'identification</label>  <!-- menu deroulant -->
							<select name="niveauIdentification" id="niveauIdentification">
                                <?php
								echo "<option ";
                                if ($echantillon[0]['niveauidentification'] == 'hypothetique') {
                                    echo "selected";
                                }
                                echo " value='hypothetique'>Hypothétique</option>";
								echo "<option ";
                                if ($echantillon[0]['niveauidentification'] == 'valide') {
                                    echo "selected";
                                }
                                echo " value='valide'>Validé</option>";
								echo "<option ";
                                if ($echantillon[0]['niveauidentification'] == 'incomplet') {
                                    echo "selected";
                                }
                                echo " value='incomplet'>Incomplet</option>";
                                ?>
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
							$idPersonne = $array['id'];
                            $initiale = $array['initiale'];
                            if ($idPersonne == $echantillon[0]['idauteur']){
                                echo "<option selected value='$idPersonne'>$initiale</option>";
                            } else {
                                echo "<option value='$idPersonne'>$initiale</option>";
                            }
						}
                        echo "<option value='autre'>[Ajouter]</option>";
						echo "</select>";
						?>

						</br></br>




						<input type='submit' name='nom' value='Valider et revenir au tableau des échantillons'>
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
