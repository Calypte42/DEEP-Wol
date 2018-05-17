<?php
include '../BDD/bdd.php';
$bdd=connexionbd();

// -------------------- Gestion des filtres :

  if($_REQUEST['filtreGrotte']!="toutes"){
    $filtreGrotte="AND idGrotte =".$_REQUEST['filtreGrotte'];
  }
  else {
    $filtreGrotte="";
  }


  if($_REQUEST['filtreSite']!="tous"){
    $filtreSite=" AND idSite =".$_REQUEST['filtreSite'];
  }
  else {
    $filtreSite="";
  }


  if($_REQUEST['filtrePiege']!="tous"){
    $filtrePiege=" AND e.codePiege ='".$_REQUEST['filtrePiege']."'";
  }
  else {
    $filtrePiege="";
  }




//------------------------------------------------------------------------------------------------


if($_REQUEST['choixRecherche']=="Grotte"){
  $data = Array("resultat" => Array());
  if (empty($_REQUEST['recherche'])){
    $requete='SELECT g.id,nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,s.nom FROM Grotte g, SystemeHydrographique s WHERE idSystemeHydrographique=s.id ORDER BY nomCavite';
  }else{
    $requete = "SELECT g.id,nomCavite,typeCavite,latitude,longitude,typeAcces,accesPublic,s.nom
    FROM Grotte g, SystemeHydrographique s
    WHERE (
      LOWER (nomCavite) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
      OR LOWER(typeCavite) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
      OR LOWER (latitude) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
      OR LoWER (longitude) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
      OR LOWER (typeAcces) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
      OR LOWER (nom) LIKE '%". strtolower($_REQUEST['recherche']) ."%' )
      AND idSystemeHydrographique=s.id" ;
    }
    $query = $bdd->query($requete);
    while ($donnees = $query->fetch()) {
      $data['resultat'][] = Array('id'=>$donnees['id'], 'nomCavite'=>$donnees['nomcavite'],'typeCavite'=>$donnees['typecavite'],'latitude'=>$donnees['latitude'],'longitude'=>$donnees['longitude'],'typeAcces'=>$donnees['typeacces'],'accesPublic'=>$donnees['accespublic'],'nom'=>$donnees['nom']);
    }
    header("Content-Type:application/json");
    echo json_encode($data);
  }


  //------------------------------------------------------------------------------------------------

  if($_REQUEST['choixRecherche']=="Site"){

    $data = Array("resultat" => Array());
    if (empty($_REQUEST['recherche'])){
      $requete='SELECT s.id,numSite,profondeur,typeSol,distanceEntree,presenceEau,idGrotte,g.nomCavite,codeEquipeSpeleo FROM Grotte g,site s WHERE g.id=s.idGrotte '.$filtreGrotte.' ORDER BY numSite';
    }else{
      $requete = "SELECT s.id,numSite,profondeur,typeSol,distanceEntree,presenceEau,idGrotte,g.nomCavite,codeEquipeSpeleo
      FROM Grotte g,site s
      WHERE (
        LOWER (numSite) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
        /*OR LOWER(profondeur) LIKE '%". strtolower($_REQUEST['recherche']) ."%'*/
        OR LOWER (typeSol) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
        /*OR LoWER (distanceEntree) LIKE '%". strtolower($_REQUEST['recherche']) ."%'*/
        OR LOWER (typeAcces) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
        OR LOWER (g.nomCavite) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
        OR LOWER (codeEquipeSpeleo) LIKE '%". strtolower($_REQUEST['recherche']) ."%')
        AND g.id=s.idGrotte ".$filtreGrotte ;
      }
      $query = $bdd->query($requete);
      while ($donnees = $query->fetch()) {
        $data['resultat'][] = Array('id'=>$donnees['id'], 'numSite'=>$donnees['numsite'],'profondeur'=>$donnees['profondeur'],'typeSol'=>$donnees['typesol'],'distanceEntree'=>$donnees['distanceentree'],'idGrotte'=>$donnees['idgrotte'],'nomCavite'=>$donnees['nomcavite'],'codeEquipeSpeleo'=>$donnees['codeequipespeleo']);
      }
      header("Content-Type:application/json");
      echo json_encode($data);
    }

    //------------------------------------------------------------------------------------------------



    if($_REQUEST['choixRecherche']=="Piege"){
      $data = Array("resultat" => Array());
      if (empty($_REQUEST['recherche'])){
        $requete='SELECT codePiege,datePose,heurePose,dateRecup,heureRecup,probleme,dateTri,temperature,p.codeEquipeSpeleo,idSite, s.numSite,nomCavite,g.id as idGrotte FROM Grotte g, Site s, Piege p WHERE s.idGrotte=g.id AND p.idSite=s.id '.$filtreGrotte.$filtreSite.' ORDER BY codePiege';
      }else{
        $requete = "SELECT codePiege,datePose,heurePose,dateRecup,heureRecup,probleme,dateTri,temperature,p.codeEquipeSpeleo,idSite, s.numSite,nomCavite,g.id as idGrotte
        FROM Grotte g, Site s, Piege p
        WHERE (
          LOWER (codePiege) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
          OR LOWER(g.nomCavite) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
          OR LOWER (s.numSite) LIKE '%". strtolower($_REQUEST['recherche']) ."%')
          AND s.idGrotte=g.id AND p.idSite=s.id ".$filtreGrotte.$filtreSite ;
        }
        $query = $bdd->query($requete);
        while ($donnees = $query->fetch()) {
          $data['resultat'][] = Array('codePiege'=>$donnees['codepiege'], 'datePose'=>$donnees['datepose'],'heurepose'=>$donnees['heurepose'],'dateRecup'=>$donnees['daterecup'],'heureRecup'=>$donnees['heurerecup'],'probleme'=>$donnees['probleme'],'dateTri'=>$donnees['datetri'],'codeEquipeSpeleo'=>$donnees['codeequipespeleo'],'idSite'=>$donnees['idsite'],'numSite'=>$donnees['numsite'],'nomCavite'=>$donnees['nomcavite'],'idGrotte'=>$donnees['idgrotte']);
        }
        header("Content-Type:application/json");
        echo json_encode($data);
      }

      //------------------------------------------------------------------------------------------------



      if($_REQUEST['choixRecherche']=="Echantillon"){
        $data = Array("resultat" => Array());
        if (empty($_REQUEST['recherche'])){
          $requete='SELECT e.id,numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie,e.codePiege,initiale,idTaxonomie,nombreIndividu,s.id as idSite, s.numSite,nomCavite,g.id as idGrotte FROM Grotte g, Site s, Piege p, Echantillon e, Personne pe WHERE e.idAuteur=pe.id AND s.idGrotte=g.id AND p.idSite=s.id AND e.codePiege=p.codePiege '.$filtreGrotte.$filtreSite.$filtrePiege.' ORDER BY numEchantillon';
        }else{
          $requete = "SELECT e.id,numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie,e.codePiege,initiale,idTaxonomie,nombreIndividu,s.id as idSite, s.numSite,nomCavite,g.id as idGrotte
          FROM Grotte g, Site s, Piege p, Echantillon e, Personne pe
          WHERE (
            LOWER (numEchantillon) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
            OR LOWER(formeStockage) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
            OR LOWER (lieuStockage) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
            OR LoWER (niveauIdentification) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
            OR LOWER (e.codePiege) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
            OR LOWER (initiale) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
            OR LOWER (numSite) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
            OR LOWER (nomCavite) LIKE '%". strtolower($_REQUEST['recherche']) ."%' )
            AND e.idAuteur=pe.id AND s.idGrotte=g.id AND p.idSite=s.id AND e.codePiege=p.codePiege ".$filtreGrotte.$filtreSite.$filtrePiege ;
          }
          $query = $bdd->query($requete);
          while ($donnees = $query->fetch()) {
            $data['resultat'][] = Array('id'=>$donnees['id'], 'numEchantillon'=>$donnees['numechantillon'],'formeStockage'=>$donnees['formestockage'],'lieuStockage'=>$donnees['lieustockage'],'niveauIdentification'=>$donnees['niveauidentification'],'infecteBacterie'=>$donnees['infectebacterie'],'codePiege'=>$donnees['codepiege'],'initiale'=>$donnees['initiale'], 'idTaxonomie'=>$donnees['idtaxonomie'],'nombreIndividu'=>$donnees['nombreindividu'],'idSite'=>$donnees['idsite'],'numSite'=>$donnees['numsite'],'nomCavite'=>$donnees['nomcavite'],'idGrotte'=>$donnees['idgrotte']);
          }
          header("Content-Type:application/json");
          echo json_encode($data);
        }

        //------------------------------------------------------------------------------------------------


        if($_REQUEST['choixRecherche']=="Taxonomie"){
          $data = Array("resultat" => Array());
          if (empty($_REQUEST['recherche'])){
            $requete='SELECT id,classe,ordre,famille,sousFamille,genre,espece,photo FROM Taxonomie';
          }else{
            $requete = "SELECT id,classe,ordre,famille,sousFamille,genre,espece FROM Taxonomie
            WHERE (
              LOWER (classe) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
              OR LOWER(ordre) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
              OR LOWER (famille) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
              OR LoWER (sousFamille) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
              OR LOWER (genre) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
              OR LOWER (espece) LIKE '%". strtolower($_REQUEST['recherche']) ."%')" ;
            }
            $query = $bdd->query($requete);
            while ($donnees = $query->fetch()) {
              $data['resultat'][] = Array('id'=>$donnees['id'], 'classe'=>$donnees['classe'],'ordre'=>$donnees['ordre'],'famille'=>$donnees['famille'],'sousFamille'=>$donnees['sousfamille'],'genre'=>$donnees['genre'],'espece'=>$donnees['espece'],'photo'=>$donnees['photo']);
            }
            header("Content-Type:application/json");
            echo json_encode($data);
          }

//------------------------------------------------------------------------------------------------

          if($_REQUEST['choixRecherche']=="Gene"){
            $data = Array("resultat" => Array());
            if (empty($_REQUEST['recherche'])){
              $requete='SELECT nom FROM Gene';
            }else{
              $requete = "SELECT nom FROM Gene
              WHERE (
                LOWER (nom) LIKE '%". strtolower($_REQUEST['recherche']) ."%')";
              }
              $query = $bdd->query($requete);
              while ($donnees = $query->fetch()) {
                $data['resultat'][] = Array('nom'=>$donnees['nom']);
              }
              header("Content-Type:application/json");
              echo json_encode($data);
            }

            //------------------------------------------------------------------------------------------------

            if($_REQUEST['choixRecherche']=="SystemeHydrographique"){
              $data = Array("resultat" => Array());
              if (empty($_REQUEST['recherche'])){
                $requete='SELECT id,nom, departement,pays FROM SystemeHydrographique';
              }else{
                $requete = "SELECT id,nom, departement,pays FROM SystemeHydrographique
                WHERE (
                  LOWER (nom) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
                  OR LOWER(departement) LIKE '%". strtolower($_REQUEST['recherche']) ."%'
                  OR LOWER (pays) LIKE '%". strtolower($_REQUEST['recherche']) ."%')" ;
                }
                $query = $bdd->query($requete);
                while ($donnees = $query->fetch()) {
                  $data['resultat'][] = Array('id'=>$donnees['id'], 'nom'=>$donnees['nom'],'departement'=>$donnees['departement'],'pays'=>$donnees['pays']);
                }
                header("Content-Type:application/json");
                echo json_encode($data);
              }


              //------------------------------------------------------------------------------------------------

              if($_REQUEST['choixRecherche']=="EquipeSpeleo"){
                $data = Array("resultat" => Array());
                if (empty($_REQUEST['recherche'])){
                  $requete='SELECT codeEquipe FROM EquipeSpeleo';
                }else{
                  $requete = "SELECT codeEquipe FROM EquipeSpeleo
                  WHERE (
                    LOWER (codeEquipe) LIKE '%". strtolower($_REQUEST['recherche']) ."%')" ;
                  }
                  $query = $bdd->query($requete);
                  while ($donnees = $query->fetch()) {
                    $data['resultat'][] = Array('codeEquipe'=>$donnees['codeequipe']);
                  }
                  header("Content-Type:application/json");
                  echo json_encode($data);
                }


                //------------------------------------------------------------------------------------------------

                if($_REQUEST['choixRecherche']=="Personne"){
                  $data = Array("resultat" => Array());
                  if (empty($_REQUEST['recherche'])){
                    $requete='SELECT id,initiale FROM Personne';
                  }else{
                    $requete = "SELECT id,initiale FROM Personne
                    WHERE (
                      LOWER (initiale) LIKE '%". strtolower($_REQUEST['recherche']) ."%')" ;
                    }
                    $query = $bdd->query($requete);
                    while ($donnees = $query->fetch()) {
                      $data['resultat'][] = Array('id'=>$donnees['id'], 'initiale'=>$donnees['initiale']);
                    }
                    header("Content-Type:application/json");
                    echo json_encode($data);
                  }

            ?>
