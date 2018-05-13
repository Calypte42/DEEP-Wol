<?php

include '../BDD/bdd.php';
$bdd = connexionbd();

$verif = false;

$valeurs = array($_REQUEST['classeTaxo'], $_REQUEST['ordreTaxo'], $_REQUEST['familleTaxo'],
                        $_REQUEST['sousFamilleTaxo'], $_REQUEST['genreTaxo'], $_REQUEST['especeTaxo']);

$requete="SELECT classe, ordre, famille, sousFamille, genre, espece FROM Taxonomie";
$value=requete($bdd,$requete);

foreach ($value as $array) {
    $valeurs2 = array($array['classe'], $array['ordre'], $array['famille'], $array['sousfamille'],
                                $array['genre'], $array['espece']);

    if ($valeurs == $valeurs2) {
        $verif = true;
    }
}

echo $verif;
