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
            <legend>Choix des colonnes </legend>
            <h3> A enlever : Sofian il faudrait si possible que quand on clique sur tout tout ce coche et une fonction verifie que au moins un element est coche avant de valider</h3>

            <?php
          $listeAttributGrotte = array('nomcavite'=>'Nom Cavite','typecavite'=>'Type de cavite','latitude'=>'Latitude','longitude'=>'Longitude','typeacces'=>'Type d\'acces','accespublic'=> 'Acces au public','nomSystemeHydrographique'=>'Nom du systeme hydrographique','departement'=>'Departement');
            $listeAttributSite = array('profondeur'=>'Profondeur','temperature'=>"Temperature",'typesol'=>'Type de sol','numsite'=>'Numero du site','distanceentree'=>'Distance a l\'entre','presenceeau'=>'Presence d\'eau');
            $listeAttributPiege = array('codepiege'=>'Code du piege','datepose'=>'Date de pose','heurepose'=>'Heure de pose','daterecup'=>'Date de recuperation','heurerecup'=>'Heure de récupération','probleme'=>'Probleme','datetri'=>'Date de tri');
            $listeAttributEchantillon = array('numEchantillon'=>'Numero de l\'echantillon','formeStockage'=>'Forme de stockage','lieuStockage'=>'Lieu de stockage','niveauIdentification'=>'Niveau d\'identification','infecteBacterie'=>'Infecte par bacterie','nombreindividu'=>'Nombre d\'individu','classe'=>'Classe','ordre'=>'Ordre','famille'=>'Famille','sousfamille'=>'Sous-famille','genre'=>'Genre','espece'=>'Espece','photo'=>'Photo','nomAuteur'=>'Nom de l\'auteur','prenomAuteur'=>'Prenom de l\'auteur');

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
      </br>
      </br>
      <div class="container">
      <p> Pour choisir plusieurs éléments dans une liste multiple, maintenez la touche CTRL enfoncée</p>
      </br>
        <div class="row">
            <div class="col-lg-6">
          	<fieldset class="scheduler-border">
          		<legend class="scheduler-border"> Grotte </legend>
          		<div class="control-group">
          			<div class="controls bootstrap-timepicker">
          				<div id="menuGrotte" style="display:block;">

				<?php
		/* ------------- DEBUT LISTE DEROULANTE GROTTE ------------------*/


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

        <div class="col-lg-6">
        <fieldset class="scheduler-border">
		      <legend class="scheduler-border"> Site </legend>
		      <div class="control-group">
			      <div class="controls bootstrap-timepicker">
				      <div id="menuSite" style="display:block;">

				<?php
		/* ------------- DEBUT LISTE DEROULANTE SITE ------------------*/

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
      <!--    <div>
          Choix des elements devant apparaitre dans le tableau de resultat : <br/>
          <label for="CBSiteTout">Tout</label>
          <input type='checkbox' name='checkboxSite' id="CBSiteTout" value="CBSiteTout" />
          <label for="CBProfondeur">Profondeur</label>
          <input type='checkbox' name='checkboxSite' id="CBProfondeur" value="CBProfondeur" />
          <label for="CBTemperature">Temperature</label>
          <input type='checkbox' name='checkboxSite' id="CBTemperature" value="CBTemperature" />
          <label for="CBTypeSol">Type de sol</label>
          <input type='checkbox' name='checkboxSite' id="CBTypeSol" value="CBTypeSol" />
          <label for="CBNumSite">Numéro du site</label>
          <input type='checkbox' name='checkboxSite' id="CBNumSite" value="CBNumSite" />
          <label for="CBDistanceEntree">Distance a l'entree</label>
          <input type='checkbox' name='checkboxSite' id="CBDistanceEntree" value="CBDistanceEntree" />
          <label for="CBPresenceEau">Presence d'eau</label>
          <input type='checkbox' name='checkboxSite' id="CBPresenceEau" value="CBPresenceEau" />
        </div>-->
          		</div>
            </div>
        	</div>
        </fieldset>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
        <fieldset class="scheduler-border">
		      <legend class="scheduler-border"> Piège </legend>
		        <div class="control-group">
			        <div class="controls bootstrap-timepicker">
		        	  <div id="menuPiege" style="display:block;">

				<?php
		/* ------------- DEBUT LISTE DEROULANTE PIEGE ------------------*/

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

        <div class="col-lg-6">
        <fieldset class="scheduler-border">
		      <legend class="scheduler-border"> Echantillon </legend>
		        <div class="control-group">
			        <div class="controls bootstrap-timepicker">
		        	  <div id="menuEchantillon" style="display:block;">

				<?php
		/* ------------- DEBUT LISTE DEROULANTE Echantillon ------------------*/

				echo"<select multiple name='echantillon[]'>";
				echo "<option selected = 'selected' value=''>Tous</option>";
			      $requete='SELECT numEchantillon from Echantillon ORDER BY numEchantillon';  /*   */
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

      <div class="col-lg-6">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border"> Classe </legend>
          <div class="control-group">
            <div class="controls bootstrap-timepicker">
              <div id="menuClasse" style="display:block;">

      <?php
  /* ------------- DEBUT LISTE DEROULANTE Classe ------------------*/

      echo"<select multiple name='classe[]'>";
      echo "<option selected = 'selected' value=''>Tous</option>";
          $requete='SELECT classe from Taxonomie ORDER BY classe';  /*   */
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

    <div class="col-lg-6">
    <fieldset class="scheduler-border">
      <legend class="scheduler-border"> Ordre </legend>
        <div class="control-group">
          <div class="controls bootstrap-timepicker">
            <div id="menuOrdre" style="display:block;">

    <?php
/* ------------- DEBUT LISTE DEROULANTE ORDRE ------------------*/

    echo"<select multiple name='ordre[]'>";
    echo "<option selected = 'selected' value=''>Tous</option>";
        $requete='SELECT ordre from Taxonomie ORDER BY ordre';  /*   */
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

  <div class="col-lg-6">
  <fieldset class="scheduler-border">
    <legend class="scheduler-border"> Famille </legend>
      <div class="control-group">
        <div class="controls bootstrap-timepicker">
          <div id="menuFamille" style="display:block;">

  <?php
/* ------------- DEBUT LISTE DEROULANTE FAMILLE ------------------*/

  echo"<select multiple name='famille[]'>";
  echo "<option selected = 'selected' value=''>Tous</option>";
      $requete='SELECT famille from Taxonomie ORDER BY famille';  /*   */
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

<div class="col-lg-6">
<fieldset class="scheduler-border">
  <legend class="scheduler-border">Sous famille </legend>
    <div class="control-group">
      <div class="controls bootstrap-timepicker">
        <div id="menusousfamille" style="display:block;">

<?php
/* ------------- DEBUT LISTE DEROULANTE SOUS FAMILLE ------------------*/

echo"<select multiple name='sousFamille[]'>";
echo "<option selected = 'selected' value=''>Tous</option>";
    $requete='SELECT sousfamille from Taxonomie ORDER BY sousfamille';  /*   */
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

<div class="col-lg-6">
<fieldset class="scheduler-border">
  <legend class="scheduler-border"> Genre </legend>
    <div class="control-group">
      <div class="controls bootstrap-timepicker">
        <div id="menuGenre" style="display:block;">

<?php
/* ------------- DEBUT LISTE DEROULANTE Genre ------------------*/

echo"<select multiple name='genre[]'>";
echo "<option selected = 'selected' value=''>Tous</option>";
    $requete='SELECT genre from Taxonomie ORDER BY genre';  /*   */
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

<div class="col-lg-6">
<fieldset class="scheduler-border">
  <legend class="scheduler-border"> Espece </legend>
    <div class="control-group">
      <div class="controls bootstrap-timepicker">
        <div id="menuEspece" style="display:block;">

<?php
/* ------------- DEBUT LISTE DEROULANTE ESPECE ------------------*/

echo"<select multiple name='espece[]'>";
echo "<option selected = 'selected' value=''>Tous</option>";
    $requete='SELECT espece from Taxonomie ORDER BY espece';  /*   */
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

      <input type="submit" name="extraire" value="Exporter" style="float:right;"/></br></br>
    </div>
    </form>
