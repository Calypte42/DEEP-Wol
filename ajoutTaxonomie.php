<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';

$RetourNomGrotte=$_REQUEST['nomGrotte'];
$RetourIdGrotte=$_REQUEST['idGrotte'];
$RetourNomSite=$_REQUEST['site'];
$RetourIdSite=$_REQUEST['idSite'];
$RetourPiege=$_REQUEST['piege'];
echo "<form method='POST' action='tableauEchantillon.php?piege=$RetourPiege&nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>";
?>
<input type='submit' value='Retour au tableau' />
</form>

</br>
</br>
		<!-- FORMULAIRE D'AJOUT DE LA TAXONOMIE -->
<div class="container" style="margin-top:-400px; margin-right:10px;" >
		<form  id="ajoutTaxonomie"  method="GET" action = "WebService/ajoutTaxonomieWS.php"> <!-- reference au formulaire -->
		<p>
			<fieldset class="scheduler-border">
				<legend class="scheduler-border"> Ajout d'une taxonomie </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
			</br>
			</br>

			<?php

			/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

			echo "<label for='grotte'>Dans la Grotte : $RetourNomGrotte </label>";
			echo "<input type='hidden' value=$RetourIdGrotte name='idGrotte'>"; /* On cree une liste deroulante vide */
			echo "<input type='hidden' value=$RetourNomGrotte name='nomGrotte'>";
			?>

			</br></br>

			<?php

			/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */

			echo "<label for='numSite'>Numéro du site : $RetourNomSite </label>";
			echo "<input type='hidden' value=$RetourIdSite name='idSite'>"; /* On cree une liste deroulante vide */
			echo "<input type='hidden' value=$RetourNomSite name='site'>";
			?>

			</br></br>

			<?php

			/* on veut recuperer les valeurs de code de piege deja existantes dans la bdd */

			echo "<label for='codePiege'>Code du piège : $RetourPiege </label>";
			echo "<input type='hidden' name='codePiege' value=$RetourPiege>"; /* On cree une liste deroulante vide */

			?>

			</br></br>

				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */
				/* menu déroulant pour récupérer les échantillons de la grotte , du site et du piège sélectionnés en amont */
				echo "<label for='numEchantillon'>Echantillon</label>";
				echo "<select name='numEchantillon' id='listeEchantillon'>"; /* On cree une liste deroulante vide */

				/* requete surement à modifier */
				$requete='SELECT e.id,numEchantillon from Echantillon e where codePiege=\''.$_REQUEST["piege"];  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
				?>
				</br></br>

				<label>Classe</label>
				<input type="text" id ="classeTaxo" name="classeTaxo" size="40"/></br></br>

		        <label>Ordre</label>
				<input type="text" id ="ordreTaxo" name="ordreTaxo" size="40"/></br></br>

		        <label>Famille</label>
				<input type="text" id ="familleTaxo" name="familleTaxo" size="40"/></br></br>

		        <label>Sous-famille</label>
				<input type="text" id ="sousFamilleTaxo" name="sousFamilleTaxo" size="40"/></br></br>

		        <label>Genre</label>
				<input type="text" id ="genreTaxo" name="genreTaxo" size="40"/></br></br>

		        <label>Espèce</label>
				<input type="text" id ="especeTaxo" name="especeTaxo" size="40"/></br></br>

   					<label>Photo</label>
				<input type="file" id ="photo" name="photo" size="15" placeholder = "lien de la photo"/></br></br>

				<input type="submit" name="nom" value="Valider et ajouter une nouvelle taxonomie">
				<input type="submit" name='nom' value="Valider et revenir au tableau" />

				</div>
			</div>
		</fieldset>
	</p>
	</form>
</div>
<?php
include 'HTML/pied.html';
?>
