<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

			<div class= "col-sm-10">

			<?php
			if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite'])) AND (isset($_REQUEST['piege']))){
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
			<form  id="ajoutIndividu"  method="GET" action = "WebService/ajoutEchantillonWS.php"> <!-- reference au formulaire -->
			<p>
				<!--<fieldset class="scheduler-border">-->
					<legend class="scheduler-border"> Ajout d'un échantillon </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">

						<?php
						/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */
						echo "<label for='grotte'>Dans la $RetourNomGrotte </label>";
						echo "<input type='hidden' value=$RetourIdGrotte name='idGrotte'>"; /* On cree une liste deroulante vide */
						echo "<input type='hidden' value=$RetourNomGrotte name='nomGrotte'>";
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
						/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */
						echo "<label for='numSite'>Numéro du $RetourNomSite </label>";
						echo "<input type='hidden' value=$RetourIdSite name='idSite'>"; /* On cree une liste deroulante vide */
						echo "<input type='hidden' value=$RetourNomSite name='site'>";
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
						/* on veut recuperer les valeurs de code de piege deja existantes dans la bdd */
						echo "<label for='codePiege'>Piège $RetourPiege </label>";
						echo "<input type='hidden' name='codePiege' value=$RetourPiege>"; /* On cree une liste deroulante vide */
						?>

						<br/><br/>

						<label style="display: block; width:170px; float:left;" for="type">Type d'échantillon</label>
							<select name="type">
									<option value="Pool"> Pool</option>
									<option selected value="Individu">Individu</option>
							</select>

						<br/><br/>

						<label style="display: block; width:170px; float:left;" for='nombreIndividu'>Nombre d'individus</label>
						<input type="number" name="nombreIndividu" id="nombreIndividu" /> (dans le pool : Faire disparaitre si type echantillon = Individu)

						</br></br>

						<label style="display: block; width:170px; float:left;">Numéro de l'échantillon</label>
						<input required type="text" id ="numEchantillon" name="numEchantillon" size="20"/>*</br></br> <!-- recuperer la valeur precedemment remplie -->

						<label style="display: block; width:170px; float:left;">Forme de stockage</label>  <!-- menu deroulant -->
							<select name="formeStockage" id="formeStockage">
								<option selected value="individuEntier">Individu entier</option> <!-- par défaut -->
								<option value="ADNextraitChelex">ADN extrait chelex</option>
								<option value="ADNextraitColonne">ADN extrait colonne</option>
								<option value="EnrichissementGenomeBacterien">Enrichissement génome bactérien</option>
								<!--<option value="Pool">Pool</option>-->
							</select>

		       	</br></br>

						<label style="display: block; width:170px; float:left;">Lieu de stockage</label>
						<!--<input required type="text" id ="lieuStockage" name="lieuStockage" size="20"/>*</br></br>-->
							<select name="lieuStockage" id="lieuStockage">
								<option selected value="Montpellier">Montpellier</option> <!-- par défaut -->
								<option value="Paris">Paris</option>
							</select>

						<input type = "button" value = "ajouter un lieu">

				    </br></br>

						<label style="display: block; width:170px; float:left;">Infecté par bactérie</label>  <!-- menu deroulant -->
							<select name="infecteBacterie" id="infecteBacterie">
								<option value="oui">oui</option>
								<option value="non">non</option>
								<option selected value="nonDetermine">non déterminé</option>
							</select>

				    </br></br>
				        <!-- ajout des attributs de taxonomie sous forme de liste déroulante, en fieldset inclu dans le formulaire Echantillon -->
						<form  id="ajoutTaxonomie"  method="GET" action = "ajoutIndividuWS.php"> <!-- reference au formulaire -->
						<p>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border"> Taxonomie </legend>
								<div class="control-group">
									<div class="controls bootstrap-timepicker">
									</br>
										<?php
										/* on veut recuperer les valeurs de classe deja existantes dans la bdd */
										echo "<label style='display: block; width:100px; float:left;' for='classe'>Classe </label>";
										echo "<select name='classe'>"; /* On cree une liste deroulante vide */
										$requete='SELECT DISTINCT classe from Taxonomie ORDER BY classe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:100px; float:left;' for='ordre'>Ordre </label>";
										echo "<select name='ordre'>"; /* On cree une liste deroulante vide */
										echo "<option value=\"Indetermine\">Indetermine</option>";
										$requete='SELECT DISTINCT ordre from Taxonomie WHERE ordre != \'null\' ORDER BY ordre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:100px; float:left;' for='famille'>Famille </label>";
										echo "<select name='famille'>"; /* On cree une liste deroulante vide */
										echo "<option value=\"Indetermine\">Indetermine</option>";
										$requete='SELECT DISTINCT famille from Taxonomie WHERE famille != \'null\' ORDER BY famille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:100px; float:left;' for='sousFamille'>Sous-famille </label>";
										echo "<select name='sousFamille'>"; /* On cree une liste deroulante vide */
										echo "<option value=\"Indetermine\">Indetermine</option>";
										$requete='SELECT DISTINCT sousfamille from Taxonomie WHERE sousFamille != \'null\' ORDER BY sousfamille';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:100px; float:left;' for='genre'>Genre </label>";
										echo "<select name='genre'>"; /* On cree une liste deroulante vide */
										echo "<option value=\"Indetermine\">Indetermine</option>";
										$requete='SELECT DISTINCT genre from Taxonomie WHERE genre != \'null\' ORDER BY genre';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
										echo "<label style='display: block; width:100px; float:left;' for='espece'>Espèce </label>";
										echo "<select name='espece'>"; /* On cree une liste deroulante vide */
										echo "<option value=\"Indetermine\">Indetermine</option>";
										$requete='SELECT DISTINCT espece from Taxonomie WHERE espece != \'null\' ORDER BY espece';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
										$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
										foreach ($value as $array) { /* On parcourt les resultats possibles */
											foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
												echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
											}
										}
										echo "</select>";
										?>

										</br></br>
										<input style="float:right; margin-right:60px;" type = "button" value = "ajouter une taxonomie">
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
						echo "<select name='idAuteur'>"; /* On cree une liste deroulante vide */
						$requete='SELECT id,nom,prenom from Personne ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
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
						echo "</select>";
						?>

						<input type = "button" value = "ajouter un auteur">

						</br></br>

						<input type = "button" id="affichageAjoutPCR" value = "ajouter une PCR">
						&nbsp;&nbsp;&nbsp;
						<input style="margin-left:15px;" type = "button" id="affichageAjoutqPCR" value = "ajouter une qPCR">

						</br></br>

						<input type="submit" name="nom" value="Valider et ajouter un nouvel échantillon"> &nbsp;&nbsp;&nbsp;
						<input type="submit" name="nom" value="Valider et revenir au tableau des échantillons">

						</div>
					</div>
					<!--</fieldset>-->
			</p>
			</form>
			</div>
		</div>
	</div>

<?php
include 'HTML/pied.html';
?>
