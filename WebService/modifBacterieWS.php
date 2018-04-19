<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('UPDATE Bacterie SET clade=:clade;');
$req->execute(array(
	'clade' => $_REQUEST['clade'],
));

echo http_response_code();

?>
