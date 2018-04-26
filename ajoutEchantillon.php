/<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

			<div class= "col-sm-10">

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
			<form  id="ajoutIndividu"  method="GET" action = "WebService/ajoutEchantillonWS.php"> <!-- reference au formulaire -->
			<p>
				<!--<fieldset class="scheduler-border">-->
					<legend class="scheduler-border"> Ajout d'un échantillon </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">

						<?php
						if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){
							echo "<label style='display: block; width:170px; float:left;' for='idGrotte'>Dans la grotte </label>";
							echo "<input type='hidden' name='idGrotte' value=$RetourIdGrotte>";
							echo "<input type='hidden' name='nomGrotte' value=$RetourNomGrotte>";
							echo "<select name='nomGrotte'>";
							$requete='SELECT NomCavite from Grotte ORDER BY NomCavite';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
									if($valeur==$RetourNomGrotte){
										echo "<option selected value=\"$RetourNomGrotte\">$RetourNomGrotte</option>";
									}else{
										echo "<option value=\"$valeur\">$valeur</option>";}
								}
							}
							echo "</select></br></br>";

						/* rajout menu déroulant site avec site sélectionné auparavant */

							echo "<label style='display: block; width:170px; float:left;' for='idSite'>Dans le site </label>";
							echo "<input type='hidden' name='idSite' value=$RetourIdSite>";
							echo "<input type='hidden' name='site' value=$RetourNomSite>";
							echo "<select name='site'>";
							$requete='SELECT numsite from Site ORDER BY numsite';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
									if($valeur==$RetourNomSite){
										echo "<option selected value=\"$RetourNomSite\">$RetourNomSite</option>";
									}else{
										echo "<option value=\"$valeur\">$valeur</option>";}
								}
							}
							echo "</select></br></br>";

							/* rajout menu déroulant piege avec piege sélectionné auparavant */
							echo "<label style='display: block; width:170px; float:left;' for='Piege'>Dans le piège </label>";
							/*echo "<input type='hidden' name='idSite' value=$RetourIdSite>";*/
							echo "<input type='hidden' name='piege' value=$RetourPiege>";
							echo "<select name='piege'>";
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
							echo "</select></br></br>";
						}else {

						/* rajout menu déroulant grotte  */

							echo "<label style='display: block; width:170px; float:left;' for='Grotte'> Grotte </label>";
							echo "<select name='nomGrotte'>";
							$requete='SELECT NomCavite from Grotte ORDER BY NomCavite';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
									echo "<option value=\"$valeur\">$valeur</option>";
								}
							}
							echo "</select></br></br>";

						/* rajout menu déroulant site  */

							echo "<label style='display: block; width:170px; float:left;' for='Site'> Site </label>";
							echo "<select name='numSite'>";
							$requete='SELECT numSite from Site ORDER BY numSite';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
									echo "<option value=\"$valeur\">$valeur</option>";
								}
							}
							echo "</select></br></br>";

						/* rajout menu déroulant piege  */

							echo "<label style='display: block; width:170px; float:left;' for='Piege'> Piege </label>";
							echo "<select name='codePiege'>";
							$requete='SELECT codePiege from Piege ORDER BY codePiege';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
									echo "<option value=\"$valeur\">$valeur</option>";
								}
							}
							echo "</select>";
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

						<!--<label style="display: block; width:170px; float:left;">Forme de stockage</label>
							<select name="formeStockage" id="formeStockage">
								<option selected value="individuEntier">Individu entier</option>
								<option value="ADNextraitChelex">ADN extrait chelex</option>
								<option value="ADNextraitColonne">ADN extrait colonne</option>
								<option value="EnrichissementGenomeBacterien">Enrichissement génome bactérien</option>
							</select>-->
							<?php
							echo "<label style='display: block; width:170px; float:left;' for='formeStockage'> Forme de stockage </label>";
							echo "<select name='formeStockage' id='listeFormeStockage'>";
							$requete='SELECT DISTINCT formeStockage from Echantillon ORDER BY formeStockage';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
									echo "<option value=\"$valeur\">$valeur</option>";
								}
							}
							echo "</select>";
							?>
							&nbsp;
							<input type = "button" id="affichageFormeStockage" value = "ajouter une forme de stokage" onclick="affichageDiv('divFormeStockage', this.id)">

		       	</br></br>

						<?php
						echo "<label style='display: block; width:170px; float:left;' for='lieuStockage'> Lieu de stockage </label>";
						echo "<select name='lieuStockage' id='listeLieuStockage'>";
						$requete='SELECT DISTINCT lieuStockage from Echantillon ORDER BY lieuStockage';
						$value=requete($bdd,$requete);
						foreach ($value as $array) {
							foreach ($array as $key => $valeur) {
								echo "<option value=\"$valeur\">$valeur</option>";
							}
						}
						echo "</select>";
						?>
						&nbsp;
						<input type = "button" id="affichageLieuStockage" value = "ajouter un lieu" onclick="affichageDiv('divLieuStockage', this.id)">

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
						echo "</select>";
						?>

						<input type = "button" value = "ajouter un auteur">

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

			<div id="divFormeStockage" style="display:none;">
				<form  id="formFormeStockage"  method="POST" onsubmit="return ajaxAjout('./WebService/ajoutFormeStockageWS.php', 'divFormeStockage', this.id, 'listeFormeStockage','affichageFormeStockage', 1)">
					<label>Forme de stockage</label>
					<input type="text" id="formeStockage" name="formeStockage" required size="20"/>
					<button type="submit">Ajouter une forme de stockage</button>
					<button type="button" onclick="affichageDiv('divFormeStockage', 'affichageFormeStockage')">Annuler</button></br></br>
				</form>
			</div>

			<div id="divLieuStockage" style="display:none;">
				<form  id="formLieuStockage"  method="POST" onsubmit="return ajaxAjout('./WebService/ajoutLieuStockageWS.php', 'divLieuStockage', this.id, 'listeLieuStockage','affichageLieuStockage', 1)">
					<label>Lieu de stockage</label>
					<input type="text" id="lieuStockage" name="lieuStockage" required size="20"/>
					<button type="submit">Ajouter un lieu de stockage</button>
					<button type="button" onclick="affichageDiv('divLieuStockage', 'affichageLieuStockage')">Annuler</button></br></br>
				</form>
			</div>

			</div>
		</div>
	</div>

<?php
include 'HTML/pied.html';
?>
