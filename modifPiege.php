<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Piege WHERE codePiege='$id'";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$piege=requete($bdd,$requete); /* value recupere la reponse de la requete */
?>

<div class="container" style="margin-top:-400px; margin-left:200px;" >

<?php
$RetourNomGrotte=$_REQUEST['nomGrotte'];
$RetourIdGrotte=$_REQUEST['idGrotte'];
$RetourNomSite=$_REQUEST['site'];
$RetourIdSite=$_REQUEST['idSite'];

echo "<form method='POST' action='tableauPiege.php?idSite=$RetourIdSite&site=$RetourNomSite&idGrotte=$RetourIdGrotte&nomGrotte=$RetourNomGrotte'>";
?>
<input type="submit" value="Retour vers tableau des pieges" />
</form>
		<!-- FORMULAIRE D'AJOUT DE PIEGE -->

		<form  id="ajoutPiege"  method="POST" action = "WebService/modifPiegeWS.php"> <!-- reference au formulaire -->
		<p>
			<fieldset class="scheduler-border">
				<legend class="scheduler-border"> Ajout d'un piège </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
			</br>

				<?php

				/* on veut recuperer les valeurs de grotte deja existantes dans la bdd */

				echo "<label for='grotte'>Dans la Grotte : $RetourNomGrotte </label>";
				echo "<input type='hidden' value=$RetourNomGrotte name='nomGrotte'>"; /* On cree une liste deroulante vide */
				echo"<input type='hidden' value=$RetourIdGrotte name='idGrotte'>";

				?>

				</br></br>

                <input type="hidden" name="id" value="<?=$_GET['id']?>"/>

				<?php

				/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */

				echo "<label for='numSite'>Numéro du site : $RetourNomSite </label>";
				echo "<input type='hidden' value=$RetourNomSite name='site'>"; /* On cree une liste deroulante vide */
				echo "<input type='hidden' value=$RetourIdSite name='idSite'>";
				?>

				</br></br>

				<?php

				/* on veut recuperer les valeurs de numero de site deja existantes dans la bdd */

				echo "<label for='codeEquipeSpeleo'>Equipe qui a pose le piege </label>";
				echo "<select name='codeEquipeSpeleo'>"; /* On cree une liste deroulante vide */

				$requete='SELECT codeEquipe from EquipeSpeleo ORDER BY codeEquipe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
				foreach ($value as $array) { /* On parcourt les resultats possibles */
                    $codeEquipe = $array['codeequipe'];
                    echo "<option value=\"$codeEquipe\"";
                    if ($piege[0]['codeequipespeleo']==$array['codeequipe']) {
                        echo "selected";
                    }
                    echo ">$codeEquipe</option>";
				}

				echo "</select>";
				?>

				</br></br>

				<label>Code du piège</label>
				<input required type="text" id ="codePiege" name="codePiege" value="<?=$piege[0]['codepiege']?>" size="20"/>*</br></br>

				<label>Date de pose</label>
				<input type="date" id ="datePose" name="datePose" value="<?=$piege[0]['datepose']?>"/></br></br>

				<label>Heure de pose</label>
				<input type="time" id ="heurePose" name="heurePose" value="<?=$piege[0]['heurepose']?>"/></br></br>

				<label>Date de récupération</label>
				<input type="date" id ="dateRecup" name="dateRecup" value="<?=$piege[0]['daterecup']?>"/></br></br> <!-- type text pour simplifier la saisie -->

				<label>Heure de récupération</label>
				<input type="time" id ="heureRecup" name="heureRecup" value="<?=$piege[0]['heurerecup']?>"/></br></br>

				<label>Date de tri</label>
				<input type="date" id ="dateTri" name="dateTri" value="<?=$piege[0]['datetri']?>"/></br></br>

				<label>Problèmes recontrés</label> </br>
				<textarea id="probleme" name="probleme" value="<?=$piege[0]['probleme']?>" rows = "5" cols = "40"></textarea>

				</br>
				</br>

                <input type="submit" name="nom" value="Valider les modifications et revenir au tableau des pieges"> &nbsp;&nbsp;

					</div>
				</div>
			</fieldset>
		</p>
		</form>
</div>
<?php
include 'HTML/pied.html';
?>
