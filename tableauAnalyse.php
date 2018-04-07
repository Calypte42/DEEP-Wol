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

?>

<div class="container" style="margin-top:-400px; margin-right:80px;">
<!--  <?php echo "Liste des analyses de l'échantillon : ".$_REQUEST['']; ?>-->
  <table class="table table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>nomGene</th>
        <th>Resultat PCR</th>
        <th>Resultat qPCR</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    <thead>
    <tbody>

    </tbody>
    </table>

      <?php
      echo "<form style='float:right' name='versAjoutGene' method='POST'
      action='ajoutGene.php?nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite&piege=$RetourPiege'>";
      ?>
      <input type="submit" value="Ajouter un gène" />
    </form>
</div>

<?php
include 'HTML/pied.html';
?>
