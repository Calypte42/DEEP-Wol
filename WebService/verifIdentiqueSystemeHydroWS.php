<?php

include '../BDD/bdd.php';
$bdd = connexionbd();

$verif = false;

$valeurs = array($_REQUEST["nom"], $_REQUEST["departement"], $_REQUEST['pays']);

$requete="SELECT nom, departement, pays FROM SystemeHydrographique";
$value=requete($bdd,$requete);

foreach ($value as $array) {
    $valeurs2 = array($array["nom"], $array["departement"], $array["pays"]);

    if ($valeurs == $valeurs2) {
        $verif = true;
    }
}

echo $verif;
