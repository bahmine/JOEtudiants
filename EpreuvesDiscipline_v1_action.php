<?php

//recuperation des variables
$discipline = $_POST['discipline'];


	$titre = "Nombre de place pour la discipline $discipline du dossier 2";
	include('entete.php');
	
	
//requete
$requete = ("select nEpreuve,nomE,count (nBillet) FROM JO_INF245.LesEpreuves natural join
 JO_INF245.LesBillets B where nDossier = 2 and discipline =:d group by 
 nEpreuve,nomE");
 
 // analyse de la requete et association au curseur
	$curseur = oci_parse ($lien, $requete) ;
	
	// affectation de la variable
	oci_bind_by_name ($curseur,':d', $discipline);

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
			echo "<p class=\"erreur\"><b>Aucune epreuve associer a l'epreuve selectionner</b></p>" ;

		}
		else {
            // on affiche la table qui va servir a la mise en page du resultat
			echo "<table><tr><th>Numéro épreuve</th><th> nom Epreuve</th><th> nombre de Billets </th></tr>" ;

			// on affiche un résultat et on passe au suivant s'il existe
			do {
                $nEpreuve = oci_result($curseur, 1) ;
                $nomE = oci_result($curseur, 2) ;
                $nombreBillet = oci_result($curseur, 3) ;
                echo "<tr><td>$nEpreuve</td><td>$nomE</td><td>$nombreBillet</td></tr>";

			} while (oci_fetch ($curseur));

			echo "</table>";
		}

	}

	// on libère le curseur
	oci_free_statement($curseur);
	
	
 include('pied.php');
?>
