<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$idSite = $_REQUEST['idSite'];



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
    echo "<input type='hidden' name='ajoutPiege' value='true' />";
}

?>
