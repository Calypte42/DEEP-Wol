<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$nomGene = $_GET['id'];
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<!-- FORMULAIRE D'AJOUT D'UN GENE -->
		<div class= "col-sm-10">
            <form action="recherche.php">
				<input type="submit" value="Retour" />
			</form>
			</br>
		<form  id="modifGene"  method="POST" action = "WebService/modifGeneWS.php" onsubmit="return controleGene(this, true);"> <!-- reference au formulaire -->
		<p>

				<legend class="scheduler-border"> Modification du gène : <?=$nomGene?> </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
					</br>

                    <input type="hidden" name="id" value="<?=$nomGene?>">
                    <input type="hidden" name="nomGenePrecedent" value="<?=$nomGene?>">

						<label>Nom</label>
						<input required type="text" id ="nomGene" name="nomGene" size="20" value="<?=$nomGene?>"/>
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
