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

?>

<div class="container" style="margin-top:-300px; margin-left:200px;">
 <?php echo "Liste des analyses de l'échantillon : $RetourEchantillon"; ?>
 <h3> Liste des PCR : </h3>
  <table class="table table-bordered table-hover table-condensed">
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


$requete='SELECT nomgene,resultat,datepcr,fasta,electrophoregramme FROM PCR';
  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
  foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if($cle=='id'){
        $id=$resultat;
      }else{

        if(empty($resultat)){
          echo "<td>Non renseigné</td>";
          }else{
        echo "<td>$resultat</td> ";
      }

    }}
    echo ('<td><a href="">'."Modifier".'</a></td>');
    echo('<td><a href="">'."Supprimer".'</a></td></tr>');
}
echo "</table>";
?>


    </tbody>
    </table>

    <h3> Liste des qPCR : </h3>
     <table class="table table-bordered table-hover table-condensed">
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


   $requete='SELECT nomgene,resultat,dateqpcr,fasta,electrophoregramme FROM qPCR';
     /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

   $value=requete($bdd,$requete); /* value recupere la reponse de la requete */
   foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
     foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
         if($cle=='id'){
           $id=$resultat;
         }else{

           if(empty($resultat)){
             echo "<td>Non renseigné</td>";
             }else{
           echo "<td>$resultat</td> ";
         }

       }}
       echo ('<td><a href="">'."Modifier".'</a></td>');
       echo('<td><a href="">'."Supprimer".'</a></td></tr>');
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

<?php
include 'HTML/pied.html';
?>
