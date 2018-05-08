<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

    <div class= "col-sm-10" style = "text-align:center;" >
      <div id='selectionRechercher'>
        <form  method="POST" id="formRecherche" action="">
          <label for="choixRecherche">Qu'est-ce que vous recherchez ?</label>
          <select name="choixRecherche" id="choixRecherche">
            <option value="Grotte">Grotte</option>
            <option value="Site">Site</option>
            <option value="Piege">Piege</option>
            <option value="Echantillon">Echantillon</option>
            <option value="Taxonomie">Taxonomie</option>
            <option value="Gene">Gène</option>
            <option value="SystemeHydrographique">Systeme Hydrographique</option>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <label for="recherche">Votre recherche : </label>
          <input type="text" name="recherche" />

          <div id="divFiltre" style="display:none">
            <h3>Filtre : </h3></br>
            <div id="divFiltreGrotte" style="display:none">
              <label for="filtreGrotte"> Grotte : </label>
              <select name="filtreGrotte" id="filtreGrotte">
                <option value="toutes" selected>Toutes</option>
                <?php
                $requete='SELECT id, nomCavite from Grotte ORDER BY NomCavite';
    						$value=requete($bdd,$requete);
    						foreach ($value as $array) {
                                $id = $array['id'];
                                $nomCavite = $array['nomcavite'];
    								echo "<option value=\"$id\">$nomCavite</option>";
                  }
                  ?>
              </select>
            </div> <!-- Fin divFiltreGrotte -->
            <div id="divFiltreSite" style="display:none">

              <label for="filtreSite"> Site : </label>
              <select name="filtreSite" id="filtreSite">
                <option value="tous" selected>Tous</option>
                <?php
              $requete="SELECT id, numsite from Site ORDER BY numsite";
							$value=requete($bdd,$requete);
							foreach ($value as $array) {
                                $id = $array['id'];
                                $numSite = $array['numsite'];
									echo "<option value=\"$id\">$numSite</option>";
                }
              ?>
            </select>
            </div><!-- Fin divFiltreSite -->
            <div id="divFiltrePiege" style="display:none">
              <label for="filtrePiege"> Piege : </label>
              <select name="filtrePiege" id="filtrePiege">
                <option value="tous" selected>Tous</option>
                <?php
                $requete='SELECT codepiege from piege ORDER BY codepiege';
                $value=requete($bdd,$requete);
                foreach ($value as $array) {
                  foreach ($array as $key => $valeur) {
                      echo "<option value=\"$valeur\">$valeur</option>";
                    }
                  }
                 ?>
               </select>
            </div> <!-- Fin divFiltrePiege -->
          </div> <!-- Fin divFiltre -->
          
          <input type="submit" value="Rechercher" id="submitRecherche" />
        </form>
      </div>
    </div>




      <div id="listing"></div>




<script src="./javascript/recherche.js"></script>

<?php
include 'HTML/pied.html';
?>
