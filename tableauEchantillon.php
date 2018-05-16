
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
echo"<form method='post' action='tableauPiege.php?nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>";
?>
<input type="submit" value="Revenir au tableau des Pieges" />
</form>

	<div class= "col-sm-10">
    <?php echo "Liste des échantillons de la ".$_REQUEST['nomGrotte']." du ".$_REQUEST['site']." du ".$_REQUEST['piege']; ?>
		<table class="table table-bordered table-condensed" style="margin-top: 10px;">
			<thead>
				<tr>
					<th>Numero Echantillon</th>
					<th>Forme de stockage</th>
					<th>Lieu de stockage</th>
					<th>Niveau d'identification</th>
					<th>Infecte par bactérie</th>
          <th>Auteur identification</th>
          <th>Genre</th>
          <th>Espece</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			<thead>
			<tbody>

			<?php


$requete='SELECT e.id,numEchantillon,formeStockage,lieuStockage,niveauIdentification,infecteBacterie,a.initiale,t.genre,t.espece from Echantillon e, Personne a, Taxonomie t where codePiege=\''.$_REQUEST["piege"].'\' AND e.idAuteur=a.id AND e.idTaxonomie=t.id ORDER BY numEchantillon';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
		echo "$resultat";
      if($cle=='id'){
        $id=$resultat;
      }else{
      if($cle=='numechantillon'){
                $numEchantillon = $resultat;
				echo "<td><a href='tableauAnalyse.php?idEchantillon=$id&numEchantillon=$resultat&piege=$RetourPiege&nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>$resultat</a></td> ";
			}else {
				// Debut gestion des bacterie
				if($cle=='infectebacterie'){
					if($resultat=="oui"){
						$requeteBacterie='SELECT clade FROM CorrespondanceEchantillonBacterie WHERE idEchantillon=\''.$id.'\'';
						$resBacterie=requete($bdd,$requeteBacterie);
						if(count($resBacterie)!=0){
							echo "<td><ul>";
							foreach ($resBacterie as $valeurBac) {
								foreach ($valeurBac as $cladeBact) {
									echo "<li style='color:green'>$cladeBact</li>";
								}
							}
							echo "</ul></td>";
						}
						else{
							echo "<td style='color:green'>$resultat</td>";
						}
					}
					if($resultat=="non"){
						echo "<td style='color:red'>$resultat</td>";
					}
					if($resultat=="nonDetermine"){
						echo "<td>$resultat</td>";
					}
				}//Fin gestion des bacteries

					else{
				if(isset($resultat)){
          echo " <td>$resultat</td>";
					}else{
				echo "<td>Non renseigné</td> ";
			}}

		}}}
        echo "<td><form method='GET' action='modifEchantillon.php'>";
        echo "<input type='hidden' name='id' value='$id' />";
        echo "<input type='hidden' name='nomGrotte' value='$RetourNomGrotte' />";
        echo "<input type='hidden' name='idGrotte' value='$RetourIdGrotte' />";
        echo "<input type='hidden' name='site' value='$RetourNomSite' />";
        echo "<input type='hidden' name='idSite' value='$RetourIdSite' />";
        echo "<input type='hidden' name='piege' value='$RetourPiege' />";
        echo "<input type='submit' value='Modifier' />";
        echo "</form></td>";
		//echo ('<td><a href="">'."Modifier".'</a></td>');
        echo "<td><form method='GET' onsubmit='return suppression(this)'>";
        echo "<input type='hidden' name='nom' value='$numEchantillon' />";
        echo "<input type='hidden' name='table' value='echantillon' />";
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
echo "<form style='float:right' name='versAjoutEchantillon' method='POST'
	action='ajoutEchantillon.php?nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite&piege=$RetourPiege'>";
	?>
		<input type="submit" value="Ajouter un échantillon" />
	</form>

</div>
</div> <!-- ferme le row de consultationModification -->
</div> <!-- ferme le container-fluid de consultationModification -->

<?php
include 'HTML/pied.html';
?>
