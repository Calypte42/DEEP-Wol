<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<!-- FORMULAIRE D'AJOUT D'UN GENE -->
		<div class= "col-sm-10">
		<form  id="ajoutGene"  method="POST" action = "WebService/ajoutGeneWS.php" onsubmit="return controleGene(this);"> <!-- reference au formulaire -->
		<p>
		<!--<fieldset class="scheduler-border">-->
				<legend class="scheduler-border"> Ajout d'un gène </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
					</br>

				<!--	<?php
					echo "<label style='display: block; width:50px; float:left;' for='nomGene'> Nom </label>";
					echo "<select name='nomGene'>";
					echo "<option value=\"Nouveau\">Nouveau</option>";
					$requete='SELECT DISTINCT nom from Gene ORDER BY nom';
					$value=requete($bdd,$requete);
					foreach ($value as $array) {
						foreach ($array as $key => $valeur) {
							echo "<option value=\"$valeur\">$valeur</option>";
						}
					}
					echo "</select>&nbsp;&nbsp;&nbsp";
					echo "<input type='text' id ='nomGene' name='nomGene' size='20'>";
					?>-->
						<label>Nom</label>
						<input type="text" id ="nomGene" name="nomGene" size="20"/>
					</br>
          </br>

					<input type="submit" name="nom" value=" Valider et ajouter un nouveau gène">
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
