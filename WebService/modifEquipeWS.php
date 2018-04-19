<?php
//Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('UPDATE EquipeSpeleo SET codeEquipe=:codeEquipe;');
$req->execute(array(
	'codeEquipe' => $_REQUEST['codeEquipe'],
));

echo http_response_code();

?>
