<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$idSite = $_REQUEST['idSite'];

/*$requete="SELECT nomCavite from Grotte WHERE id = $idGrotte";
$value=requete($bdd,$requete);
$nomGrotte = $value[0]['nomcavite'];*/

$requete="SELECT codePiege from Piege WHERE idSite = $idSite ORDER BY codePiege";
$value=requete($bdd,$requete);

if ($value) {
    echo "<select style='width:200px;' data-placeholder='Choisissez un piège...' class='chosen-select' id='codePiege' name='codePiege'>";
    echo "<option disabled selected value></option>";
    foreach ($value as $array) {
        $codePiege = $array['codepiege'];
        echo "<option value=\"$codePiege\">$codePiege</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='ajoutPiege' value='' />";

} else {
    echo "Pas de piège disponible ! ";
    //echo "<button onclick=\"window.location.href='./ajoutSite.php?idGrotte=$idGrotte&grotte=$nomGrotte'\">Ajouter un site</button>";
    echo "<input type='hidden' name='ajoutPiege' value='true' />";
}

?>
