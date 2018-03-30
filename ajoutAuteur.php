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
			<form  id="ajoutSystemeHydrographique"  method="GET" action="WebService/ajoutAuteurWS.php">
				<label>nom</label>
				<input type="text" id ="nomAuteur" name="nomAuteur" size="50"/></br></br>

				<label>prénom</label>
				<input type="text" id ="prenomAuteur" name="prenomAuteur" size = "50"/></br></br>
			</form>
		</fieldset>
<?php
include 'HTML/pied.html';
?>
