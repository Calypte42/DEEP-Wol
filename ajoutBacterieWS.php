<?php
include 'BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO Bacterie VALUES (:clade);');
$req->execute(array(
	'clade' => $_REQUEST['clade'],
));

echo http_response_code();

?>
