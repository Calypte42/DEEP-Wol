<?php

include '../BDD/bdd.php';
$bdd = connexionbd();

$verif = false;

if ($_REQUEST['type'] == "site") {
    $id = "idgrotte";
    $num = "numsite";
    $table = "Site";
} else {
    $id = "idsite";
    $num = "codepiege";
    $table = "Piege";
}

$valeurs = array($_REQUEST["id"], $_REQUEST["num"], $_REQUEST['codeEquipe']);

$requete="SELECT $id, $num, codeEquipeSpeleo FROM $table";
$value=requete($bdd,$requete);

foreach ($value as $array) {
    $valeurs2 = array($array[$id], $array[$num], $array['codeequipespeleo']);

    if ($valeurs == $valeurs2) {
        $verif = true;
    }
}

echo $verif;
