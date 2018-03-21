<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Piege (codePiege,datePose,heurePose,
  dateRecup,heureRecup,probleme,dateTri,codeEquipeSpeleo,idSite)
    SELECT :codePiege,:datePose,:heurePose,
      :dateRecup,:heureRecup,:probleme,:dateTri,codeEquipe,id FROM EquipeSpeleo, Site
      WHERE numSite = :numSite AND codeEquipe = :codeEquipeSpeleo;');
$req->execute(array(
	'codePiege' => $_REQUEST['codePiege'],
  'datePose' => $_REQUEST['datePose'],
  'heurePose' => $_REQUEST['heurePose'],
  'dateRecup' => $_REQUEST['dateRecup'],
  'heureRecup' => $_REQUEST['heureRecup'],
  'probleme' => $_REQUEST['probleme'],
  'dateTri' => $_REQUEST['dateTri'],
  'numSite' => $_REQUEST['numSite'],
  'codeEquipeSpeleo' => $_REQUEST['codeEquipeSpeleo']
/* Et on entre par exemple : http://localhost/~aurelien/TER/testBDD.php?nomEquipe=Equipe5 */

));

if ($_REQUEST['nom']=='Valider et ajouter une nouvelle grotte'){
  header('Refresh: 0; URL=ajoutIndividu.php');
}

if ($_REQUEST['nom']=='Valider et aller à la page suivante'){
  header('Refresh: 0; URL=ajoutPiege.php');
}

echo http_response_code();

?>
