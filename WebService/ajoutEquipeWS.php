<?php
//Fonctionnel !
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO EquipeSpeleo VALUES (:codeEquipe);');
$req->execute(array(
	'codeEquipe' => $_REQUEST['codeEquipe'],
));

echo http_response_code();

?>
