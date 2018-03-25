<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include'HTML/entete.html';
?>
        <form id="formulaire" method="post" action="">
    	</br>
        <p> Pour choisir plusieurs éléments dans une liste multiple, maintenez la touche CTRL enfoncée</p> 
        </br>

	<fieldset class="scheduler-border">
		<legend class="scheduler-border"> Grotte </legend>
		<div class="control-group">
			<div class="controls bootstrap-timepicker">
				<input id="boutonGrotte" value="Choisir" onclick="afficherGrotte" type="button">
				<div id="menuGrotte" style="display:block;">
        	
				<?php
		/* ------------- DEBUT LISTE DEROULANTE GROTTE ------------------*/
		       
				echo"<select multiple name='grotte'>"; /* On cree une liste deroulante */
				echo "<option selected = 'selected' value='Toutes'>Toutes</option>"; /*possibilité de selectionner toutes les grottes */
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
        </fieldset>
        
       <fieldset class="scheduler-border">
		<legend class="scheduler-border"> Site </legend>
		<div class="control-group">
			<div class="controls bootstrap-timepicker">
				<input id="boutonSite" value="Choisir" onclick="afficherSite" type="button">
				<div id="menuSite" style="display:block;">
        	
				<?php
		/* ------------- DEBUT LISTE DEROULANTE SITE ------------------*/
		      
				echo "<select multiple name='site'>";
				echo "<option selected = 'selected' value='Tous'>Tous</option>";
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
        </fieldset>
        
        <fieldset class="scheduler-border">
		<legend class="scheduler-border"> Piège </legend>
		<div class="control-group">
			<div class="controls bootstrap-timepicker">
				<input id="boutonPiege" value="Choisir" onclick="afficherPiege" type="button">
		        	<div id="menuPiege" style="display:block;">
        	
				<?php
		/* ------------- DEBUT LISTE DEROULANTE PIEGE ------------------*/
		      
				echo"<select multiple name='Piege'>";
				echo "<option selected = 'selected' value='Tous'>Tous</option>";
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
		<legend class="scheduler-border"> Individu </legend>
		<div class="control-group">
			<div class="controls bootstrap-timepicker">
				<input id="boutonIndividu" value="Choisir" onclick="afficherIndividu" type="button">
		        	<div id="menuIndividu" style="display:block;">
        	
				<?php
		/* ------------- DEBUT LISTE DEROULANTE INDIVIDU ------------------*/
		      
				echo"<select multiple name='Individu'>";
				echo "<option selected = 'selected' value='Tous'>Tous</option>";
			      $requete='SELECT numIndividu from Individu ORDER BY numIndividu';  /*   */
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
        
        </form>

