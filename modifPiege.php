<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Piege WHERE codePiege='$id'";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$piege=requete($bdd,$requete); /* value recupere la reponse de la requete */
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<div class= "col-sm-7">

		<?php
		$RetourNomGrotte=$_REQUEST['nomGrotte'];
		$RetourIdGrotte=$_REQUEST['idGrotte'];
		$RetourNomSite=$_REQUEST['site'];
		$RetourIdSite=$_REQUEST['idSite'];

		echo "<form method='POST' action='tableauPiege.php?idSite=$RetourIdSite&site=$RetourNomSite&idGrotte=$RetourIdGrotte&nomGrotte=$RetourNomGrotte'>";
		echo "<input type='submit' value='Revenir au tableau des pièges' />";
		echo "</form>";
		?>
		<!--<input type="submit" value="Retour vers tableau des pièges" />
		</form>-->
		</br>
		<!-- FORMULAIRE D'AJOUT DE PIEGE -->
		<form  id="modifPiege"  method="POST" action = "WebService/modifPiegeWS.php" onsubmit="return controlePiege(this, true);"> <!-- reference au formulaire -->
		<p>
			<!--<fieldset class="scheduler-border">-->
				<legend class="scheduler-border"> Grotte : <?=$RetourNomGrotte?> <br/>
                        Site : <?=$RetourNomSite?> <br/><br/>
                        Modification du piège : <?=$piege[0]['codepiege']?></legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">

                        <input type='hidden' name='idGrotte' value="<?=$RetourIdGrotte?>">
                        <input type='hidden' name='idGrotteForm' value="<?=$RetourIdGrotte?>">
                        <input type='hidden' name='nomGrotte' value="<?=$RetourNomGrotte?>">
                        <input type='hidden' name='idSite' value="<?=$RetourIdSite?>">
                        <input type='hidden' name='site' value="<?=$RetourNomSite?>">

                        <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
                        <input type='hidden' name='idSiteForm' value="<?=$RetourIdSite?>">
                        <input type="hidden" name="codePiegePrecedent" value="<?=$piege[0]['codepiege']?>"/>
                        <input type="hidden" name="codeEquipePrecedent" value="<?=$piege[0]['codeequipespeleo']?>"/>

						<?php
						echo "<label style='display: block; width:150px; float:left;' for='codeEquipeSpeleo'>Equipe qui a posé le piège</label>";
						echo "<select name='codeEquipeSpeleo' id='listeEquipeSpeleo' onchange='ajoutDiv(this.options[this.selectedIndex].value, \"divEquipeSpeleo\")'>"; /* On cree une liste deroulante vide */
                        echo "<option disabled selected value>Choisir</option>";
						$requete='SELECT codeEquipe from EquipeSpeleo ORDER BY codeEquipe';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
						$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
						foreach ($value as $array) { /* On parcourt les resultats possibles */
							foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
                                if ($piege[0]['codeequipespeleo'] == $valeur) {
                                    echo "<option selected value=\"$valeur\">$valeur</option>";
                                } else {
								    echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
                                }
                            }
						}
                        echo "<option value='autre'>[Ajouter]</option>";
						echo "</select>";
						?>

						</br></br>

						<label style="display: block; width:150px; float:left;">Code du piège</label>
						<input required type="text" id ="codePiege" name="codePiege" value="<?=$piege[0]['codepiege']?>" size="20"/> *</br></br>

						<label style="display: block; width:150px; float:left;">Date de pose</label>
						<input type="date" id ="datePose" name="datePose" value="<?=$piege[0]['datepose']?>"/>

						&nbsp;&nbsp;

						<label>Heure de pose</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="time" id ="heurePose" name="heurePose" value="<?=$piege[0]['heurepose']?>"/></br></br>

						<label style="display: block; width:150px; float:left;">Date de récupération</label>
						<input type="date" id ="dateRecup" name="dateRecup" value="<?=$piege[0]['daterecup']?>"/>

						&nbsp;&nbsp;

						<label>Heure de récupération</label>
						<input type="time" id ="heureRecup" name="heureRecup" value="<?=$piege[0]['heurerecup']?>"/></br></br>

						<label style="display: block; width:150px; float:left;">Date de tri</label>
						<input type="date" id ="dateTri" name="dateTri" value="<?=$piege[0]['datetri']?>"/></br></br>

						<label style="display: block; width:150px; float:left;">Temperature</label>
						<input type="number" id ="temperature" name="temperature" size = "5" value="<?=$piege[0]['temperature']?>"/> °C</br></br> <!-- a voir pour rajouter un pas (pour decimal) step =""-->

						<label>Problèmes rencontrés</label> </br>
						<textarea id="probleme" name="probleme" rows = "5" cols = "40"><?=$piege[0]['probleme']?></textarea>

						</br>
						</br>

                        <input type='submit' name='nom' value='Valider et revenir au tableau des pièges'>

						</div>
				</div>
					<!--</fieldset>-->
				</p>
				</form>
			</div>

            <div class = "col-sm-3" style = "float:right; margin-top:150px;">
                <div id="divEquipeSpeleo" style="display:none;">
                        <form  id="formEquipeSpeleo"  method="POST" onsubmit="return ajaxAjout('./WebService/ajoutEquipeWS.php', 'divEquipeSpeleo', this.id, 'listeEquipeSpeleo')">
                            <fieldset style = "padding-left:5px;" >
                                <legend class="scheduler-border"> Ajout Equipe spéleo </legend>
                                <label style = "float:left;">Equipe spéléo</label>&nbsp;
                                <input class="valeurs" type="text" id="codeEquipe" name="codeEquipe" required size="20"/> *
                                </br></br>
                                <button type="submit">Ajouter une équipe</button></br></br>
                            </fieldset>
                        </form>
                </div>
            </div>

		</div>
	</div>

<?php
include 'HTML/pied.html';
?>
