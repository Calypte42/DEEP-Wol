<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$id = $_POST['id'];

$req = $bdd->prepare("UPDATE Site SET profondeur=:profondeur, temperature=:temperature,
    typeSol=:typeSol, numSite=:numSite, distanceEntree=:distanceEntree,
    presenceEau=:presenceEau, codeEquipeSpeleo=:codeEquipeSpeleo WHERE id=$id");

// Gestion de profondeur vide
if(empty($_REQUEST['profondeur'])){
    $profondeur=null;
}
else {
  $profondeur=$_REQUEST['profondeur'];
}

// Gestion de temperature vide
if(empty($_REQUEST['temperature'])){
  $temperature=null;
}
else {
    $temperature=$_REQUEST['temperature'];
}

// Gestion de typeSol vide
if(empty($_REQUEST['typeSol'])){
  $typeSol=null;
}
else {
  $typeSol=$_REQUEST['typeSol'];
}

// Gestion de presenceEau non coche
if(isset($_REQUEST['presenceEau'])){
  $presenceEau=$_REQUEST['presenceEau'];
}
else {
  $presenceEau=null;
}


$req->execute(array(
  'profondeur' => $profondeur,
  'temperature' => $temperature,
  'typeSol' => $typeSol,
  'numSite' => $_REQUEST['numSite'],
  'distanceEntree' => $_REQUEST['distanceEntree'],
  'presenceEau' => $presenceEau,
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']

));

header("Refresh: 0; URL=../tableauSite.php?idGrotte=".$_REQUEST['idGrotte']."&grotte=".$_REQUEST['grotte']);


echo http_response_code();

?>
