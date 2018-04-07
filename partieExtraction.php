<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include 'verificationConnexion.php';
include 'HTML/entete.html';


?>
<h2> Voici la page d'extraction des données des échantillons</h2>
<p>
  Tout d'abord selectionner les élements que vous voulez voir apparaitre dans le tableau de résultat
  puis appliquer les filtres desire en selectionnant les grottes, sites et pieges qui vous interessent !
</p>
        <form id="formulaire" method="GET" action="telechargementCSV.php">
          <fieldset>
            <legend>Choix des colonnes </legend>
            <h3> A enlever : Sofian il faudrait si possible que quand on clique sur tout tout ce coche et une fonction verifie que au moins un element est coche avant de valider</h3>
            <?php
            $listeAttributGrotte = array('nomcavite','typecavite','latitude','longitude','typeacces','accespublic','nomSystemeHydrographique','departement');
            $listeAttributSite = array('profondeur','temperature','typesol','numsite','distanceentree','presenceeau');
            $listeAttributPiege = array('codepiege','datepose','heurepose','daterecup','heurerecup','probleme','datetri');
            $listeAttributEchantillon = array('numEchantillon','formeStockage','lieuStockage','niveauIdentification','infecteBacterie','nombreindividu','classe','ordre','famille','sousfamille','genre','espece','photo','nomAuteur','prenomAuteur');

            echo "<input type='button' id='boutonToutSelectionner' value='Tout selectionner'>";
            echo "<input type='button' id='boutonToutDeselectionner' value='Tout deselectionner'>";

            echo "<fieldset>";
            echo "<legend> Attributs des echantillons</legend>";
            foreach ($listeAttributEchantillon as $key => $value) {
              echo "<label for=$value>$value</label>";
              echo "<input type='checkbox' name='listeItem[]' id=$value value=$value>";
            }
            echo"</fieldset>";


            echo "<fieldset>";
            echo "<legend> Attributs des pieges</legend>";
            foreach ($listeAttributPiege as $key => $value) {
              echo "<label for=$value>$value</label>";
              echo "<input type='checkbox' name='listeItem[]' id=$value value=$value>";
            }
            echo"</fieldset>";

            echo "<fieldset>";
            echo "<legend> Attributs des sites</legend>";
            foreach ($listeAttributSite as $key => $value) {
              echo "<label for=$value>$value</label>";
              echo "<input type='checkbox' name='listeItem[]' id=$value value=$value>";
            }
            echo"</fieldset>";


            echo "<fieldset>";
            echo "<legend> Attributs des grottes</legend>";
            foreach ($listeAttributGrotte as $key => $value) {
              echo "<label for=$value>$value</label>";
              echo "<input type='checkbox' name='listeItem[]' id=$value value=$value>";
            }
            echo"</fieldset>";

            ?>


          </fieldset>
      </br>
        <p> Pour choisir plusieurs éléments dans une liste multiple, maintenez la touche CTRL enfoncée</p>
        </br>

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
        </fieldset>

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
        </fieldset>


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
        </fieldset>
<input type="submit" name="extraire" value="extraire" />
        </form>
