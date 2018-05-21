<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$codeEquipe = $_GET['codeEquipe'];
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
		<!-- FORMULAIRE D'AJOUT D'UN GENE -->
		<div class= "col-sm-10">
            <form action="recherche.php">
				<input type="submit" value="Retour" />
			</form>
            </br>
		<form  id="modifPersonne"  method="POST" action = "WebService/modifEquipeWS.php" onsubmit="return controleEquipeSpeleo(this);"> <!-- reference au formulaire -->
		<p>

				<legend class="scheduler-border"> Modification du code de l'équipe de spéléologie : <?=$codeEquipe?> </legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker">
					</br>

                    <input type="hidden" name="id" value="<?=$codeEquipe?>">
                    <input type="hidden" name="codeEquipePrecedent" value="<?=$codeEquipe?>">

						<label>Code Equipe</label>
						<input required type="text" id ="codeEquipe" name="codeEquipe" size="20" value="<?=$codeEquipe?>"/>
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
