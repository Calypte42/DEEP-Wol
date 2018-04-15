<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
?>
<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

      <div class= "col-sm-10">
        <?php
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
        <input type='submit' value='Revenir au tableau des analyses' />
        </form>

        </br>

        <!-- FORMULAIRE D'AJOUT D'UNE PCR -->
        <form  id="ajoutPCR"  method="GET" action = "WebService/ajoutAnalyseWS.php"> <!-- reference au formulaire -->
        <p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
          <!--<fieldset class="scheduler-border">-->
            <legend class="scheduler-border"> Ajout d'une analyse </legend>
            <div class="control-group">
              <div class="controls bootstrap-timepicker">

                <?php echo "Pour l'échantillon : $RetourEchantillon";
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
                <input type='radio' name='choixType' value="PCR" id='choixPCR' checked /> &nbsp;&nbsp;&nbsp;
                <label for='choixqPCR'> qPCR</label>
                <input type='radio' name='choixType' value="qPCR" id='choixqPCR'/>

              </br></br>

                <label style="display: block; width:150px;; float:left;">Nom du gène</label>
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

                <label style="display: block; width:150px; float:left;">Date</label>
                <input required type="date" id ="date" name="date"/></br></br>

                <label style="display: block; width:150px; float:left;" for="resultat">Résultat </label>
          				<select name="resultat">
          						<option value="Positif"> Positif</option>
          						<option value="Négatif">Négatif</option>
                      <option value="Ambigü">Ambigü</option>
          				</select>

                  </br></br>

                  <label style="display: block; width:150px;; float:left;">Fasta</label>
                  <input type="radio" id ="FastaOui" name="presenceFasta" value="true"/>
                  <label for="FastaOui">oui</label>
                  <input type = "radio" id = "FastaNon" name = "presenceFasta" value="false">
                  <label for="FastaNon">non</label>

                  </br>
                  A faire apparaître si oui :
                  <input type="file" id ="fasta" name="fasta"/>

                  </br>

                  <label style="display: block; width:150px;; float:left;">Electrophorégramme</label>
                  <input type="radio" id ="ElectroOui" name="presenceElectrophoregramme" value="true"/>
                  <label for="ElectroOui">oui</label>
                  <input type = "radio" id = "ElectroNon" name = "presenceElectrophoregramme" value="false">
                  <label for="ElectroNon">non</label>

                  </br>
                  A faire apparaître si oui :
                  <input type="file" id ="electrophoregramme" name="electrophoregramme"/>

                  </br>

                  <input type="submit" name='nom' value="Valider et ajouter une nouvelle analyse" />
                  <input type="submit" name='nom' value="Valider et revenir au tableau des analyses" />
              </div>
            </div>
    <!--</fieldset>-->
        </p>
        </form>
      </div>
    </div>
  </div>
