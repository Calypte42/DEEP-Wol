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
		$RetourNomGrotte=$_REQUEST['nomGrotte'];
		$RetourIdGrotte=$_REQUEST['idGrotte'];
		$RetourNomSite=$_REQUEST['site'];
		$RetourIdSite=$_REQUEST['idSite'];

		echo "<form method='POST' action='tableauPiege.php?idSite=$RetourIdSite&site=$RetourNomSite&idGrotte=$RetourIdGrotte&nomGrotte=$RetourNomGrotte'>";
		?>
		<input type="submit" value="Retour vers tableau des pièges" />
		</form>
		</br>
		<!-- FORMULAIRE D'AJOUT DE PIEGE -->
		<form  id="ajoutPiege"  method="GET" action = "WebService/ajoutPiegeWS.php"> <!-- reference au formulaire -->
		<p>
			<!--<fieldset class="scheduler-border">-->
				<legend class="scheduler-border"> Ajout d'un piège </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">

						<?php
						/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */
						echo "<label for='grotte'>Dans la $RetourNomGrotte </label>";
						echo "<input type='hidden' value=$RetourNomGrotte name='nomGrotte'>"; /* On cree une liste deroulante vide */
						echo"<input type='hidden' value=$RetourIdGrotte name='idGrotte'>";
						?>

						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

						<?php
						/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */
						echo "<label for='numSite'>Numéro du $RetourNomSite </label>";
						echo "<input type='hidden' value=$RetourNomSite name='site'>"; /* On cree une liste deroulante vide */
						echo "<input type='hidden' value=$RetourIdSite name='idSite'>";
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
