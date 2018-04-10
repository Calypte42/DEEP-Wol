<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

?>

<?php
include 'verificationConnexion.php';
include 'consultationModification.php';
?>

	<div class="container" style="margin-top:-400px; margin-right:80px;">
    <?php echo "Liste des sites de la grottes : ".$_REQUEST['grotte']; ?>
		<table class="table table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th>Numéro Site</th>
					<th>Profondeur</th>
					<th>Temperature</th>
					<th>Type de sol</th>
					<th>Distance a l entree</th>
					<th>Presence d'eau</th>
					<th>Code equipe speleo</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			<thead>
			<tbody>

			<?php

			$RetourId=$_REQUEST['idGrotte'];
			$Retour=$_REQUEST['grotte'];

$requete='SELECT id,numSite,profondeur,temperature,typeSol,distanceEntree,presenceEau,codeEquipeSpeleo from Site where idGrotte=\''.$_REQUEST["idGrotte"].'\' order by id';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if($cle=='id'){
        $id=$resultat;
      }else{
      if($cle=='numsite'){
			 echo "<td><a href='tableauPiege.php?idSite=$id&site=$resultat&idGrotte=$RetourId&nomGrotte=$Retour'>$resultat</a></td> ";
		 }else {
			 if(isset($resultat)){
				 if($cle=='presenceeau'){
					 if($resultat==0){
						 echo "<td>Non</td> ";
					 }
					 if($resultat==1){
						 echo "<td>Oui</td> ";
					 }
				 }else{
			 echo "<td>$resultat</td> ";
		 }}else{
			 echo "<td>Non renseigné</td>";
		 }}

	 }}
     echo "<td><form method='GET' action='modifSite.php'>";
     echo "<input type='hidden' name='id' value='$id' />";
     echo "<input type='hidden' name='idGrotte' value='$RetourId' />";
     echo "<input type='hidden' name='grotte' value='$Retour' />";
     echo "<input type='submit' value='Modifier' />";
     echo "</form></td>";
	 //echo ('<td><a href="">'."Modifier".'</a></td>');
	 echo('<td><a href="">'."Supprimer".'</a></td></tr>');
}
echo "</table>";
?>
			</tbody>
		</table>

	<?php
		echo "<form style='float:right' name='versAjoutSite' method='POST' action='ajoutSite.php?idGrotte=$RetourId&grotte=$Retour'>";
	?>
		<input type="submit" value="Ajouter un site" />
	</form>

	</div>

<?php
include 'HTML/pied.html';
?>
