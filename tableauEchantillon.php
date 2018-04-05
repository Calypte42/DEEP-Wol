
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
    <?php echo "Liste des échantillons du piège : ".$_REQUEST['piege']; ?>
		<table class="table table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th>Numero Echantillon</th>
					<th>Forme de stockage</th>
					<th>Lieu de stockage</th>
					<th>Infecte par bactérie</th>
					<th>Niveau d'identification</th>
          <th>Auteur identification</th>
          <th>Genre</th>
          <th>Espece</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			<thead>
			<tbody>

			<?php


$requete='SELECT e.id,numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie,a.nom,t.genre,t.espece from Echantillon e, Personne a, Taxonomie t where codePiege=\''.$_REQUEST["piege"].'\' AND e.idAuteur=a.id AND e.idTaxonomie=t.id';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if($cle=='id'){
        $id=$resultat;
      }else{
      if($cle=='numechantillon'){
			 echo "<td><a href='tableauAnalyse.php?idEchantillon=$id&echantillon=$resultat'>$resultat</a></td> ";
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

	<?php
echo "<form style='float:right' name='versAjoutEchantillon' method='POST'
	action='ajoutEchantillon.php?nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite&piege=$RetourPiege'>";
	?>
		<input type="submit" value="Ajouter un echantillon" />
	</form>

	</div>
	
<?php
include 'HTML/pied.html';
?>
