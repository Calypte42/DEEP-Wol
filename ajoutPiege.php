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
		<!--<input type="submit" value="Retour vers tableau des pièges" />
		</form>-->
		</br>
		<!-- FORMULAIRE D'AJOUT DE PIEGE -->
		<form  id="ajoutPiege"  method="GET" action = "WebService/ajoutPiegeWS.php"> <!-- reference au formulaire -->
		<p>
			<!--<fieldset class="scheduler-border">-->
				<legend class="scheduler-border"> Ajout d'un piège </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">

						<?php
						/* on veut recuperer les valeurs de grotte deja existantes dans la bdd*/
							/*echo "<label for='grotte'>Dans la $RetourNomGrotte </label>";
							echo "<input type='hidden' value=$RetourNomGrotte name='nomGrotte'>";
							echo"<input type='hidden' value=$RetourIdGrotte name='idGrotte'>";*/
						if(isset($_REQUEST['idGrotte']) AND (isset($_REQUEST['idSite']))){

						  /* rajout menu déroulant grotte avec grotte sélectionnée auparavant */

							echo "<label style='display: block; width:150px; float:left;' for='idGrotte'>Dans la grotte </label>";
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

							echo "<label style='display: block; width:150px; float:left;' for='idSite'>Dans le site </label>";
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
							echo "</select>";

							}else {

						 	/* rajout menu déroulant grotte  */

							echo "<label style='display: block; width:150px; float:left;' for='Grotte'> Grotte </label>";
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

							echo "<label style='display: block; width:150px; float:left;' for='Site'> Site </label>";
							echo "<select name='numSite'>";
							$requete='SELECT numSite from Site ORDER BY numSite';
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
								foreach ($array as $key => $valeur) {
									echo "<option value=\"$valeur\">$valeur</option>";
								}
							}
							echo "</select>";
						}
						?>

						<?php
						/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */
						/*echo "<label for='numSite'>Numéro du $RetourNomSite </label>";
						echo "<input type='hidden' value=$RetourNomSite name='site'>";
						echo "<input type='hidden' value=$RetourIdSite name='idSite'>";*/
						?>

						</br></br>

						<?php
						/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */
						echo "<label for='codeEquipeSpeleo'>Equipe qui a posé le piège </label>";
						echo "<select name='codeEquipeSpeleo'>"; /* On cree une liste deroulante vide */

						$requete='SELECT codeEquipe from EquipeSpeleo ORDER BY codeEquipe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
								echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
							}
						}
						echo "</select>";
						?>

						</br></br>

						<label style="display: block; width:150px; float:left;">Code du piège</label>
						<input required type="text" id ="codePiege" name="codePiege" size="20"/>*</br></br>

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

						<label>Problèmes rencontrés</label> </br>
						<textarea id="probleme" name="probleme" rows = "5" cols = "40"></textarea>

						</br>
						</br>

						<input type="submit" name="nom" value="Valider et ajouter un nouveau piège"> &nbsp;&nbsp;
						<input type="submit" name="nom" value="Valider et ajouter un nouvel échantillon">&nbsp;&nbsp;
						<input type="submit" name="nom" value="Valider et revenir au tableau des pièges">


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
