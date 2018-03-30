<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

		<!-- FORMULAIRE D'AJOUT D'UN GENE -->

		<form  id="ajoutGene"  method="POST" action = "WebService/ajoutGeneWS.php"> <!-- reference au formulaire -->
		<p>
			<fieldset class="scheduler-border">
				<legend class="scheduler-border"> Ajout d'un gène </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
			</br>

				<label>Nom</label>
				<input type="text" id ="nomGene" name="nomGene" size="20"/></br></br>

		        </br>

				<input type="submit" name="nom" value=" Valider et ajouter un nouveau gène">

			</fieldset>
		</p>
		</form>
<?php
include 'HTML/pied.html';
?>
