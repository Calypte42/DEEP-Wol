<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$nomGene = $_GET['id'];
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<!-- FORMULAIRE D'AJOUT D'UN GENE -->
		<div class= "col-sm-10">
		<form  id="ajoutGene"  method="POST" action = "WebService/modifGeneWS.php" onsubmit="return controleGene(this, true);"> <!-- reference au formulaire -->
		<p>
		<!--<fieldset class="scheduler-border">-->
				<legend class="scheduler-border"> Modification du gène : <?=$nomGene?> </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
					</br>

                    <input type="hidden" name="nomGenePrecedent" value="<?=$nomGene?>">

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
						<input type="text" id ="nomGene" name="nomGene" size="20" value="<?=$nomGene?>"/>
					</br>
          </br>

					<input type="submit" name="nom" value=" Valider la modification">
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
