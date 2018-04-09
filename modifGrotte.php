<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Grotte WHERE id=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$grotte=requete($bdd,$requete); /* value recupere la reponse de la requete */
?>


		<!-- FORMULAIRE D'AJOUT DE GROTTE -->
	</br>
	</br>

<div class="container-" style="margin-top:-400px; margin-left:200px;" >
	<form method="POST" action="tableauGrotte.php">
		<input type="submit" value="Revenir au tableau des grottes" />
	</form>

		<form  id="ajoutGrotte"  method="POST" action = "WebService/modifGrotteWS.php"> <!-- reference au formulaire -->
		<p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
			<fieldset class="scheduler-border fieldset-auto-width">
				<legend class="scheduler-border"> Modification de la grotte <?=$grotte[0]['nomcavite']?></legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
				</br>
                <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
				<label>Nom de la grotte</label>          <!-- Changer les size par rapport à la base de donnees -->
				<input required type="text" id ="nomGrotte" name="nomGrotte" value="<?=$grotte[0]['nomcavite']?>" size="50"/> * </br></br>

				<label>Type de cavité</label>  <!-- menu deroulant : a preciser les valeurs -->
					<select name="typeCavite" id="typeCavite">
						<option value="Standard">Standard</option>
						<option value="Choix2">Choix2</option>
						<option value="Choix3">Choix3</option>
					</select>

		        </br></br>

				<label>Latitude</label>
				<input type="text" id ="latitude" name="latitude" value="<?=$grotte[0]['latitude']?>" size="10" placeholder = "30° N"/></br></br>  <!-- type text pour simplifier la saisie -->

				<label>Longitude</label>
				<input type="text" id ="longitude" name="longitude" value="<?=$grotte[0]['longitude']?>" size="10" placeholder = "20° O"/></br></br>  <!-- type text pour simplifier la saisie -->

				<label>Type d'accès</label>
				<input type="text" id ="typeAcces" name="typeAcces" value="<?=$grotte[0]['typeacces']?>" size="20"/></br></br>

				<label>Système hydrographique</label>
				<select name="systemeHydro" id='listeSystemeHydrographique'>

<?php
				$requete='SELECT id, nom from SystemeHydrographique ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
                    $nom = $array['nom'];
                    $id = $array['id'];
                    echo "<option value=\"$id\"";
                    if ($grotte[0]['idsystemehydrographique']==$array['id']) {
                        echo "selected";
                    }
                    echo ">$nom</option>";
				}

				echo "</select>";
?>
				ou
				<input type = "button" id="affichageSystemeHydrographique" value = "ajouter un système hydrographique">

		        	</br></br>

				<label>Accès au public </label>
<?php
            echo "<input type='radio' id ='accesPublicOui' name='accesPublic' value='true'";
            if ($grotte[0]['accespublic']) {
                echo "checked";
            }
            echo "/>";
            echo "<label for='accesPublicOui'>oui</label>";
            echo "<input type='radio' id='accesPublicNon' name='accesPublic' value='false'";
            if ($grotte[0]['accespublic']) {
                echo "checked";
            }
            echo "/>";
            echo "<label for='accesPublicNon'>non</label>";
?>

				</br>
				</br>

				<input type="submit" name="nom" value="Valider les modifications et revenir au tableau"> &nbsp;&nbsp;

					</div>
				</div>
			</fieldset>
		</p>
		</form>

        <div id="divSystemeHydrographique" style="display:none;">
            <form  id="formSystemeHydrographique"  method="post">
                <label>nom</label>
                <input type="text" id ="nom" name="nom" required size="30"/></br></br>
                <label>département</label>
                <input type="number" id ="departement" name="departement"/></br></br>
                <button type="submit">Ajouter un système hydrographique</button></br></br>
            </form>
</div>

<?php
include 'HTML/pied.html';
?>
