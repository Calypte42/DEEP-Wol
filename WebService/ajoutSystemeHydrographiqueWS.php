<?php
include '../BDD/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO SystemeHydrographique (nom,departement,pays)
VALUES (:nom,:departement,:pays);');

if(isset($_REQUEST['pays'])){
    $pays=$_REQUEST['pays'];
} else {
    $pays=null;
}

$req->execute(array(
    'nom' => $_REQUEST['nom'],
    'departement' => $_REQUEST['departement'],
    'pays' => $_REQUEST['pays']
));

$last_id = $bdd->lastInsertId();

$bdd = null;

echo $last_id;

?>
