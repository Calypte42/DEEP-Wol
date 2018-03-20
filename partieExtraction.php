<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<!DOCTYPE html>

<html>
    <head>
        <title>The Site</title>
        <meta charset="utf-8"/>
    </head>

    <body>
      <form>
        <label for="selection">Selection : </label>
        <select name="selection">
          <option> Grotte </option>
          <option> Site </option>
          <option> Piege </option>
          <option selected> Individu </option>
          <option> Gène </option>
          <option> Taxonomie </option>
        </select>
        <br/>


        <?php
/* ------------- DEBUT LISTE DEROULANTE GROTTE ------------------*/
        echo "<label for='grotte'>Grotte : </label>";
        echo"<select name='grotte'>"; /* On cree une liste deroulante */


          $requete='SELECT NomCavite from Grotte ORDER BY NomCavite';  /* On prepare une requete permettant de recupere l'ensemble des valeurs qui nous interessent   */
          $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
          foreach ($value as $array) { /* On parcours les resultats possible (ici 1 seul) */
            foreach ($array as $key => $valeur) { /*Et on recupere les valeurs */
              echo "<option>$valeur</option>"; /* Que l'on ajoute dans la liste deroulante */
            }
          }
          echo "</select>";

/* ------------- FIN LISTE DEROULANTE GROTTE ------------------*/

          echo "<label for='site'>Site : </label>";
          echo "<select name='site'>";

            $requete='SELECT numSite from Site ORDER BY numSite';  /*   */
            $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
            foreach ($value as $array) {
              foreach ($array as $key => $valeur) {
                echo "<option>$valeur</option>";
              }
            }
            echo "</select>";

            echo "<label for='Piege'>Piege : </label>";
            echo"<select name='Piege'>";

              $requete='SELECT codePiege from Piege ORDER BY codePiege';  /*   */
              $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
              foreach ($value as $array) {
                foreach ($array as $key => $valeur) {
                  echo "<option>$valeur</option>";
                }
              }
              echo "</select>";

              echo "<label for='Individu'>Individu : </label>";
              echo"<select name='Individu'>";

                $requete='SELECT numIndividu from Individu ORDER BY numIndividu';  /*   */
                $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
                foreach ($value as $array) {
                  foreach ($array as $key => $valeur) {
                    echo "<option>$valeur</option>";
                  }
                }
                echo "</select>";

                echo "<label for='Gene'>Gene : </label>";
                echo"<select name='Gene'>";

                  $requete='SELECT nom from Gene ORDER BY nom';  /*   */
                  $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
                  foreach ($value as $array) {
                    foreach ($array as $key => $valeur) {
                      echo "<option>$valeur</option>";
                    }
                  }
                  ?>


        </select>
    </body>
</html>
