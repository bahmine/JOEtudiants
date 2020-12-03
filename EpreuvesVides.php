<?php
$titre = 'Affichage des épreuves sans billets vendus';
include('entete.php');

//requete 
/*
$requete = ("SELECT distinct nomE
		     FROM JO_INF245.LesEpreuves 
		     WHERE nomE NOT IN (SELECT nomE FROM JO_INF245.LesBillets natural join JO_INF245.LesEpreuves)");*/

 $requete = ("SELECT nEpreuve, nomE, dateEpreuve, discipline, categorie
		     FROM JO_INF245.LesEpreuves 
		     MINUS 
		     SELECT nEpreuve, nomE, dateEpreuve, discipline, categorie FROM JO_INF245.LesBillets natural join JO_INF245.LesEpreuves");
 
 // analyse de la requete et association au curseur
	$curseur = oci_parse ($lien, $requete) ;

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
			echo "<p class=\"erreur\"><b>Aucune epreuve sans billet</b></p>" ;

		}
		else {
            echo "<table><tr><th>Numéro Epreuve</th><th> nom Epreuve</th><th>Discipline</th><th>Categorie</th><th>dateEpreuve</th></tr>" ;

			// on affiche un résultat et on passe au suivant s'il existe
			do {
                $nEpreuve = oci_result($curseur, 1) ;
                $nomE = oci_result($curseur, 2) ;
                $dateE = oci_result($curseur, 3);
                $disciplineE = oci_result($curseur, 4) ;
                $categorieE = oci_result($curseur, 5) ;
                echo "<tr><td>$nEpreuve</td><td>$nomE</td><td>$disciplineE</td><td>$categorieE</td><td>$dateE</td></tr>";

			} while (oci_fetch ($curseur));

			echo "</table>";
		}

	}

	// on libère le curseur
	oci_free_statement($curseur);
          
include('pied.php');
?>
