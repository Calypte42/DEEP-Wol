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

$listeTaxo = array("classe", "ordre", "famille", "sousFamille", "genre", "espece");

$liste = [];

foreach ($listeTaxo as $x => $rangTaxo) {
    $where = "WHERE ";

    foreach ($selected as $key => $value) {
        if (($rangTaxo != $key) and $value != "Indetermine") {
            $where .= $key . " = '". $value . "' AND ";
        }
    }
    if ($where != "WHERE ") {
        $where = substr($where, 0, -5);
    } else {
        $where .= $rangTaxo . " = '" . $value . "'";
    }

    $requete = "SELECT DISTINCT $rangTaxo FROM Taxonomie $where";
    //echo "SELECT DISTINCT $rangTaxo FROM Taxonomie $where\n";
    $resultat = requete($bdd, $requete);

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
}

$nombreValeurs = 0;
foreach ($liste as $array) {
    foreach ($array as $key => $value) {
        if ($value != "" and $key != $rang) {
            $nombreValeurs += 1;
        }
    }
}

if ($nombreValeurs == 5) {
    $liste[$rang] = array($selected[$rang]);
}

header("Content-Type:application/json");
echo json_encode($liste);

?>
