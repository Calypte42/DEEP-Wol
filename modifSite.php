<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Site WHERE id=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$site=requete($bdd,$requete); /* value recupere la reponse de la requete */
?>
		<!-- FORMULAIRE D'AJOUT DE SITE -->

		<div class= "col-sm-10">
		<?php
    $RetourId=$_REQUEST['idGrotte'];
    $Retour=$_REQUEST['grotte'];
		echo "<form method='POST' action='tableauSite.php?idGrotte=$RetourId&grotte=$Retour'>";
		?>

		<input type="submit" value="Revenir au tableau des sites" />
		</form>

		</br>

		<form  id="ajoutSite"  method="POST" action = "WebService/modifSiteWS.php"> <!-- reference au formulaire -->
		<p>
			<!--<fieldset class="scheduler-border">-->
				<legend class="scheduler-border"> Ajout d'un site </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
					</br>
          <input type="hidden" name="id" value="<?=$_GET['id']?>"/>

				<?php
				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */
				echo "<label for='idGrotte'>Dans la $Retour</label>";
				echo "<input type='hidden' name='idGrotte' value=$RetourId>";
				echo "<input type='hidden' name='grotte' value=$Retour>";
				?>

				</br></br>

				<?php
				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */
				echo "<label style='display: block; width:115px; float:left;' for='equipeSpeleo'>Equipe spéléo </label>";
				echo "<select name='codeEquipeSpeleo' id='listeEquipeSpeleo'>"; /* On cree une liste deroulante vide */
				$requete='SELECT codeEquipe from EquipeSpeleo';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
						echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
					}
				}
				echo "</select>";
				?>

				<input type = "button" id="affichageAjoutEquipe" value = "ajouter une équipe" onclick="affichageDiv('divEquipeSpeleo')"> <!-- rajout d'un bouton ajout d'une nouvelle équipe -->

				</br></br>

				<label style="display: block; width:115px; float:left;">Numéro de site</label>
				<input required = "required" type="text" id ="numSite" name="numSite" value="<?=$site[0]['numsite']?>" size="40"/> * </br></br>

				<label style="display: block; width:115px; float:left;">Profondeur</label>
				<!-- Mettre number -->
				<input type="number" id ="profondeur" name="profondeur" value="<?=$site[0]['profondeur']?>" size = "5"/></br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

				<!-- Mettre number -->
				<!--<label style="display: block; width:115px; float:left;">Temperature</label>
				<input type="number" id ="temperature" name="temperature" value="<?=$site[0]['temperature']?>" size = "5"/> °C</br></br> -->

				<label style="display: block; width:115px; float:left;">Type de sol</label>
				<input type="text" id ="typeSol" name="typeSol" value="<?=$site[0]['typesol']?>" size="20"/></br></br>
				<!-- Mettre number -->
				<label style="display: block; width:115px; float:left;">Distance à l'entrée</label>
				<input required type="number" id ="distanceEntree" name="distanceEntree" value="<?=$site[0]['distanceentree']?>" size="10"/> metres *</br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

				<label style="display: block; width:115px; float:left;">Présence d'eau</label>
        <input type="radio" id ="presenceEauOui" name="presenceEau" value="true"

				<?php
        if ($site[0]['presenceeau']) {
        	echo "checked";
        }
				?>
				/>
				<label for="presenceEauOui">oui</label>
				<input type = "radio" id = "presenceEauNon" name = "presenceEau" value="false"

				<?php
        if (!$site[0]['presenceeau']) {
          echo "checked";
        }
				?>
        />
				<label for="presenceEauNon">non</label>

				</br></br>

				<input type="submit" name="nom" value="Valider les modifications et revenir au tableau des sites"> &nbsp;&nbsp;

				</div>
			</div>
			<!--</fieldset>-->
		</p>
		</form>

    	<div id="divEquipeSpeleo" style="display:none;">
        <form  id="formEquipeSpeleo"  method="POST" onsubmit="return ajaxAjout('./WebService/ajoutEquipeWS.php', 'divEquipeSpeleo', this.id, 'listeEquipeSpeleo', 1)">
            <label>Equipe spéleo</label>
            <input type="text" id="codeEquipe" name="codeEquipe" required size="20"/> *
            <button type="submit">Ajouter une équipe</button></br></br>
        </form>
    	</div>
		</div>
	</div>
</div>

<?php
include 'HTML/pied.html';
?>
