<?php
include '../BDD/bdd.php';
$bdd = connexionbd();
$rang = $_REQUEST['rang'];
if (isset($_REQUEST['classe'])) {
    $classe = $_REQUEST['classe'];
} else {
    $classe = "";
}
if (isset($_REQUEST['ordre'])) {
    $ordre = $_REQUEST['ordre'];
} else {
    $ordre = "";
}
if (isset($_REQUEST['famille'])) {
    $famille = $_REQUEST['famille'];
} else {
    $famille = "";
}
if (isset($_REQUEST['sousFamille'])) {
    $sousFamille = $_REQUEST['sousFamille'];
} else {
    $sousFamille = "";
}
if (isset($_REQUEST['genre'])) {
    $genre = $_REQUEST['genre'];
} else {
    $genre = "";
}
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
$liste = [];
foreach ($resultat as $array) {
    if (!empty($array[$rangMinuscule])) {
        $liste[] = $array[$rangMinuscule];
    }
}
header("Content-Type:application/json");
echo json_encode($liste);
?>
