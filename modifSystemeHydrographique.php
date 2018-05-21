<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM SystemeHydrographique WHERE id=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$systemeHydro=requete($bdd,$requete);
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<!-- FORMULAIRE D'AJOUT D'UN GENE -->
		<div class= "col-sm-10">
            <form action="recherche.php">
				<input type="submit" value="Retour" />
			</form>
            </br>
		<form  id="modifSystemeHydro"  method="POST" action = "WebService/modifSystemeHydrographiqueWS.php" onsubmit="return controleSystemeHydro(this);"> <!-- reference au formulaire -->
		<p>

				<legend class="scheduler-border"> Modification du système hydrographique : <?=$systemeHydro[0]['nom']?> <?=$systemeHydro[0]['departement']?> <?=$systemeHydro[0]['pays']?></legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
					</br>
                    </br>

                    <input type="hidden" name="id" value="<?=$_GET['id']?>">
                    <input type="hidden" name="nomPrecedent" value="<?=$systemeHydro[0]['nom']?>">
                    <input type="hidden" name="departementPrecedent" value="<?=$systemeHydro[0]['departement']?>">
                    <input type="hidden" name="paysPrecedent" value="<?=$systemeHydro[0]['pays']?>">

						<label>Nom</label>
						<input type="text" required id ="nom" name="nom" size="20" value="<?=$systemeHydro[0]['nom']?>"/>
					</br>
                    </br>
                        <label>Département</label>
                        <input type="text" required id ="departement" name="departement" size="20" value="<?=$systemeHydro[0]['departement']?>"/>
                    </br>
                    </br>
                        <label>Pays</label>
                        <input type="text" required id ="pays" name="pays" size="20" value="<?=$systemeHydro[0]['pays']?>"/>
                    </br>
          </br>

					<input type="submit" value=" Valider la modification">
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
