<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>
<?php
include 'verificationConnexion.php';
include 'consultationModification.php';

$RetourNomGrotte=$_REQUEST['nomGrotte'];
$RetourIdGrotte=$_REQUEST['idGrotte'];
$RetourNomSite=$_REQUEST['site'];
$RetourIdSite=$_REQUEST['idSite'];
$RetourPiege=$_REQUEST['piege'];
$RetourEchantillon=$_REQUEST['numEchantillon'];
$RetourIdEchantillon=$_REQUEST['idEchantillon'];
echo "<form method='POST' action='tableauAnalyse.php?idEchantillon=$RetourIdEchantillon&numEchantillon=$RetourEchantillon&piege=$RetourPiege&nomGrotte=$RetourNomGrotte
&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>";
?>
<div class="container" style="margin-top:-400px; margin-left:200px;" >
<input type='submit' value='Retour au tableau' />
</form>
<!-- FORMULAIRE D'AJOUT D'UNE PCR -->
</br>
</br>

<!--<form method="POST" action="">
  <input type="submit" value="" />
</form>-->

  <form  id="ajoutPCR"  method="GET" action = "WebService/ajoutAnalyseWS.php"> <!-- reference au formulaire -->
  <p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
    <fieldset class="scheduler-border">
      <legend class="scheduler-border"> Ajout d'une Analyse </legend>
      <div class="control-group">
        <div class="controls bootstrap-timepicker">
      </br>

      <?php echo "Pour l'echantillon : $RetourEchantillon";
      echo "<input type='hidden' name='nomGrotte' value='$RetourNomGrotte' />";
      echo "<input type='hidden' name='idGrotte' value='$RetourIdGrotte' />";
      echo "<input type='hidden' name='site' value='$RetourNomSite' />";
      echo "<input type='hidden' name='idSite' value='$RetourIdSite' />";
      echo "<input type='hidden' name='piege' value='$RetourPiege' />";
      echo "<input type='hidden' name='numEchantillon' value='$RetourEchantillon' />";
      echo "<input type='hidden' name='idEchantillon' value='$RetourIdEchantillon' />";

      ?>
    </br></br>
    <label for='choixPCR'> PCR</label>
    <input type='radio' name='choixType' value="PCR" id='choixPCR' checked />
    <label for='choixqPCR'> qPCR</label>
    <input type='radio' name='choixType' value="qPCR" id='choixqPCR'/>

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
      <input required type="date" id ="date" name="date"/></br></br>

      <label for="resultat">Résultat </label>
      				<select name="resultat">
      						<option value="Positif"> Positif</option>
      						<option value="Négatif">Négatif</option>
                  <option value="Ambigü">Ambigü</option>
      				</select>

          </br></br>

          <label>Fasta</label>
          <input type="radio" id ="FastaOui" name="presenceFasta" value="true"/>
          <label for="FastaOui">oui</label>
          <input type = "radio" id = "FastaNon" name = "presenceFasta" value="false">
          <label for="FastaNon">non</label>

          </br>
          A faire apparaître si oui :
          <input type="file" id ="fasta" name="fasta"/>

          </br>

          <label>Electrophorégramme</label>
          <input type="radio" id ="ElectroOui" name="presenceElectrophoregramme" value="true"/>
          <label for="ElectroOui">oui</label>
          <input type = "radio" id = "ElectroNon" name = "presenceElectrophoregramme" value="false">
          <label for="ElectroNon">non</label>

          </br>

          A faire apparaître si oui :
          <input type="file" id ="electrophoregramme" name="electrophoregramme"/>
        </div>
      </div>
    </fieldset>
  </p>
  <input type="submit" name='nom' value="Valider et ajouter une nouvelle analyses" />
  <input type="submit" name='nom' value="Valider et revenir au tableau" />
  </form>
</div>
