<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'consultationModification.php';
?>
		<!-- Formulaire ajout éuipe dans BDD -->

		<form  id="ajoutEquipe"  method="post">
			<label>Equipe spéleo</label>
			<input type="text" id ="equipeSpeleo" name="equipeSpeleo" size="20"/></br></br>
		</form>
<?php
include 'HTML/pied.html';
?>
