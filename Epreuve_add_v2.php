<?php
    $titre = 'Les dates des épreuves de la disicipline Bob';
	include('entete.php');
	// construction des requêtes
    $requete1 = "INSERT INTO LesDisciplines values ('Bob')";
    $requete2 = "INSERT INTO LesEpreuves values (120, 'Bob a 2', 'par equipe', 'Bob', 'feminin', 2, to_date('29-02-2016 20:00', 'DD-MM-YYYY HH24:MI'))";
	// analyse de la requete 1 et association au curseur
	$curseur = oci_parse ($lien, $requete1) ;
	// execution de la requete
	$ok = @oci_execute ($curseur, OCI_NO_AUTO_COMMIT) ;
	// on teste $ok pour voir si oci_execute s'est bien passé
	if (!$ok) {
		echo LeMessage ("majRejetee") ;
		$e = oci_error ($curseur);
		echo LeMessageOracle ($e['code'], $e['message']) ;
		// terminaison de la transaction : annulation
		oci_rollback ($lien) ;
	}	else {
		// analyse de la requete 2 et association au curseur
		$curseur = oci_parse ($lien, $requete2) ;
		// execution de la requete
		$ok = @oci_execute ($curseur, OCI_NO_AUTO_COMMIT) ;
		// on teste $ok pour voir si oci_execute s'est bien passé
		if (!$ok) {
			echo LeMessage ("majRejetee") ;
			$e = oci_error ($curseur);
			echo LeMessageOracle ($e['code'], $e['message']) ;
			// terminaison de la transaction : annulation
			oci_rollback ($lien) ;
		}		else {
			echo LeMessage ("majOK") ;
			// terminaison de la transaction : validation
			oci_commit ($lien) ;
		}
	}
	// on libère le curseur
	oci_free_statement($curseur);
	include('pied.php');
?>
