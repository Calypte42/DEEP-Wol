<?php

include '../BDD/bdd.php';
$bdd = connexionbd();

$type = $_REQUEST['type'];

if ($_REQUEST['grotte'] == 'toutes') {
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

$resultat = [];
$resultat['grotte'] = Array();
$resultat['site'] = Array();
$resultat['piege'] = Array();

if ($type == 'grotte') {
    $requeteSite = "SELECT id, numSite FROM Site";
    $requetePiege = "SELECT codePiege FROM Piege";

    if ($grotte != "") {
        $requeteSite .= " WHERE idGrotte = $grotte";
        $requetePiege .= " WHERE idSite IN (SELECT id FROM Site WHERE idGrotte = $grotte)";
    }

    $requeteSite .=  " ORDER BY numSite";
    $requetePiege .=  " ORDER BY codePiege";

    $resultatSite = requete($bdd, $requeteSite);

    foreach ($resultatSite as $array) {
        $resultat['site'][$array['id']] = $array['numsite'];
    }

    $resultatPiege = requete($bdd, $requetePiege);

    foreach ($resultatPiege as $array) {
        $resultat['piege'][] = $array['codepiege'];
    }

} elseif ($type == 'site') {
    $requeteGrotte = "SELECT id, nomCavite FROM Grotte";
    $requetePiege = "SELECT codePiege FROM Piege";
    $requeteSite = "SELECT id, numSite FROM Site";

    if ($site != "") {
        $requeteGrotte .= " WHERE id = (SELECT idGrotte FROM Site WHERE id = $site)";
        $requetePiege .= " WHERE idSite = $site";

        $requeteSite .= " WHERE idGrotte = (SELECT idGrotte FROM Site WHERE id=$site)";
    } else {
        if ($grotte != "") {
            $requeteSite .= " WHERE idGrotte = $grotte";
            $requetePiege .= " WHERE idSite IN (SELECT id FROM Site WHERE idGrotte = $grotte)";
        }
    }

    $requeteSite .=  " ORDER BY numSite";
    $requetePiege .=  " ORDER BY codePiege";

    $resultatGrotte = requete($bdd, $requeteGrotte);

    foreach ($resultatGrotte as $array) {
        $resultat['grotte'][$array['id']] = $array['nomcavite'];
    }

    $resultatSite = requete($bdd, $requeteSite);

    foreach ($resultatSite as $array) {
        $resultat['site'][$array['id']] = $array['numsite'];
    }

    $resultatPiege = requete($bdd, $requetePiege);

    foreach ($resultatPiege as $array) {
        $resultat['piege'][] = $array['codepiege'];
    }


} elseif ($type == 'piege') {
    $requeteGrotte = "SELECT g.id, g.nomCavite FROM Grotte g, Site s";
    $requeteSite = "SELECT id, numSite FROM Site";
    $requetePiege = "SELECT codePiege FROM Piege";

    if ($piege != "") {
        $requeteGrotte .= " WHERE g.id = s.idGrotte AND s.id = (SELECT idSite FROM Piege WHERE codePiege = '$piege')";
        $requeteSite .= " WHERE idGrotte = (SELECT s.idGrotte from Site s, Piege p WHERE s.id = p.idSite AND p.codePiege = '$piege')";
        $requetePiege .= " WHERE idSite = (SELECT idSite FROM Piege WHERE codePiege = '$piege')";

        $requeteSiteSelected = "SELECT id, numSite FROM Site WHERE id = (SELECT idSite FROM Piege WHERE codePiege = '$piege')";
        $resultatSiteSelected = requete($bdd, $requeteSiteSelected);
        $resultat['siteSelected'] = $resultatSiteSelected[0]['id'];
    } else {
        if ($site != "") {
            $requeteSite .= " WHERE idGrotte = $grotte";
            $requetePiege .= " WHERE idSite = $site";
        }
    }

    $requeteSite .=  " ORDER BY numSite";
    $requetePiege .=  " ORDER BY codePiege";

    $resultatGrotte = requete($bdd, $requeteGrotte);

    foreach ($resultatGrotte as $array) {
        $resultat['grotte'][$array['id']] = $array['nomcavite'];
    }

    $resultatSite = requete($bdd, $requeteSite);

    foreach ($resultatSite as $array) {
        $resultat['site'][$array['id']] = $array['numsite'];
    }


    $resultatPiege = requete($bdd, $requetePiege);

    foreach ($resultatPiege as $array) {
        $resultat['piege'][] = $array['codepiege'];
    }

}

header("Content-Type:application/json");
echo json_encode($resultat);
