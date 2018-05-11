<?php
include '../BDD/bdd.php';
$bdd = connexionbd();


if(isset($_REQUEST['classe'])){
  if($_REQUEST['classe']!='Indetermine'){
  $classe=$_REQUEST['classe'];
}
else{
  $classe='';
}

if($_REQUEST['ordre']!='Indetermine'){
$ordre=$_REQUEST['ordre'];
}
else{
$ordre='';
}

if($_REQUEST['famille']!='Indetermine'){
$famille=$_REQUEST['famille'];
}
else{
$famille='';
}

if($_REQUEST['sousFamille']!='Indetermine'){
$sousFamille=$_REQUEST['sousFamille'];
}
else{
$sousFamille='';
}

if($_REQUEST['genre']!='Indetermine'){
$genre=$_REQUEST['genre'];
}
else{
$genre='';
}

if($_REQUEST['espece']!='Indetermine'){
$espece=$_REQUEST['espece'];
}
else{
$espece='';
}





  $data = Array("resultat" => Array());
  $requete='SELECT photo FROM Taxonomie WHERE classe=\''.$classe.'\' AND ordre=\''.$ordre.'\' AND famille=\''.$famille.'\' AND sousFamille=\''.$sousFamille.'\' AND genre=\''.$genre.'\' AND espece=\''.$espece.'\'';
    $query = $bdd->query($requete);
    while ($donnees = $query->fetch()) {
      $data['resultat'][] = Array('photo'=>$donnees['photo']);
    }
    header("Content-Type:application/json");
    echo json_encode($data);
  }

  ?>
