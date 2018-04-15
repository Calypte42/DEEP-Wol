<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

			<!-- FORMULAIRE D'AJOUT DE LA TAXONOMIE -->
			<div class= "col-sm-10">
			<form  id="ajoutTaxonomie"  method="GET" action = "WebService/ajoutTaxonomieWS.php"> <!-- reference au formulaire -->
			<p>
				<!--<fieldset class="scheduler-border">-->
					<legend class="scheduler-border"> Ajout d'une taxonomie </legend>
					<div class="control-group">
						<div class="controls bootstrap-timepicker">
						</br>

							<label style="display: block; width:100px; float:left;">Classe</label>
							<input type="text" id ="classeTaxo" name="classeTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Ordre</label>
							<input type="text" id ="ordreTaxo" name="ordreTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Famille</label>
							<input type="text" id ="familleTaxo" name="familleTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Sous-famille</label>
							<input type="text" id ="sousFamilleTaxo" name="sousFamilleTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Genre</label>
							<input type="text" id ="genreTaxo" name="genreTaxo" size="40"/></br></br>

					    <label style="display: block; width:100px; float:left;">Espèce</label>
							<input type="text" id ="especeTaxo" name="especeTaxo" size="40"/></br></br>

			   			<label style="display: block; width:100px; float:left;">Photo</label>
							<input type="file" id ="photo" name="photo"/></br></br>

							<input type="submit" name="nom" value="Valider et ajouter une nouvelle taxonomie">
							<input type="submit" name='nom' value="Valider et revenir au tableau" />

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
