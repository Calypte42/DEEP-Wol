<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include 'verificationConnexion.php';
include 'HTML/entete.html';
?>

<!--<h2> Voici la page d'extraction des données des échantillons</h2></br>-->
<div class="container-fluid" style="margin-top:70px;">
  <div class="row">
    <div class="col-sm-12">
<!--<p>
  Tout d'abord selectionner les élements que vous voulez voir apparaitre dans le tableau de résultat
  puis appliquer les filtres desire en selectionnant les grottes, sites et pieges qui vous interessent !
</p>-->
      <form id="formulaire" method="GET" onsubmit="return controleExtraction(this);" action="telechargementCSV.php">
        <label for="choixExtraction">Type de données à extraire</label>
        <select name="choixExtraction" id="choixExtraction">
          <option value="CSV">Données : Format CSV </option>
          <option value="Fasta">Données Génétique : Format Fasta</option>
        </select>
      </div>
    </div>

    <label for="nomFichier">Nom du fichier téléchargé : </label>
    <input type="text" name="nomFichier" />

      <div id="disparaitreSiFasta">
        <div class="row">
          <div class="col-sm-12" style="margin-top:20px; margin-bottom:10px;">
            <h4 style="border-bottom: 1px solid; border-top: 1px solid; padding-top:10px; font-size:20px;">Choix des attributs </h4>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-2 col-sm-offset-4">
            <?php
            $listeAttributGrotte = array('nomcavite'=>'Nom Cavite','typecavite'=>'Type de cavite','latitude'=>'Latitude','longitude'=>'Longitude','typeacces'=>'Type d\'acces','accespublic'=> 'Acces au public','nomSystemeHydrographique'=>'Nom du systeme hydrographique','departement'=>'Departement');
            $listeAttributSite = array('profondeur'=>'Profondeur','typesol'=>'Type de sol','numsite'=>'Numero du site','distanceentree'=>'Distance a l\'entre','presenceeau'=>'Presence d\'eau');
            $listeAttributPiege = array('codepiege'=>'Code du piege','datepose'=>'Date de pose','heurepose'=>'Heure de pose','daterecup'=>'Date de recuperation','heurerecup'=>'Heure de récupération','probleme'=>'Probleme','datetri'=>'Date de tri','temperature'=>"Temperature");
            $listeAttributEchantillon = array('numEchantillon'=>'Numero de l\'echantillon','formeStockage'=>'Forme de stockage','lieuStockage'=>'Lieu de stockage','niveauIdentification'=>'Niveau d\'identification','infecteBacterie'=>'Infecte par bacterie','nombreindividu'=>'Nombre d\'individu','classe'=>'Classe','ordre'=>'Ordre','famille'=>'Famille','sousfamille'=>'Sous-famille','genre'=>'Genre','espece'=>'Espece','initialeAuteur'=>'Initial de l\'auteur');

            /*echo"<div class='container'>";*/
            echo "<input style='float:right;' type='button' id='boutonToutSelectionner' value='Tout selectionner'>";
          echo "</div>";
          echo "<div class='col-sm-2'>";
            echo "<input style='float:center;' type='button'  id='boutonToutDeselectionner' value='Tout deselectionner'>";
          echo "</div>";
        echo "</div>";

        /* Début des row pour les titres des checkbox d'échantillon et pièges */
        echo"<div class='row'>";
          echo"<div class='col-sm-6'>";
            echo "<h4 style='float:left; margin-top:25px; margin-left:15px;'>Attributs des échantillons</h4>";
          echo "</div>";

          echo"<div class='col-sm-6'>";
            echo "<h4 style='float:left; margin-top:25px; margin-left:15px;'>Attributs des pièges</h4>";
          echo "</div>";
        echo "</div>";
        /* Fin des row pour les titres des checkbox d'échantillon et pièges */

        /* Début des rows pour les checkbox d'échantillon et pièges */
        echo"<div class='row'>";
          echo"<div class='col-sm-6' id='divCheckEchantillon'>";
            echo "<fieldset style='margin-top:3px; background-color: lightgrey; border:double; padding-right:10px; padding-left:10px; padding-bottom:10px; padding-top:10px;'>";
            /*echo "<legend style='text-align:center; font-size:18px;'> Attributs des échantillons</legend>";*/
            echo "<input type='button' value='Tout selectionner' id='selectionEchantillon'/>";
            echo "<input style='float:right;' type='button' value='Tout deselectionner' id='deselectionEchantillon'/></br>";

            foreach ($listeAttributEchantillon as $key => $value) {
              echo"<div class='col-sm-5'>";
              echo "<label style='margin-top:15px;' for=$key>$value</label>";
              echo "</div>";
              echo"<div class='col-sm-1'>";
              echo "<input style='margin-top:15px;' class='checkboxExtraction' type='checkbox' name='listeItem[]' id=$key value=$key>";
              echo "</div>";
            }
            echo"</fieldset>";
          echo"</div>";

          echo"<div class='col-sm-6' id='divCheckPiege'>";
            echo "<fieldset style='margin-top:3px; background-color: lightgrey; border:double; padding-right:10px; padding-left:10px; padding-bottom:10px; padding-top:10px;'>";
            /*echo "<legend style='text-align:center; font-size:18px;'> Attributs des pièges</legend>";*/
            echo "<input type='button' value='Tout selectionner' id='selectionPiege'/>";
            echo "<input style='float:right;' type='button' value='Tout deselectionner' id='deselectionPiege'/></br>";

            foreach ($listeAttributPiege as $key => $value) {
              echo"<div class='col-sm-5'>";
              echo "<label style='margin-top:15px;' for=$key>$value</label>";
              echo "</div>";
              echo"<div class='col-sm-1'>";
              echo "<input style='margin-top:15px;' class='checkboxExtraction' type='checkbox' name='listeItem[]' id=$key value=$key>";
              echo "</div>";
            }
            echo"</fieldset>";
          echo"</div>";
        echo"</div>";
        /* Fin des rows pour les checkbox d'échantillon et pièges */

        /* Début des row pour les titres des checkbox de sites et grottes */
        echo"<div class='row'>";
          echo"<div class='col-sm-6'>";
            echo "<h4 style='float:left; margin-left:15px;'>Attributs des sites</h4>";
          echo "</div>";

          echo"<div class='col-sm-6'>";
            echo "<h4 style='float:left; margin-left:15px;'>Attributs des grottes</h4>";
          echo "</div>";
        echo "</div>";
        /* Fin des rows pour les titres d'échantillon et pièges */

        /* Début des rows pour les checkbox de sites et grottes */
        echo"<div class='row'>";
          echo"<div class='col-sm-6' id='divCheckSite'>";
            echo "<fieldset style='margin-top:3px; background-color: lightgrey; border:double; padding-right:10px; padding-left:10px; padding-bottom:10px; padding-top:10px;'>";
            /*echo "<legend style='text-align:center; font-size:18px;'> Attributs des sites</legend>";*/
            echo "<input type='button' value='Tout selectionner' id='selectionSite'/>";
            echo "<input style='float:right;' type='button' value='Tout deselectionner' id='deselectionSite'/></br>";
            foreach ($listeAttributSite as $key => $value) {
              echo"<div class='col-sm-5'>";
              echo "<label style='margin-top:15px;' for=$key>$value</label>";
              echo "</div>";
              echo"<div class='col-sm-1'>";
              echo "<input style='margin-top:15px;' class='checkboxExtraction' type='checkbox' name='listeItem[]' id=$key value=$key>";
              echo "</div>";
            }
            echo"</fieldset>";
          echo"</div>";

          echo"<div class='col-sm-6' id='divCheckGrotte'>";
            echo "<fieldset style='margin-top:3px; background-color: lightgrey; border:double; padding-right:10px; padding-left:10px; padding-bottom:10px; padding-top:10px;'>";
            /*echo "<legend style='text-align:center; font-size:18px;'> Attributs des grottes</legend>";*/
            echo "<input type='button' value='Tout selectionner' id='selectionGrotte'/>";
            echo "<input style='float:right;' type='button' value='Tout deselectionner' id='deselectionGrotte'/></br>";
            foreach ($listeAttributGrotte as $key => $value) {
              echo"<div class='col-sm-5'>";
              echo "<label style='margin-top:15px;' for=$key>$value</label>";
              echo "</div>";
              echo"<div class='col-sm-1'>";
              echo "<input style='margin-top:15px;' class='checkboxExtraction' type='checkbox' name='listeItem[]' id=$key value=$key>";
              echo "</div>";
            }
            echo"</fieldset>";
            echo"</div>";
          echo"</div>";
          /* Fin des rows pour les checkbox de sites et grottes */

      echo"</div>"; /* ferme l'id disparaitreSiFasta */
            ?>
<!--</div>  ferme la div container-fluid -->

        <!--  </fieldset>-->
      <!--  </div> De la division disparaitreSiFasta -->
      <!--</br>
      </br>
      <div class="container">
      <p> Pour choisir plusieurs éléments dans une liste multiple, maintenez la touche CTRL enfoncée</p>
    </br>-->

    <div style="display:none" id="apparaitreSiFasta">
    <label for="selectChoixGene">Choix du gène à extraire : </label>
    <select id=selectChoixGene name=selectChoixGene>
    <?php
    $requete='SELECT DISTINCT nom from Gene ORDER BY nom';
    $value=requete($bdd,$requete);
    foreach ($value as $array) {
      foreach ($array as $key => $valeur) {
        echo "<option value=\"$valeur\">$valeur</option>";
      }
    }
    ?>
    </select>
    </div>

      <div class="row">
        <div class="col-sm-12" style="margin-top:20px; margin-bottom:10px;">
          <h4 style="border-bottom: 1px solid; border-top: 1px solid; padding-top:10px; font-size:20px;">Filtre des données </h4>
        </div>
      </div>

      <div class="row" style="margin-left:150px;">
  <!-- ****************** DEBUT LISTE DEROULANTE Grotte ********************* -->
        <div class="col-sm-3">
      	<!--<fieldset class="scheduler-border">-->
      		<legend class="scheduler-border"> Grotte </legend>
      		<div class="control-group">
      			<div class="controls bootstrap-timepicker">
      				<div id="menuGrotte" style="display:block;">

      				<?php
              echo"<select multiple name='grotte[]'>"; /* On cree une liste deroulante */
      				echo "<option selected = 'selected' value=''>Toutes</option>"; /*possibilité de selectionner toutes les grottes */
      			 	$requete='SELECT NomCavite from Grotte ORDER BY NomCavite';  /* On prepare une requete permettant de recupere l'ensemble des valeurs qui nous interessent   */
      			  	$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
      			  	foreach ($value as $array) { /* On parcours les resultats possible (ici 1 seul) */
      			    		foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
      			      			echo "<option>$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
      			   	 	}
      			  	}
      			  	echo "</select>";
      			  	?>

                </div>
              </div>
            </div>
        <!--</fieldset>-->
      </div> <!-- faire la div col-sm de grotte-->

    <!-- ****************** DEBUT LISTE DEROULANTE Site ********************* -->

      <div class="col-sm-3">
      <!--<fieldset class="scheduler-border">-->
	      <legend class="scheduler-border"> Site </legend>
	      <div class="control-group">
		      <div class="controls bootstrap-timepicker">
			      <div id="menuSite" style="display:block;">

    				<?php
    				echo "<select multiple name='site[]'>";
    				echo "<option selected = 'selected' value=''>Tous</option>";
    				$requete='SELECT numSite from Site ORDER BY numSite';  /*   */
    				$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
    				foreach ($value as $array) {
    					foreach ($array as $key => $valeur) {
    						echo "<option>$valeur</option>";
    					}
    				}
    				echo "</select>";
    			  	?>
          	</div>
          </div>
        </div>
        <!--</fieldset>-->
      </div>

	<!-- ****************** DEBUT LISTE DEROULANTE Piege ********************* -->
    <!--  <div class="row">-->
      <div class="col-sm-3">
      <!--  <fieldset class="scheduler-border">-->
	      <legend class="scheduler-border"> Piège </legend>
	        <div class="control-group">
		        <div class="controls bootstrap-timepicker">
	        	  <div id="menuPiege" style="display:block;">

      				<?php
      				echo"<select multiple name='piege[]'>";
      				echo "<option selected = 'selected' value=''>Tous</option>";
      			      $requete='SELECT codePiege from Piege ORDER BY codePiege';  /*   */
      			      $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
      			      foreach ($value as $array) {
      				foreach ($array as $key => $valeur) {
      				  echo "<option>$valeur</option>";
      				}
      			      }
      			      echo "</select>";
      			  	?>
              </div>
          	</div>
        	</div>
        <!--</fieldset>-->
      </div>

	<!-- ****************** DEBUT LISTE DEROULANTE Echantillon ********************* -->

      <div class="col-sm-3">
      <!--<fieldset class="scheduler-border">-->
	      <legend class="scheduler-border"> Echantillon </legend>
	        <div class="control-group">
		        <div class="controls bootstrap-timepicker">
	        	  <div id="menuEchantillon" style="display:block;">

      				<?php
      				echo"<select multiple name='echantillon[]'>";
      				echo "<option selected = 'selected' value=''>Tous</option>";
      			      $requete='SELECT DISTINCT numEchantillon from Echantillon ORDER BY numEchantillon';  /*   */
      			      $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
      			      foreach ($value as $array) {
      				foreach ($array as $key => $valeur) {
      				  echo "<option>$valeur</option>";
      				}
      			      }
      			      echo "</select>";
      			  	?>
              </div>
          	</div>
        	</div>
        <!--</fieldset>-->
        </div>
      </div> <!-- ferme la row -->

<div class="row" style="margin-left:150px; margin-top:60px;">
<?php
      $listeTaxonomie = array('classe'=>'Classe','ordre'=>'Ordre','famille'=>'Famille','sousFamille'=>'SousFamille','genre'=>'Genre','espece'=>'Espece');
      foreach ($listeTaxonomie as $nomBase => $nomPropre) {
        echo "  <div class='col-sm-2'>

            <legend class='scheduler-border'> $nomPropre </legend>
              <div class='control-group'>
                <div class='controls bootstrap-timepicker'>
                  <div id='menu$nomPropre' style='display:block;'>";

          echo"<select multiple name='".$nomBase."[]'>";
          echo "<option selected = 'selected' value=''>Tous</option>";
              $requete="SELECT DISTINCT $nomBase from Taxonomie WHERE $nomBase!='' ORDER BY $nomBase";  /*   */
              $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
              foreach ($value as $array) {
          foreach ($array as $key => $valeur) {
            echo "<option>$valeur</option>";
          }
              }
              echo "</select>";
              echo "    </div>
                      </div>
                  </div>
                </div>";
      }
      ?>
    </div> <!-- ferme la row -->

    <div class="row" style="margin-top:60px;">
      <div class="col-sm-2 col-sm-offset-4" id="extraireCSV">
        <input style='float:right;' type="submit" name="extraire"  value="Telecharger CSV" style="float:right;"/></br></br>
      </div>
      <div class="col-sm-2" style="display:none" id="extraireFasta">
        <input style='float:center;' type="submit" name="extraire"  value="Telecharger Fasta" style="float:right;"/></br></br>
      </div>
    </form>
    <script src='./javascript/partieExtraction.js'></script>

    <?php
    include 'HTML/pied.html';
    ?>
