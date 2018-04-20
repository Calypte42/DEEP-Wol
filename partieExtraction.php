<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include 'verificationConnexion.php';
include 'HTML/entete.html';


?>

<h2> Voici la page d'extraction des données des échantillons</h2></br>
<div class="container">
<p>
  Tout d'abord selectionner les élements que vous voulez voir apparaitre dans le tableau de résultat
  puis appliquer les filtres desire en selectionnant les grottes, sites et pieges qui vous interessent !
</p>
        <form id="formulaire" method="GET" action="telechargementCSV.php">
          <label for="choixExtraction">Quel type de donnees souhaitez vous extraire: </label>
          <select name="choixExtraction">
            <option value="CSV">Données : Format CSV </option>
            <option value="Fasta">Données Génétique : Format Fasta</option>
          </select>

          <div id="disparaitreSiFasta">

            <legend>Choix des colonnes </legend>
            <h3> A enlever : Sofian il faudrait si possible que quand on clique sur tout tout ce coche et une fonction verifie que au moins un element est coche avant de valider</h3>

            <?php
            $listeAttributGrotte = array('nomcavite'=>'Nom Cavite','typecavite'=>'Type de cavite','latitude'=>'Latitude','longitude'=>'Longitude','typeacces'=>'Type d\'acces','accespublic'=> 'Acces au public','nomSystemeHydrographique'=>'Nom du systeme hydrographique','departement'=>'Departement');
            $listeAttributSite = array('profondeur'=>'Profondeur','temperature'=>"Temperature",'typesol'=>'Type de sol','numsite'=>'Numero du site','distanceentree'=>'Distance a l\'entre','presenceeau'=>'Presence d\'eau');
            $listeAttributPiege = array('codepiege'=>'Code du piege','datepose'=>'Date de pose','heurepose'=>'Heure de pose','daterecup'=>'Date de recuperation','heurerecup'=>'Heure de récupération','probleme'=>'Probleme','datetri'=>'Date de tri');
            $listeAttributEchantillon = array('numEchantillon'=>'Numero de l\'echantillon','formeStockage'=>'Forme de stockage','lieuStockage'=>'Lieu de stockage','niveauIdentification'=>'Niveau d\'identification','infecteBacterie'=>'Infecte par bacterie','nombreindividu'=>'Nombre d\'individu','classe'=>'Classe','ordre'=>'Ordre','famille'=>'Famille','sousfamille'=>'Sous-famille','genre'=>'Genre','espece'=>'Espece','photo'=>'Photo','initialeAuteur'=>'Initial de l\'auteur');

            /*echo"<div class='container'>";*/
            echo "<input type='button' id='boutonToutSelectionner' value='Tout selectionner'> &nbsp;";
            echo "<input type='button' id='boutonToutDeselectionner' value='Tout deselectionner'>";

            echo"<div class='row'>";

                echo"<div class='col-lg-6'>";
                echo "<fieldset style='border:none;'>";
                echo "<legend> Attributs des echantillons</legend>";
                echo "<input type='button' value='Tout deselectionner' id='deselectionEchantillon'/>";
                echo "<input type='button' value='Tout selectionner' id='selectionEchantillon'/>";
                foreach ($listeAttributEchantillon as $key => $value) {
                  echo "<label for=$key>$value</label>";
                  echo "<input type='checkbox' name='listeItem[]' id=$key value=$key>";
                }
                echo"</fieldset>";
                  echo"</div>";

                echo"<div class='col-lg-6'>";
                echo "<fieldset style='border:none;'>";
                echo "<legend> Attributs des pieges</legend>";
                echo "<input type='button' value='Tout deselectionner' id='deselectionPiege'/>";
                echo "<input type='button' value='Tout selectionner' id='selectionPiege'/>";
                foreach ($listeAttributPiege as $key => $value) {
                  echo "<label for=$key>$value</label>";
                  echo "<input type='checkbox' name='listeItem[]' id=$key value=$key>";
                }
                echo"</fieldset>";
                echo"</div>";
              echo"</div>";

            echo"<div class='row'>";

              echo"<div class='col-lg-6'>";
              echo "<fieldset style='border:none;'>";
              echo "<legend> Attributs des sites</legend>";
              echo "<input type='button' value='Tout deselectionner' id='deselectionSite'/>";
              echo "<input type='button' value='Tout selectionner' id='selectionSite'/>";
              foreach ($listeAttributSite as $key => $value) {
                echo "<label for=$key>$value</label>";
                echo "<input type='checkbox' name='listeItem[]' id=$key value=$key>";
              }
              echo"</fieldset>";
              echo"</div>";

              echo"<div class='col-lg-6'>";
                echo "<fieldset style='border:none;'>";
                echo "<legend> Attributs des grottes</legend>";
                echo "<input type='button' value='Tout deselectionner' id='deselectionGrotte'/>";
                echo "<input type='button' value='Tout selectionner' id='selectionGrotte'/>";
                foreach ($listeAttributGrotte as $key => $value) {
                  echo "<label for=$key>$value</label>";
                  echo "<input type='checkbox' name='listeItem[]' id=$key value=$key>";
                }
                echo"</fieldset>";
                echo"</div>";
              echo"</div>";
          echo"</div>";
            ?>
</div>

          </fieldset>
        </div> <!-- De la division disparaitreSiFasta -->
      </br>
      </br>
      <div class="container">
      <p> Pour choisir plusieurs éléments dans une liste multiple, maintenez la touche CTRL enfoncée</p>
      </br>
        <div class="row">

    <!-- ****************** DEBUT LISTE DEROULANTE Grotte ********************* -->
            <div class="col-lg-6">
          	<fieldset class="scheduler-border">
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
    <!--      <div>
          Choix des elements devant apparaitre dans le tableau de resultat : <br/>
          <label for="CBGrotteTout">Tout</label>
          <input type='checkbox' name='checkboxGrotte' id="CBGrotteTout" value="CBGrotteTout" />
          <label for="CBNomCavite">Nom Cavite</label>
          <input type='checkbox' name='checkboxGrotte' id="CBNomCavite" value="CBNomCavite" />
          <label for="CBTypeCavite">Type Cavite</label>
          <input type='checkbox' name='checkboxGrotte' id="CBTypeCavite" value="CBTypeCavite" />
          <label for="CBLatitude">Latitude</label>
          <input type='checkbox' name='checkboxGrotte' id="CBLatitude" value="CBLatitude" />
          <label for="CBLongitude">Longitude</label>
          <input type='checkbox' name='checkboxGrotte' id="CBLongitude" value="CBLongitude" />
          <label for="CBTypeAcces">Type Acces</label>
          <input type='checkbox' name='checkboxGrotte' id="CBTypeAcces" value="CBTypeAcces" />
          <label for="CBAccesPublic">Acces Public</label>
          <input type='checkbox' name='checkboxGrotte' id="CBAccesPublic" value="CBAccesPublic" />
        </div>-->
                </div>
              </div>
            </div>
        </fieldset>
        </div>

    <!-- ****************** DEBUT LISTE DEROULANTE Site ********************* -->

        <div class="col-lg-6">
        <fieldset class="scheduler-border">
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
        </fieldset>
        </div>
      </div>

	<!-- ****************** DEBUT LISTE DEROULANTE Piege ********************* -->
      <div class="row">
        <div class="col-lg-6">
        <fieldset class="scheduler-border">
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
        </fieldset>
        </div>

	<!-- ****************** DEBUT LISTE DEROULANTE Echantillon ********************* -->

        <div class="col-lg-6">
        <fieldset class="scheduler-border">
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
        </fieldset>
        </div>
      </div>
<?php
      $listeTaxonomie = array('classe'=>'Classe','ordre'=>'Ordre','famille'=>'Famille','sousFamille'=>'SousFamille','genre'=>'Genre','espece'=>'Espece');
      foreach ($listeTaxonomie as $nomBase => $nomPropre) {
        echo "  <div class='col-lg-6'>
          <fieldset class='scheduler-border'>
            <legend class='scheduler-border'> $nomPropre </legend>
              <div class='control-group'>
                <div class='controls bootstrap-timepicker'>
                  <div id='menu$nomPropre' style='display:block;'>";

          echo"<select multiple name='".$nomBase."[]'>";
          echo "<option selected = 'selected' value=''>Tous</option>";
              $requete="SELECT DISTINCT $nomBase from Taxonomie ORDER BY $nomBase";  /*   */
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
                </fieldset>
                </div>
              </div>";

      }
      ?>

      <input type="submit" name="extraire" value="Telecharger CSV" style="float:right;"/></br></br>
      <input type="submit" name="extraire" value="Telecharger Fasta" style="float:right;"/></br></br>
    </div>
    </form>
