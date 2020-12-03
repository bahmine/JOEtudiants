<?php
session_start();
$nomBat = $_POST['nomBat'];
$nSportif = $_SESSION['nSportif'];
$nomS = $_SESSION['nomS'];
$prenomS = $_SESSION['prenomS'];
$nLogement = $_SESSION['nLogement'];
include('entete.php');
$requete = ("
    insert into LesLocataires (nSportif,nLogement,nomBat) 
         VALUES (:n,:l,:b)
");
$curseur = oci_parse ($lien, $requete);
oci_bind_by_name ($curseur,':n',$nSportif);
oci_bind_by_name ($curseur,':l',$nLogement);
oci_bind_by_name ($curseur,':b',$nomBat);
$ok = oci_execute ($curseur);
if (!$ok) {
	// oci_execute a échoué, on affiche l'erreur
		$error_message = oci_error($curseur);
		echo "<p class=\"erreur\">{$error_message['message']}</p>";
} else {
	echo "<p class=\"ok\">Le Sportif $nomS $prenomS a bien été Inscrit et Logé au Batiment $nomBat précisement 
	au Logement N° $nLogement </p>";
			echo "<p class=\"ok\"><a href=\"InscrireSportif.php\">Ajouter un nouveau sportif</a></p>";
			echo "<p class=\"ok\"><a href=\"menu.php\">Aller au Menu</a></p>";
}
oci_free_statement($curseur);
include('pied.php');
?>
