<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Personne WHERE id=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$personne=requete($bdd,$requete);
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<!-- FORMULAIRE D'AJOUT D'UN GENE -->
		<div class= "col-sm-10">
            <form action="recherche.php">
				<input type="submit" value="Retour" />
			</form>
            </br>
		<form  id="modifPersonne"  method="POST" action = "WebService/modifPersonneWS.php" onsubmit="return controlePersonne(this);"> <!-- reference au formulaire -->
		<p>

				<legend class="scheduler-border"> Modification des initiales de la personne : <?=$personne[0]['initiale']?> </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
					</br>

                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="hidden" name="initialesPersonnePrecedente" value="<?=$personne[0]['initiale']?>">

						<label>Initiales</label>
						<input type="text" required id ="nomPersonne" name="nomPersonne" size="4" maxlength="4" value="<?=$personne[0]['initiale']?>"/>
					</br>
          </br>

					<input type="submit" name="nom" value=" Valider la modification">
					</div>
				</div>

		</p>
		</form>
		</div>
	</div>
</div>

<?php
include 'HTML/pied.html';
?>
