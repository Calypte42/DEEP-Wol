<?php
include '../BDD/bdd.php';
$bdd=connexionbd();

if($_REQUEST['choixRecherche']=="Grotte"){
  $data = Array("resultat" => Array());
  if ($_REQUEST['recherche']==''){
      $query = $bdd->query('SELECT g.id,nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,s.nom FROM Grotte g, SystemeHydrographique s WHERE idSystemeHydrographique=s.id ORDER BY nomCavite');
    }else{
        $requete = "SELECT g.id,nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,s.nom
         FROM Grotte g, SystemeHydrographique s
         WHERE (
          nomCavite LIKE '%". $_REQUEST['recherche'] ."%'
          OR typeCavite LIKE '%". $_REQUEST['recherche'] ."%'
          OR latitude LIKE '%". $_REQUEST['recherche'] ."%'
          OR longitude LIKE '%". $_REQUEST['recherche'] ."%'
          OR typeAcces LIKE '%". $_REQUEST['recherche'] ."%'
          OR nom LIKE '%". $_REQUEST['recherche'] ."%' )
          AND idSystemeHydrographique=s.id" ;
    }
    $query = $bdd->query($requete);
    while ($donnees = $query->fetch()) {
        $data['resultat'][] = Array('id'=>$donnees['id'], 'nomCavite'=>$donnees['nomcavite'],'typeCavite'=>$donnees['typecavite'],'latitude'=>$donnees['latitude'],'longitude'=>$donnees['longitude'],'typeAcces'=>$donnees['typeacces'],'accesPublic'=>$donnees['accespublic'],'nom'=>$donnees['nom']);
    }
    header("Content-Type:application/json");
    echo json_encode($data);
  }

?>
