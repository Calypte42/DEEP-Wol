<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>
<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

<!-- FORMULAIRE D'AJOUT D'UNE PCR -->
</br>
</br>

<!--<form method="POST" action="">
  <input type="submit" value="" />
</form>-->
<div class="container" style="margin-top:-400px; margin-right:10px;" >
  <form  id="ajoutPCR"  method="POST" action = "WebService/ajoutPCRWS.php"> <!-- reference au formulaire -->
  <p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
    <fieldset class="scheduler-border">
      <legend class="scheduler-border"> Ajout d'une PCR </legend>
      <div class="control-group">
        <div class="controls bootstrap-timepicker">
      </br>
      <label>Num Echantillon</label>
      <input required type="text" id ="numEchantillon" name="numEchantillon" size="20"/></br></br>

      <label>Nom du gène</label>
      <select name="nomGene" id='listeGene'>
      <?php
  				$requete='SELECT nom from gene ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
  				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
  				foreach ($value as $array) { /* On parcourt les resultats possibles */
  					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
  						echo "<option value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
  					}
  				}

  				echo "</select>";
  		?>

      </br></br>

      <label>Date</label>
      <input required type="date" id ="datePCR" name="datePCR"/></br></br>

      <label for="resultat">Résultat </label>
      				<select name="resultat">
      						<option value="Positif"> Positif</option>
      						<option value="Négatif">Négatif</option>
                  <option value="Ambigü">Ambigü</option>
      				</select>

          </br></br>

          <label>Fasta</label>
          <input type="radio" id ="FastaOui" name="fasta" value="true"/>
          <label for="FastaOui">oui</label>
          <input type = "radio" id = "FastaNon" name = "fasta" value="false">
          <label for="FastaNon">non</label>

          </br>
          A faire apparaître si oui :
          <input type="file" id ="fasta" name="fasta"/>

          </br>

          <label>Electrophorégramme</label>
          <input type="radio" id ="ElectroOui" name="electrophoregramme" value="true"/>
          <label for="ElectroOui">oui</label>
          <input type = "radio" id = "ElectroNon" name = "electrophoregramme" value="false">
          <label for="ElectroNon">non</label>

          </br>

          A faire apparaître si oui :
          <input type="file" id ="fasta" name="fasta"/>
        </div>
      </div>
    </fieldset>
  </p>
  </form>
</div>
