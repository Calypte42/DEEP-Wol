<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'consultationModification.php';
?>
		<!-- Formulaire ajout éuipe dans BDD -->
		<fieldset class="scheduler-border">
				<legend class="scheduler-border"> Ajout d'un système hydrographique </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
		</br>
			<form  id="ajoutSystemeHydrographique"  method="post">
				<label>nom</label>
				<input type="text" id ="nom" name="nom" size="30"/></br></br>
			
				<label>département</label>
				<input type="number" id ="departement" name="departement"/></br></br>
			</form>
		</fieldset>

<?php
include 'HTML/pied.html';
?>
