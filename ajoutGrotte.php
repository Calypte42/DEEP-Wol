<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>
<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>



		<!-- FORMULAIRE D'AJOUT DE GROTTE -->
	</br>
	</br>

<div class="container" style="margin-top:-400px; margin-right:10px;" >
	<form method="POST" action="tableauGrotte.php">
		<input type="submit" value="Revenir au tableau des grottes" />
	</form>

		<form  id="ajoutGrotte"  method="POST" action = "WebService/ajoutGrotteWS.php"> <!-- reference au formulaire -->
		<p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
			<fieldset class="scheduler-border fieldset-auto-width">
				<legend class="scheduler-border"> Ajout d'une grotte </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
				</br>
				<label>Nom de la grotte</label>          <!-- Changer les size par rapport à la base de donnees -->
				<input required type="text" id ="nomGrotte" name="nomGrotte" size="50"/> * </br></br>

				<label>Type de cavité</label>  <!-- menu deroulant : a preciser les valeurs -->
					<select name="typeCavite" id="typeCavite">
						<option value="Choix1">Choix1</option>
						<option value="Choix2">Choix2</option>
						<option value="Choix3">Choix3</option>
					</select>

		        </br></br>

				<label>Latitude</label>
				<input type="text" id ="latitude" name="latitude" size="10" placeholder = "30° N"/></br></br>  <!-- type text pour simplifier la saisie -->

				<label>Longitude</label>
				<input type="text" id ="longitude" name="longitude" size="10" placeholder = "20° O"/></br></br>  <!-- type text pour simplifier la saisie -->

				<label>Type d'accès</label>
				<input type="text" id ="typeAcces" name="typeAcces" size="20"/></br></br>

				<label>Système hydrographique</label>
				<select name="systemeHydro" id='listeSystemeHydrographique'>

<?php
				$requete='SELECT nom from SystemeHydrographique ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}

				echo "</select>";
		?>
				ou
				<input type = "button" id="affichageSystemeHydrographique" value = "ajouter un système hydrographique">

		        	</br></br>

				<label>Accès au public </label>
				<input type="radio" id ="accesPublicOui" name="accesPublic" value="true"/>
				<label for="accesPublicOui">oui</label>
				<input type = "radio" id = "accesPublicNon" name = "accesPublic" value="false">
				<label for="accesPublicNon">non</label>

				</br>
				</br>

				<input type="submit" name="nom" value="Valider et ajouter une nouvelle grotte"> &nbsp;&nbsp;
				<input type="submit" name="nom" value="Valider et ajouter un site"> &nbsp;&nbsp;
				<input type="submit" name="nom" value="Valider et revenir au tableau"> &nbsp;&nbsp;

					</div>
				</div>
			</fieldset>
		</p>
		</form>

        <div id="divSystemeHydrographique" style="display:none;">
            <form  id="formSystemeHydrographique"  method="post">
                <label>nom</label>
                <input type="text" id ="nom" name="nom" size="30"/></br></br>
                <label>département</label>
                <input type="number" id ="departement" name="departement"/></br></br>
                <button type="submit">Ajouter un système hydrographique</button></br></br>
            </form>
</div>

<?php
include 'HTML/pied.html';
?>
