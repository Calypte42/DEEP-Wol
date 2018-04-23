<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
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
 <?php echo "Liste des analyses de l'$RetourEchantillon". " du ".$_REQUEST['site']." de la ".$_REQUEST['nomGrotte']; ?>
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


$requete='SELECT id,nomgene,resultat,datepcr,fasta,electrophoregramme FROM PCR';
  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
  $date = $valeur['datepcr'];
  foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if($cle=='id'){
        $id=$resultat;
      }else{

        if(empty($resultat)){
          echo "<td>Non renseigné</td>";
          }else{
                  if ($cle=='fasta'){
                      echo "<td><a href='$resultat'>fichier fasta</a></td> ";
                  } elseif ($cle=='electrophoregramme'){
                      echo "<td><a href='$resultat'>electrophoregramme</a></td> ";
                  }else{
                      echo "<td>$resultat</td> ";
                  }
      }

    }}
    echo ('<td><a href="">'."Modifier".'</a></td>');
    echo "<td><form method='GET' onsubmit='return suppression(this)'>";
    echo "<input type='hidden' name='nom' value='$date' />";
    echo "<input type='hidden' name='table' value='PCR' />";
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


   $requete='SELECT id,nomgene,resultat,dateqpcr,fasta,electrophoregramme FROM qPCR';
     /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

   $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
   foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
     $date = $valeur['dateqpcr'];
     foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
         if($cle=='id'){
           $id=$resultat;
         }else{

           if(empty($resultat)){
             echo "<td>Non renseigné</td>";
             }else{
                 if ($cle=='fasta'){
                     echo "<td><a href='$resultat'>fichier fasta</a></td> ";
                 } elseif ($cle=='electrophoregramme'){
                     echo "<td><a href='$resultat'>electrophoregramme</a></td> ";
                 } else {
                     echo "<td>$resultat</td> ";
                 }
         }

       }}
       echo ('<td><a href="">'."Modifier".'</a></td>');
       echo "<td><form method='GET' onsubmit='return suppression(this)'>";
       echo "<input type='hidden' name='nom' value='$date' />";
       echo "<input type='hidden' name='table' value='qPCR' />";
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
