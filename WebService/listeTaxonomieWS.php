<?php

include '../BDD/bdd.php';
$bdd = connexionbd();

$rang = $_REQUEST['rang'];

$classe = $_REQUEST['classe'];
$ordre = $_REQUEST['ordre'];
$famille = $_REQUEST['famille'];
$sousFamille = $_REQUEST['sousFamille'];
$genre = $_REQUEST['genre'];

$where = "classe = '$classe'";

if ($rang == "ordre") {
    $requete = "SELECT DISTINCT $rang FROM Taxonomie WHERE $where";
}

$where .= " AND ordre = '$ordre'";

if ($rang == "famille") {
    $requete = "SELECT DISTINCT $rang FROM Taxonomie WHERE $where";
}

$where .= " AND famille = '$famille'";

if ($rang == "sousFamille") {
    $requete = "SELECT DISTINCT $rang FROM Taxonomie WHERE $where";
}

$where .= " AND sousFamille = '$sousFamille'";

if ($rang == "genre") {
    $requete = "SELECT DISTINCT $rang FROM Taxonomie WHERE $where";
}


$where .= " AND genre = '$genre'";

if ($rang == "espece") {
    $requete = "SELECT DISTINCT $rang FROM Taxonomie WHERE $where";
}

$resultat = requete($bdd, $requete);

$rangMinuscule = strtolower($rang);

foreach ($resultat as $array) {
    if (!empty($array[$rangMinuscule])) {
        $liste[] = $array[$rangMinuscule];
    }
}

header("Content-Type:application/json");
echo json_encode($liste);

?>
