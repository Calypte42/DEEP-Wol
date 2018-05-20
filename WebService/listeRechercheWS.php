<?php

include '../BDD/bdd.php';
$bdd = connexionbd();

$type = $_REQUEST['type'];

if ($_REQUEST['grotte'] == 'tous') {
    $grotte = "";
} else {
    $grotte = $_REQUEST['grotte'];
}

if ($_REQUEST['site'] == 'tous') {
    $site = "";
} else {
    $site = $_REQUEST['site'];
}

if ($_REQUEST['piege'] == 'tous') {
    $piege = "";
} else {
    $piege = $_REQUEST['piege'];
}

//$listeNoms = ['grotte' => 'nomcavite', 'site' => 'numsite', 'piege' => 'codepiege'];
//$listeValeurs = ['grotte' => $grotte, 'site' => $site, 'piege' => $piege];

$resultat [];

if ($rang == 'grotte') {
    $requeteSite = "SELECT id, numSite FROM Site";
    $requetePiege = "SELECT codePiege FROM Piege";

    if ($grotte != "") {
        $requeteSite .= " WHERE idGrotte = $grotte ORDER BY numSite";
        $requetePiege .= " WHERE idSite IN (SELECT id FROM Site WHERE idGrotte = $grotte) ORDER BY codePiege";
    }

    $resultatSite = requete($bdd, $requeteSite);

    foreach ($resultatSite as $array) {
        $resultat['site'][$array['id']] = $array['numSite'];
    }

    $resultatPiege = requete($bdd, $requetePiege);

    foreach ($resultatPiege as $array) {
        $resultat['piege'] = $array['codePiege'];
    }

} elseif ($rang == 'site') {
    $requeteSite = "SELECT id, numSite FROM Site";
    $requetePiege = "SELECT codePiege FROM Piege";
}
