<?php
include 'BDD/bdd.php';
$bdd=connexionbd();

include 'verificationConnexion.php';
include 'consultationModification.php';
$RetourNomGrotte=$_REQUEST['nomGrotte'];
$RetourIdGrotte=$_REQUEST['idGrotte'];
$RetourNomSite=$_REQUEST['site'];
$RetourIdSite=$_REQUEST['idSite'];
echo"<form method='post' action='tableauSite.php?grotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte'>";
?>
<input type="submit" value="Revenir au tableau des Sites" />
</form>

	<div class= "col-sm-10">
    <?php echo "Liste des pièges de la ".$_REQUEST['nomGrotte']. " et du ".$_REQUEST['site']; ?>
		<table class="table table-bordered table-condensed" style="margin-top: 10px;">
			<thead>
				<tr>
					<th>Code Piege</th>
					<th>Date Pose</th>
					<th>Heure Pose</th>
					<th>Date Recuperation</th>
					<th>Heure Recuperation</th>
					<th>Probleme</th>
          <th>Date de tri</th>
					<th>Temperature</th>
					<th>Code equipe speleo</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			<thead>
			<tbody>

			<?php


$requete='SELECT codePiege,datePose,heurePose,dateRecup,heureRecup,probleme,dateTri,temperature,codeEquipeSpeleo from Piege where IdSite=\''.$_REQUEST["idSite"].'\' ORDER BY codePiege';  /*On prepare une requete permettant de recupere l'ensemble de la table grotte*/

$value=requete($bdd,$requete); /* value recupere la reponse de la requete */
foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
	foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
      if($cle=='id'){
        $id=$resultat;
      }else{
      if($cle=='codepiege'){
          $id=$resultat;
          echo "<td><a href='tableauEchantillon.php?piege=$resultat&nomGrotte=$RetourNomGrotte&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>$resultat</a></td> ";
     }else {
       if(empty($resultat)){
         echo "<td>Non renseigné</td>";
         }else{
       echo "<td>$resultat</td> ";
     }}

   }}
     echo "<td><form method='GET' action='modifPiege.php'>";
     echo "<input type='hidden' name='id' value='$id' />";
     echo "<input type='hidden' name='nomGrotte' value='$RetourNomGrotte' />";
     echo "<input type='hidden' name='idGrotte' value='$RetourIdGrotte' />";
     echo "<input type='hidden' name='site' value='$RetourNomSite' />";
     echo "<input type='hidden' name='idSite' value='$RetourIdSite' />";
     echo "<input type='submit' value='Modifier' />";
     echo "</form></td>";
     echo "<td><form method='GET' onsubmit='return suppression(this)'>";
     echo "<input type='hidden' name='nom' value='$id' />";
     echo "<input type='hidden' name='table' value='piege' />";
     echo "<input type='hidden' name='colonne' value='codePiege' />";
     echo "<input type='hidden' name='id' value='$id' />";
     echo "<input type='submit' value='Supprimer' />";
     echo "</form></td></tr>";
	 
}
echo "</table>";
?>
			</tbody>
		</table>

<?php
	echo "<form style='float:right' name='versAjoutPiege' method='POST' action='ajoutPiege.php?nomGrotte=$RetourNomGrotte
	&idGrotte=$RetourIdGrotte&site=$RetourNomSite&idSite=$RetourIdSite'>";
?>
		<input type="submit" value="Ajouter un piège" />
	</form>

</div>
</div> <!-- ferme le row de consultationModification -->
</div> <!-- ferme le container-fluid de consultationModification -->

<?php
include 'HTML/pied.html';
?>
