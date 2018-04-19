<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>
		<!-- Formulaire ajout éuipe dans BDD -->
		<fieldset>
		<legend>Ajout d'un auteur</legend>
		</br>
			<form  id="ajoutAuteur"  method="GET" action="WebService/ajoutAuteurWS.php">
				<label>nom</label>
				<input type="text" id ="initialeAuteur" name="initialeAuteur" size="10"/></br></br>

			</form>
		</fieldset>
<?php
include 'HTML/pied.html';
?>
