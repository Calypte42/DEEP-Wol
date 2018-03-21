<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Site (profondeur,temperature,typeSol,numSite,distanceEntree,
  presenceEau, idGrotte, codeEquipeSpeleo)
    SELECT :profondeur,:temperature,:typeSol,:numSite,:distanceEntree,
    :presenceEau, idGrotte, codeEquipeSpeleo FROM EquipeSpeleo, Grotte
      WHERE nomCavite = :nomGrotte AND codeEquipe = :codeEquipeSpeleo;');
$req->execute(array(
	'profondeur' => $_REQUEST['profondeur'],
  'temperature' => $_REQUEST['temperature'],
  'typeSol' => $_REQUEST['typeSol'],
  'numSite' => $_REQUEST['numSite'],
  'distanceEntree' => $_REQUEST['distanceEntree'],
  'presenceEau' => $_REQUEST['presenceEau'],
  'nomGrotte' => $_REQUEST['nomGrotte'],
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']
/* Et on entre par exemple : http://localhost/~aurelien/TER/testBDD.php?nomEquipe=Equipe5 */

));

if ($_REQUEST['nom']=='Valider et ajouter une nouvelle grotte'){
  header('Refresh: 0; URL=ajoutSite.php');
}

if ($_REQUEST['nom']=='Valider et aller à la page suivante'){
  header('Refresh: 0; URL=ajoutPiege.php');
}

echo http_response_code();

?>
