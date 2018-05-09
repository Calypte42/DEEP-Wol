<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Site (profondeur,typeSol,numSite,distanceEntree,
    presenceEau, idGrotte, codeEquipeSpeleo)
        SELECT :profondeur,:typeSol,:numSite,:distanceEntree,
        :presenceEau, :idGrotte, codeEquipe FROM EquipeSpeleo
            WHERE codeEquipe = :codeEquipeSpeleo;');

// Gestion de profondeur vide
if (empty($_REQUEST['profondeur'])) {
    $profondeur=null;
} else {
    $profondeur=$_REQUEST['profondeur'];
}


// Gestion de typeSol vide
if ($_REQUEST['typeSol'] == 'autre') {
    $typeSol=$_REQUEST['autreSol'];
} else {
    $typeSol=$_REQUEST['typeSol'];
}

// Gestion de presenceEau non coche
if(isset($_REQUEST['presenceEau'])){
  if($_REQUEST['presenceEau']!="null"){
    $presenceEau=$_REQUEST['presenceEau'];
  }
  else{$presenceEau=null;}
}
else {
  $presenceEau=null;
}

$req->execute(array(
    'profondeur' => $profondeur,
    'typeSol' => $typeSol,
    'numSite' => $_REQUEST['numSite'],
    'distanceEntree' => $_REQUEST['distanceEntree'],
    'presenceEau' => $presenceEau,
    'idGrotte' => $_REQUEST['idGrotteForm'],
    'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']
));

$idSite=$bdd->lastInsertId(); //recuper l'id de l element inserer.

if ($_REQUEST['nom']=='Valider et ajouter un nouveau site') {
    if (isset($_REQUEST['idGrotte'])) {
        header("Refresh: 0; URL=../ajoutSite.php?idGrotte=".$_REQUEST['idGrotte']."&grotte=".$_REQUEST['grotte']);
    } else {
        header("Refresh: 0; URL=../ajoutSite.php");
    }
}

if ($_REQUEST['nom']=='Valider et ajouter un nouveau piège') {
    header("Refresh:0; URL=../ajoutPiege.php?idGrotte=".$_REQUEST['idGrotte']."&nomGrotte=".$_REQUEST['grotte']."&idSite=$idSite&site=".$_REQUEST['numSite']);
}

if ($_REQUEST['nom']=='Valider et revenir au tableau des sites') {
    header("Refresh: 0; URL=../tableauSite.php?idGrotte=".$_REQUEST['idGrotte']."&grotte=".$_REQUEST['grotte']);
}
