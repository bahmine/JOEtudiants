<?php

	$titre = "Détails d'un dossier";
	include('entete.php');
    /*$requete1 = ("CREATE view LesDossiers (nDossier,nUtil,dateEmission,prix) as
      SELECT nDossier,nUtil,dateEmission,sum (E.prix) prix FROM LesDossiers_base
      natural join LesBillets natural join LesEpreuves 
    ");*/
    
	// construction de la requete
	$requete = (" SELECT nDossier
		FROM LesDossiers
		ORDER BY nDossier
	");
    
    
                
   // analyse de la requete et association au curseur
	$curseur = oci_parse ($lien, $requete) ;
	// execution de la requete
	$ok = oci_execute ($curseur) ;
	
	// on teste $ok pour voir si oci_execute s'est bien passé
	if (!$ok) {
		// oci_execute a échoué, on affiche l'erreur
		$error_message = oci_error($curseur);
		echo "<p class=\"erreur\">{$error_message['message']}</p>";
	}
	else {
		// oci_execute a réussi, on fetch sur le premier résultat
		$res = oci_fetch ($curseur);
		if (!$res) {
			// il n'y a aucun résultat
			echo "<p class=\"erreur\"><b>Aucun dossier dans la base de données</b></p>" ;
		}
		else {
			// on affiche le formulaire de sélection
			echo ("
				<form action=\"Dossier_action.php\" method=\"post\">
					<label for=\"sel_nDossier\">Sélectionnez un dossier :</label>
					<select id=\"sel_nDossier\" name=\"nDossier\">
			");
			// création des options
			do {

				$nDossier = oci_result($curseur, 1);
				echo ("<option value=\"$nDossier\">$nDossier</option>");

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
	// on libère le curseur
	oci_free_statement($curseur);
	// travail à réaliser
	echo ("
		<p class=\"work\">
			Modifiez cet enchaînement de scripts afin d'afficher pour chaque dossier, en plus des informations déjà fournies, sa date d'émission et pour chacune des places associés, le nom, la forme, la catégorie et la date de l'épreuve'.
		</p>
	");

	include('pied.php');

?>
