<?php
include 'BDD/bdd.php';
$bdd=connexionbd();
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

<div id='selectionRechercher'>
  <form method="POST" id="formRecherche" action="">
    <label for="choixRecherche">Qu'est ce que vous recherchez ?</label>
    <select name="choixRecherche" id="choixRecherche">
      <option value="Grotte">Grotte</option>
      <option value="Site">Site</option>
      <option value="Piege">Piege</option>
      <option value="Echantillon">Echantillon</option>

    </select>
    <label for="recherche">Votre recherche : </label>
    <input type="text" name="recherche" />
    <input type="submit" value="Rechercher" id="submitRecherche" />
  </form>
</div>

<div id="listing">

</div>


<script src="./javascript/recherche.js"></script>

<?php
include 'HTML/pied.html';
?>
