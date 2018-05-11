<?php

include '../BDD/bdd.php';
$bdd = connexionbd();

$nom = $_REQUEST['nom'];
$table = $_REQUEST['table'];
$valeur = $_REQUEST['valeur'];

$verif = false;

$requete="SELECT $nom from $table";
$value=requete($bdd,$requete);

foreach ($value as $array) {
    if ($valeur == $array[$nom]) {
        $verif = true;
    }
}

echo $verif;
