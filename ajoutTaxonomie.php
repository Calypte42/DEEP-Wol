<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

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
