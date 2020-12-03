<?php

	// récupération des variables
	$nDossier = $_POST['nDossier'];

    
	$titre = "Détails du dossier numéro $nDossier";
	include('entete.php');

	// construction de la requete
	$requete = ("
		select dateEmission, E.nEpreuve, E.nomE, forme, categorie, to_char(dateEpreuve, 'Day, DD Month, YYYY'), count(*)
   from LesDossiers D join JO_INF245.LesBillets B on (D.nDossier=B.nDossier) join JO_INF245.LesEpreuves E on (B.nEpreuve=E.nEpreuve)
  where D.nDossier=:n
    group by dateEmission, E.nEpreuve, E.nomE, forme, categorie, dateEpreuve
    order by 1
	");

	// analyse de la requete et association au curseur
	$curseur = oci_parse ($lien, $requete) ;
	
	// affectation de la variable
	oci_bind_by_name ($curseur,':n', $nDossier);

	// execution de la requete
	$ok = oci_execute ($curseur);

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
			echo "<p class=\"erreur\"><b>Dossier inconnu</b></p>" ;

		}
		else {
            $dateEm = oci_result($curseur, 1) ;
			// on affiche la table qui va servir a la mise en page du resultat
                echo "<h3> Le dossier $nDossier a été émis le $dateEm, ses détails sont : </h3>" ;
			echo "<table><tr><th>Numéro épreuve</th><th> nom </th><th> forme </th><th> catégorie </th><th>date </th> <th>nombre de places</th></tr>" ;

			// on affiche un résultat et on passe au suivant s'il existe
			do {
                $numE = oci_result($curseur, 2) ;
                $nomE = oci_result($curseur, 3) ;
                $formeE = oci_result($curseur, 4) ;
                $catE = oci_result($curseur, 5) ;
                $dateE = oci_result($curseur, 6) ;
                $nbPlaces = oci_result($curseur, 7) ;
                echo "<tr><td>$numE</td><td>$nomE</td><td>$formeE</td><td>$catE</td><td>$dateE</td><td>$nbPlaces</td></tr>";

			} while (oci_fetch ($curseur));

			echo "</table>";
		}

	}

	// on libère le curseur
	oci_free_statement($curseur);

	include('pied.php');

?>
