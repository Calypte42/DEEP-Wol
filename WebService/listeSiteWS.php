<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$idGrotte = $_REQUEST['idGrotte'];

$requete="SELECT nomCavite from Grotte WHERE id = $idGrotte";
$value=requete($bdd,$requete);
$nomGrotte = $value[0]['nomcavite'];

$requete="SELECT id, numSite from Site WHERE idGrotte = $idGrotte ORDER BY numSite";
$value=requete($bdd,$requete);

if ($value) {
    echo "<select name='idSiteForm'>";
    foreach ($value as $array) {
        $id = $array['id'];
        $numSite = $array['numsite'];
        echo "<option value=\"$id\">$numSite</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='ajoutSite' value='' />";

} else {
    echo "Pas de site disponible ! ";
    echo "<button onclick=\"window.location.href='./ajoutSite.php?idGrotte=$idGrotte&grotte=$nomGrotte'\">Ajouter un site</button>";
    echo "<input type='hidden' name='ajoutSite' value='true' />";
}

?>
