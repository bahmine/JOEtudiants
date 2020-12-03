<?php
session_start ();
$titre = "Inscription d'un Sportif";
include('entete.php');
$requete = "select max(nSportif)+1 FROM LesSportifs";
$curseur = oci_parse ($lien, $requete) ;
$ok = oci_execute ($curseur);

	// on teste $ok pour voir si oci_execute s'est bien passé
	if (!$ok) {
		// oci_execute a échoué, on affiche l'erreur
		$error_message = oci_error($curseur);
		echo "<p class=\"erreur\">{$error_message['message']}</p>";
	} else {
		$res = oci_fetch ($curseur); 
		if (!$res) echo "<p class=\"erreur\"><b>Erreur</b></p>" ;
		else {
		$val = oci_result ($curseur,1);
	echo ("
	 <form action=\"InscrireSportif_action.php\" method=\"post\">
	    <table>
	    <tr><td colspan=\"2\"><input type =\"hidden\" name=\"nSportif\" value=\"$val\"/></td></tr>
	    <tr><td><b>Nom Sportif </b></td> <td><input type =\"text\" name=\"nomS\" required=\"required\" autocomplete=\"off\"/></td></tr>
	    <tr><td><b>Prenom Sportif</b></td> <td> <input type =\"text\" name=\"prenomS\" required=\"required\" autocomplete=\"off\"/></td></tr>
	    <tr><td><b>Categorie Sportif</b> </td> <td><input type =\"radio\" name=\"categS\" value=\"masculin\" checked=\"checked\"/> Masculin
											<input type =\"radio\" name=\"categS\" value=\"feminin\"/> Feminin</td></tr> 
	    <tr><td><b>Date de Naissance</b> </td> <td><input type =\"date\" name=\"datS\" required=\"required\"/></td></tr>
	    <tr><td><b>Pays</b> </td> <td><input type =\"text\" name=\"pays\" required=\"required\"/></td></tr>
	    </table>
	    <br/> <br/>
	    <input type=\"submit\" value=\"Inscrire\"/>
	    <input type=\"reset\" value=\"Annuler\"/>
	 </form>
	");
}
 }
 oci_free_statement($curseur);
include('pied.php');
?>
