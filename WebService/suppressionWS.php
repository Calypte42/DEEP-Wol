<?php

//fonctionnel !

include '../BDD/bdd.php';
$bdd = connexionbd();

$table = $_REQUEST['table'];
$colonne = $_REQUEST['colonne'];
$id = $_REQUEST['id'];

if (gettype($id)=='string') {
    $req = $bdd->prepare("DELETE FROM $table WHERE $colonne='$id'");
} else {
    $req = $bdd->prepare("DELETE FROM $table WHERE $colonne=$id");
}



$req->execute();

echo $req->errorInfo()[2];

?>
