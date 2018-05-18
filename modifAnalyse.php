<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';

$id = $_GET['id'];
$requete="SELECT * FROM Analyses WHERE id=$id";  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
$analyse=requete($bdd,$requete); /* value recupere la reponse de la requete */
?>
        <script src="./javascript/eventListener.js" type="text/javascript"></script>
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
        echo "<input type='submit' value='Revenir au tableau des analyses' />";
        echo "</form>";

        ?>
      <!--  <input type='submit' value='Revenir au tableau des analyses' />
      </form>-->

        </br>

        <!-- FORMULAIRE D'AJOUT D'UNE PCR -->
        <form  id="modifAnalyse"  method="POST" action = "WebService/modifAnalyseWS.php" onsubmit="return controleAnalyse(this, true)" enctype='multipart/form-data'> <!-- reference au formulaire -->
        <p> <!-- car balise input ou select ne peut pas etre imbriquee directement dans form -->
          <!--<fieldset class="scheduler-border">-->
            <legend class="scheduler-border"> Grotte : <?=$RetourNomGrotte?> <br/>
                    Site : <?=$RetourNomSite?> <br/>
                    Piège : <?=$RetourPiege?> <br/>
                    Echantillon : <?=$RetourEchantillon?><br/><br/>
                    Modification d'analyse</legend>
            <div class="control-group">
              <div class="controls bootstrap-timepicker">

                  <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
                  <input type="hidden" name="dateAnalysePrecedent" value="<?=$analyse[0]['dateanalyse']?>"/>
                  <input type="hidden" name="nomGenePrecedent" value="<?=$analyse[0]['nomgene']?>"/>
                  <input type="hidden" name="lienFASTAPrecedent" value="<?=$analyse[0]['fasta']?>"/>
                  <input type="hidden" name="lienElectroPrecedent" value="<?=$analyse[0]['electrophoregramme']?>"/>

                <?php
                    $nomFASTA = $analyse[0]['fasta'];
                    $nomElectrophoregramme = $analyse[0]['electrophoregramme'];

                    if (!empty($nomFASTA)) {
                        $nomFASTA = explode("/", $analyse[0]['fasta'])[2];
                    } else {
                        $nomFASTA = "";
                    }
                    if (!empty($nomElectrophoregramme)) {
                        $nomElectrophoregramme = explode("/", $analyse[0]['electrophoregramme'])[2];
                    } else {
                        $nomElectrophoregramme = "";
                    }
                    echo "<input type='hidden' name='nomFASTAPrecedent' value='$nomFASTA'/>";
                    echo "<input type='hidden' name='nomElectroPrecedent' value='$nomElectrophoregramme'/>";


                    echo "<input type='hidden' name='nomGrotte' value='$RetourNomGrotte' />";
                    echo "<input type='hidden' name='idGrotte' value='$RetourIdGrotte' />";
                    echo "<input type='hidden' name='site' value='$RetourNomSite' />";
                    echo "<input type='hidden' name='idSite' value='$RetourIdSite' />";
                    echo "<input type='hidden' name='piege' value='$RetourPiege' />";
                    echo "<input type='hidden' name='numEchantillon' value='$RetourEchantillon' />";
                    echo "<input type='hidden' name='idEchantillon' value='$RetourIdEchantillon' />";

                    echo "<label for='choixPCR'> PCR</label>";
                    echo "<input ";
                    if ($analyse[0]['type'] == "PCR") {
                        echo "checked";
                    }
                    echo " type='radio' name='type' value='PCR' id='choixPCR' /> &nbsp;&nbsp;&nbsp;";
                    echo "<label for='choixqPCR'> qPCR</label>";
                    echo "<input ";
                    if ($analyse[0]['type'] == "qPCR") {
                        echo "checked";
                    }
                    echo " type='radio' name='type' value='qPCR' id='choixqPCR'/>";

                ?>

              </br></br>

                <label style="display: block; width:150px;; float:left;">Nom du gène</label>
                  <select name="nomGene" id='listeGene'>
                  <?php
          				$requete='SELECT nom from gene ORDER BY nom';  /* On prepare une requete permettant de recuperer l'ensemble des valeurs qu'on veut */
          				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
          				foreach ($value as $array) { /* On parcourt les resultats possibles */
          					foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
                                if ($analyse[0]['nomgene']) {
          						    echo "<option selected value=\"$valeur\">$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
                                } else {
                                    echo "<option value=\"$valeur\">$valeur</option>";
                                }
          					}
          				}
        				  echo "</select>";
            		  ?>

                </br></br>

                <label style="display: block; width:150px; float:left;">Date</label>
                <input required type="date" id ="date" name="date" value="<?=$analyse[0]['dateanalyse']?>"/></br></br>

                <label style="display: block; width:150px; float:left;" for="resultat">Résultat </label>
          				<select name="resultat">
                        <?php
          					echo "<option ";
                        if ($analyse[0]['resultat'] == "Positif") {
                            echo "selected";
                        }
                            echo " value='Positif'> Positif</option>";
          					echo "<option ";
                        if ($analyse[0]['resultat'] == "Négatif") {
                            echo "selected";
                        }
                            echo " value='Négatif'>Négatif</option>";
                            echo "<option ";
                        if ($analyse[0]['resultat'] == "Ambigü") {
                            echo "selected";
                        }
                            echo " value='Ambigü'>Ambigü</option>";
                        ?>
          				</select>

                  </br></br>

                  <label style="display: block; width:150px;; float:left;">Fasta</label>
                  <input type='radio' id ='FastaOui' name='presenceFasta' value='changer' required checked onchange="afficher('fasta', 'block'); requis('fasta');"/>
                  <label for='FastaOui'>ajouter/changer</label>
                  <input type = 'radio' id = 'FastaNon' name = 'presenceFasta' value='supprimer' required onchange="cacher('fasta'); supprimerValeur('fasta'); nonRequis('fasta');">
                  <label for='FastaNon'>supprimer</label>
                  <input checked type = 'radio' id = 'FastaInchangé' name = 'presenceFasta' value='inchange' required onchange="cacher('fasta'); supprimerValeur('fasta'); nonRequis('fasta');">
                  <label for='FastaInchangé'>ne pas changer</label>
                  <?php
                  if (!empty($analyse[0]['fasta'])) {
                      $lienFASTA = $analyse[0]['fasta'];
                      echo "&nbsp;&nbsp;&nbsp;<a href='$lienFASTA' onclick=\"window.open(this.href, 'newwindow',
                      'width=800,height=600'); return false;\">FASTA actuel</a>";
                  }
                  ?>

                  </br>
                  <input type="file" id ="fasta" name="fasta" style="display:none;"/>

                  </br>

                  <label style="display: block; width:150px;; float:left;">Electrophorégramme</label>
                  <input type="radio" id ="ElectroOui" name="presenceElectrophoregramme" value="changer" required onchange="afficher('electrophoregramme', 'block'); requis('electrophoregramme');"/>
                  <label for="ElectroOui">ajouter/changer</label>
                  <input type = "radio" id = "ElectroNon" name = "presenceElectrophoregramme" value="supprimer" required checked onchange="cacher('electrophoregramme'); supprimerValeur('electrophoregramme'); nonRequis('electrophoregramme')">
                  <label for="ElectroNon">supprimer</label>
                  <input checked type = 'radio' id = 'ElectroInchangé' name = 'presenceElectrophoregramme' value='inchangé' required onchange="cacher('electrophoregramme'); supprimerValeur('electrophoregramme'); nonRequis('electrophoregramme');">
                  <label for='ElectroInchangé'>ne pas changer</label>
                  <?php
                  if (!empty($analyse[0]['electrophoregramme'])) {
                      $lienElectro = $analyse[0]['electrophoregramme'];
                      echo "&nbsp;&nbsp;&nbsp;<a href='$lienElectro' onclick=\"window.open(this.href, 'newwindow',
                      'width=800,height=600'); return false;\">Electrophorégramme actuel</a>";
                  }
                  ?>

                  </br>
                  <input type="file" id ="electrophoregramme" name="electrophoregramme" style="display:none;"/>

                  </br>

                  <input type='submit' name='nom' value='Valider et revenir au tableau des analyses'>


              </div>
            </div>
    <!--</fieldset>-->
        </p>
        </form>
      </div>
    </div>
  </div>
