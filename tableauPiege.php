
<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

	<div class="container" style="margin-top:-400px; margin-right:80px;">
    <?php echo "Liste des pièges du site : ".$_REQUEST['site']; ?>
		<table class="table table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th>Code Piege</th>
					<th>Date Pose</th>
					<th>Heure Pose</th>
					<th>Date Recuperation</th>
					<th>Heure Recuperation</th>
					<th>Probleme</th>
          <th>Date de tri</th>
					<th>Code equipe speleo</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			<thead>
			<tbody>

			<?php
$RetourNomGrotte=$_REQUEST['nomGrotte'];
$RetourIdGrotte=$_REQUEST['idGrotte'];
$RetourNomSite=$_REQUEST['site'];
$RetourIdSite=$_REQUEST['idSite'];

$requete='SELECT codePiege,datePose,heurePose,dateRecup,heureRecup,probleme,dateTri,codeEquipeSpeleo from Piege where IdSite=\''.$_REQUEST["idSite"].'\'';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if($cle=='id'){
        $id=$resultat;
      }else{
      if($cle=='codepiege'){
			 echo "<td><a href='tableauEchantillon.php?piege=$resultat&nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>$resultat</a></td> ";
     }else {
       if(empty($resultat)){
         echo "<td>Non renseigné</td>";
         }else{
       echo "<td>$resultat</td> ";
     }}

   }}
	 echo ('<td><a href="">'."Modifier".'</a></td>');
	 echo('<td><a href="">'."Supprimer".'</a></td></tr>');
}
echo "</table>";
?>
			</tbody>
		</table>

	</div>
<?php
	echo "<form style='float:right' name='versAjoutPiege' method='POST' action='ajoutPiege.php?nomGrotte=$RetourNomGrotte
	&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>";
?>
		<input type="submit" value="Ajouter un piege" />
	</form>

<?php
include 'HTML/pied.html';
?>
