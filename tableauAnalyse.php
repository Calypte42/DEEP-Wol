<?php
include 'BDD/bdd.php';
$bdd=connexionbd();


include 'verificationConnexion.php';
include 'consultationModification.php';

$RetourNomGrotte=$_REQUEST['nomGrotte'];
$RetourIdGrotte=$_REQUEST['idGrotte'];
$RetourNomSite=$_REQUEST['site'];
$RetourIdSite=$_REQUEST['idSite'];
$RetourPiege=$_REQUEST['piege'];
$RetourEchantillon=$_REQUEST['numEchantillon'];
$RetourIdEchantillon=$_REQUEST['idEchantillon'];
echo"<form method='post' action='tableauEchantillon.php?piege=$RetourPiege&nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>";
?>
<input type="submit" value="Revenir au tableau des Echantillons" />
</form>

<div class= "col-sm-10">
  <?php echo "Liste des analyses de l'echantillon : $RetourEchantillon". " du site : ".$_REQUEST['site']." de la grotte : ".$_REQUEST['nomGrotte'];
?>
  <table class="table table-bordered table-condensed" style="margin-top: 10px;">
    <thead>
      <tr>
        <th>Numero Echantillon</th>
        <th>Forme de stockage</th>
        <th>Lieu de stockage</th>
        <th>Niveau d'identification</th>
        <th>Infecte par bactérie</th>
      </tr>
    <thead>
    <tbody>
      <?php
 $req='SELECT numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie from Echantillon e, Personne a, Taxonomie t where e.id=\''.$_REQUEST["idEchantillon"].'\' AND e.idAuteur=a.id AND e.idTaxonomie=t.id';

 $value=requete($bdd,$req); /* value recupere la reponse de la requete */
 foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
 	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
 				if(empty($resultat)){
           echo "<td>Non renseigné</td>";
 					}else{
 				echo "<td>$resultat</td> ";
 			}

 		}}
    echo "</tbody></table>";?>


<table class="table table-bordered table-condensed" style="margin-top: 10px;">
  <thead>
    <tr>
      <th>Classe</th>
      <th>Ordre</th>
      <th>Famille</th>
      <th>Sous Famille</th>
      <th>Genre</th>
      <th>Espece</th>
      <th>initiales auteur</th>
    </tr>
  <thead>
  <tbody>
    <?php
$req='SELECT t.classe,t.ordre,t.famille,t.sousFamille,t.genre,t.espece, a.initiale from Echantillon e, Personne a, Taxonomie t where e.id=\''.$_REQUEST["idEchantillon"].'\' AND e.idAuteur=a.id AND e.idTaxonomie=t.id';

$value=requete($bdd,$req); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if(empty($resultat)){
         echo "<td>Non renseigné</td>";
        }else{
      echo "<td>$resultat</td> ";
    }

  }}
  echo "</tbody></table>";?>


 <h4> Liste des PCR : </h4>
  <table class="table table-bordered table-condensed" style="margin-top: 10px;">
    <thead>
      <tr>
        <th>nomGene</th>
        <th>Resultat</th>
        <th>Date</th>
        <th>Fasta</th>
        <th>Electrophoregramme</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    <thead>
    <tbody>

      <?php


$requete='SELECT id,nomgene,resultat,dateAnalyse,fasta,electrophoregramme FROM Analyses WHERE type=\'PCR\' AND idEchantillon=\''.$_REQUEST['idEchantillon'].'\'';
  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
  $date = $valeur['dateanalyse'];
  $nomGene = $valeur['nomgene'];
  foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if($cle=='id'){
        $id=$resultat;
      }else{

        if(empty($resultat)){
          echo "<td>Non renseigné</td>";
          }else{
                  if ($cle=='fasta'){
                      echo "<td><a href='$resultat' onclick=\"window.open(this.href, 'newwindow',
                      'width=800,height=600'); return false;\">fichier fasta</a></td> ";
                  } elseif ($cle=='electrophoregramme'){
                      echo "<td><a href='$resultat' onclick=\"window.open(this.href, 'newwindow',
                      'width=800,height=600'); return false;\">electrophoregramme</a></td> ";
                  }else{
                      echo "<td>$resultat</td> ";
                  }
      }

    }}
    echo "<td><form method='GET' action='modifAnalyse.php'>";
    echo "<input type='hidden' name='id' value='$id' />";
    echo "<input type='hidden' name='nomGrotte' value='$RetourNomGrotte' />";
    echo "<input type='hidden' name='idGrotte' value='$RetourIdGrotte' />";
    echo "<input type='hidden' name='site' value='$RetourNomSite' />";
    echo "<input type='hidden' name='idSite' value='$RetourIdSite' />";
    echo "<input type='hidden' name='piege' value='$RetourPiege' />";
    echo "<input type='hidden' name='numEchantillon' value='$RetourEchantillon' />";
    echo "<input type='hidden' name='idEchantillon' value='$RetourIdEchantillon' />";
    echo "<input type='submit' value='Modifier' />";
    echo "</form></td>";
    //echo ('<td><a href="">'."Modifier".'</a></td>');
    echo "<td><form method='GET' onsubmit='return suppression(this)'>";
    echo "<input type='hidden' name='nom' value='$RetourEchantillon - $nomGene - $date' />";
    echo "<input type='hidden' name='table' value='analyses' />";
    echo "<input type='hidden' name='colonne' value='id' />";
    echo "<input type='hidden' name='id' value='$id' />";
    echo "<input type='submit' value='Supprimer' />";
    echo "</form></td></tr>";
    //echo('<td><a href="">'."Supprimer".'</a></td></tr>');
}
echo "</table>";
?>


    </tbody>
    </table>

    <h4 style="margin-top: 40px;"> Liste des qPCR : </h4>
     <table class="table table-bordered table-condensed" style="margin-top: 10px;">
       <thead>
         <tr>
           <th>nomGene</th>
           <th>Resultat</th>
           <th>Date</th>
           <th>Fasta</th>
           <th>Electrophoregramme</th>
           <th>Modifier</th>
           <th>Supprimer</th>
         </tr>
       <thead>
       <tbody>

         <?php


   $requete='SELECT id,nomgene,resultat,dateAnalyse,fasta,electrophoregramme FROM Analyses WHERE type=\'qPCR\' AND idEchantillon=\''.$_REQUEST['idEchantillon'].'\'';
     /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

   $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
   foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
     $date = $valeur['dateanalyse'];
     $nomGene = $valeur['nomgene'];
     foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
         if($cle=='id'){
           $id=$resultat;
         }else{

           if(empty($resultat)){
             echo "<td>Non renseigné</td>";
             }else{
                 if ($cle=='fasta'){
                     echo "<td><a href='$resultat' onclick=\"window.open(this.href, 'newwindow',
                     'width=800,height=600'); return false;\">fichier fasta</a></td> ";
                 } elseif ($cle=='electrophoregramme'){
                     echo "<td><a href='$resultat' onclick=\"window.open(this.href, 'newwindow',
                     'width=800,height=600'); return false;\">electrophoregramme</a></td> ";
                 } else {
                     echo "<td>$resultat</td> ";
                 }
         }

       }}
       echo "<td><form method='GET' action='modifAnalyse.php'>";
       echo "<input type='hidden' name='id' value='$id' />";
       echo "<input type='hidden' name='nomGrotte' value='$RetourNomGrotte' />";
       echo "<input type='hidden' name='idGrotte' value='$RetourIdGrotte' />";
       echo "<input type='hidden' name='site' value='$RetourNomSite' />";
       echo "<input type='hidden' name='idSite' value='$RetourIdSite' />";
       echo "<input type='hidden' name='piege' value='$RetourPiege' />";
       echo "<input type='hidden' name='numEchantillon' value='$RetourEchantillon' />";
       echo "<input type='hidden' name='idEchantillon' value='$RetourIdEchantillon' />";
       echo "<input type='submit' value='Modifier' />";
       echo "</form></td>";
       //echo ('<td><a href="">'."Modifier".'</a></td>');
       echo "<td><form method='GET' onsubmit='return suppression(this)'>";
       echo "<input type='hidden' name='nom' value='$RetourEchantillon - $nomGene - $date' />";
       echo "<input type='hidden' name='table' value='analyses' />";
       echo "<input type='hidden' name='colonne' value='id' />";
       echo "<input type='hidden' name='id' value='$id' />";
       echo "<input type='submit' value='Supprimer' />";
       echo "</form></td></tr>";
       //echo('<td><a href="">'."Supprimer".'</a></td></tr>');
   }
   echo "</table>";
   ?>


       </tbody>
       </table>

      <?php
      echo "<form style='float:right' name='versAjoutAnalyse' method='POST'
      action='ajoutAnalyse.php?idEchantillon=$RetourIdEchantillon&numEchantillon=$RetourEchantillon&nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite&piege=$RetourPiege'>";
      ?>
      <input type="submit" value="Ajouter une analyse" />
    </form>

</div>
</div> <!-- ferme le row de consultationModification -->
</div> <!-- ferme le container-fluid de consultationModification -->

<?php
include 'HTML/pied.html';
?>
