<?php
// Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Site (profondeur,temperature,typeSol,numSite,distanceEntree,
  presenceEau, idGrotte, codeEquipeSpeleo)
    SELECT :profondeur,:temperature,:typeSol,:numSite,:distanceEntree,
    :presenceEau, id, codeEquipe FROM EquipeSpeleo, Grotte
      WHERE nomCavite = :nomGrotte AND codeEquipe = :codeEquipeSpeleo;');

if(empty($_REQUEST['profondeur'])){
    $profondeur=null;
}
else {
  $profondeur=$_REQUEST['profondeur'];
}

if(empty($_REQUEST['temperature'])){
  $temperature=null;
}
else {
    $temperature=$_REQUEST['temperature'];
}

if(isset($_REQUEST['presenceEau'])){
  $presenceEau=$_REQUEST['presenceEau'];
}
else {
  $presenceEau=null;
}

echo "$profondeur,$temperature,$presenceEau";

$req->execute(array(
	'profondeur' => $profondeur,
  'temperature' => $temperature,
  'typeSol' => $_REQUEST['typeSol'],
  'numSite' => $_REQUEST['numSite'],
  'distanceEntree' => $_REQUEST['distanceEntree'],
  'presenceEau' => $presenceEau,
  'nomGrotte' => $_REQUEST['nomGrotte'],
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']

));


if ($_REQUEST['nom']=='Valider et ajouter un nouveau site'){
  header('Refresh: 0; URL=../ajoutSite.php');
}

if ($_REQUEST['nom']=='Valider et ajouter un nouveau piege'){
  header('Refresh: 0; URL=../ajoutPiege.php');
}

echo http_response_code();

?>
