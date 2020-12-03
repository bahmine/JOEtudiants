<?php
session_start ();
include('entete.php');
$nLogement = $_POST['nLogement'];
$requete = (" select distinct nomBat FROM LesSportifs natural 
join LesLocataires  where pays =:p and categorieS =:c and nLogement=:n
");
$curseur=oci_parse ($lien,$requete);
oci_bind_by_name($curseur,':p',$_SESSION['pays']);
oci_bind_by_name($curseur,':c',$_SESSION['categS']);
oci_bind_by_name($curseur,':n',$nLogement);
$ok = oci_execute ($curseur);
if (!$ok) {
	// oci_execute a échoué, on affiche l'erreur
		$error_message = oci_error($curseur);
		echo "<p class=\"erreur\">{$error_message['message']}</p>";
} else {
	$res = oci_fetch ($curseur);
		if (!$res) {
			// il n'y a aucun résultat
			echo "<p class=\"erreur\"><b>Aucun Batiment pour ce pays</b></p>" ;
		} else {
			$_SESSION['nLogement']=$_POST['nLogement'];
			echo ("
				<form action=\"InscrireSportif_action2.php\" method=\"post\">
					<label for=\"sel_nBatiment\">Sélectionnez un Batiment :</label>
					<select id=\"sel_nBatiment\" name=\"nomBat\">
			");
			// création des options
			do {

				$nomBat = oci_result($curseur, 1);
				echo ("<option value=\"$nomBat\">$nomBat</option>");

			} while ($res = oci_fetch ($curseur));
			echo ("
					</select>
					<br /><br />
					<input type=\"submit\" value=\"Valider\" />
					<input type=\"reset\" value=\"Annuler\" />
				</form>
			");
		}
}
oci_free_statement($curseur);
include('pied.php');
?>
