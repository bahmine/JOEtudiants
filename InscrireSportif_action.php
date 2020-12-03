<?php
session_start ();
include('entete.php');
$nSportif = $_POST['nSportif'];
$nomS = $_POST['nomS'];
$prenomS = $_POST['prenomS'];
$categS = $_POST['categS'];
$datS = $_POST['datS'];
$payS = $_POST['pays'];
$titre = "Vous devez choisir un logement Pour $nomS $prenomS"; 
//Inscription d'un Sportif
$requete = ("insert into LesSportifs (nSportif,nomS,prenomS,pays,categorieS,dateNais) 
         VALUES (:s,:n,:p,:y,:c,to_date('$datS','yyyy/mm/dd'))"
         );

$curseur = oci_parse ($lien, $requete);
oci_bind_by_name ($curseur,':s',$nSportif);
oci_bind_by_name ($curseur,':n',$nomS);
oci_bind_by_name ($curseur,':p',$prenomS);
oci_bind_by_name ($curseur,':y',$pays);
oci_bind_by_name ($curseur,':c',$categS);
//oci_bind_by_name ($curseur,':d',$datS);
$ok = oci_execute ($curseur);
if (!$ok) {
	$error_message = oci_error($curseur);
      echo "<p class=\"erreur\">Echec Inscription Sportif</p>";
      echo "<p class=\"erreur\">{$error_message['message']}</p>";

}else {		
	$requete1 = (" select distinct nLogement,nomBat FROM
	    (select nLogement, nomBat, (capacite-nR) as Restant
        from(select nLogement, nomBat, capacite from LesLogements 
        natural join LesLocataires natural join LesSportifs
        where pays=:p and categorieS=:c) natural join
        (select nLogement, nomBat, count(nSportif) as nR 
        from LesLocataires group by nLogement,nomBat)
        ) where Restant > 0
	");
	$curseur1 = oci_parse ($lien, $requete1);
	oci_bind_by_name ($curseur1,':p',$payS);
	oci_bind_by_name ($curseur1,':c',$categS);
	$ok1 = oci_execute ($curseur1);
	if (!$ok1) {
		// oci_execute a échoué, on affiche l'erreur
		$error_message = oci_error($curseur1);
		echo "<p class=\"erreur\">{$error_message['message']}</p>";
	} else { 
		  $res = oci_fetch ($curseur1);
		   if (!$res) {
			   echo "<p class=\"erreur\"><b>Erreur Logement vide</b></p>" ;
		   } else {
			   $_SESSION['nSportif'] = $_POST['nSportif'];
			   $_SESSION['nomS'] = $_POST['nomS'];
			   $_SESSION['prenomS'] = $_POST['prenomS'];
			   $_SESSION['categS'] = $_POST['categS'];
               $_SESSION['datS'] = $_POST['datS'];
               $_SESSION['pays'] = $_POST['pays'];

		     //on affiche le formulaire de sélection
		    echo ("
				<form action=\"InscrireSportif_action1.php\" method=\"post\">
					<label for=\"sel_nLogement dispo\">Sélectionnez un Logement ou sera logé ce sportif:</label>
					<select id=\"sel_nLogement\" name=\"nLogement\">
			");
       		
       		do {
				$nLogement = oci_result($curseur1, 1);
				echo ("<option value=\"$nLogement\">$nLogement</option>");

			}while ($res = oci_fetch ($curseur1));
			echo ("</select>
			      <br /><br />
					<input type=\"submit\" value=\"Valider\" />
					<input type=\"reset\" value=\"Annuler\" />
				</form>
			");
		   }
	   }
}
oci_free_statement($curseur1);
oci_free_statement($curseur);
include('pied.php');
?>
