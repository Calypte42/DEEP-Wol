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

if (isset($_REQUEST['espece'])) {
    $espece = $_REQUEST['espece'];
} else {
    $espece = "";
}

$selected = [];


if ($_REQUEST['classeSelected'] == 1) {
    $selected['classe'] = $classe;
}
if ($_REQUEST['ordreSelected'] == 1) {
    $selected['ordre'] = $ordre;
}
if ($_REQUEST['familleSelected'] == 1) {
    $selected['famille'] = $famille;
}
if ($_REQUEST['sousFamilleSelected'] == 1) {
    $selected['sousFamille'] = $sousFamille;
}
if ($_REQUEST['genreSelected'] == 1) {
    $selected['genre'] = $genre;
}
if ($_REQUEST['especeSelected'] == 1) {
    $selected['espece'] = $espece;
}

$where = "WHERE ";
foreach ($selected as $key => $value) {
    $where .= $key . " = '". $value . "' AND ";
}
$where = substr($where, 0, -5);

$requete = "SELECT DISTINCT classe, ordre, famille, sousFamille, genre, espece FROM Taxonomie $where";

$resultat = requete($bdd, $requete);

$liste = [];

foreach ($resultat as $array) {
    foreach ($array as $key => $value) {
        if (isset($liste[$key])) {
            if (!in_array($value, $liste[$key])) {
                $liste[$key][] = $value;
            }
        } else {
            $liste[$key][] = $value;
        }
    }
}

header("Content-Type:application/json");
echo json_encode($liste);

?>
