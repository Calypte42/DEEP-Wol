<?php
//Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('UPDATE EquipeSpeleo SET codeEquipe=:codeEquipe WHERE codeEquipe=:id;');
$req->execute(array(
	'codeEquipe' => $_REQUEST['codeEquipe'],
    'id' => $_REQUEST['id']
));

header('Refresh: 0; URL=../recherche.php');

?>
