<?php

	$titre = 'Liste des épreuves associées au dossier 2 pour une discipline donnée, et nombre de billets pour chacune';
	include('entete.php');

	$requete = (" SELECT distinct discipline FROM JO_INF245.LesEpreuves");


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
				<form action=\"EpreuvesDiscipline_v1_action.php\" method=\"post\">
					<label for=\"sel_discipline\">Sélectionnez un dossier :</label>
					<select id=\"sel_discipline\" name=\"discipline\">
			");
			// création des options
			do {

				$disc = oci_result($curseur, 1);
				echo ("<option value=\"$disc\">$disc</option>");

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
			Améliorez l'interface utilisateur en proposant, à la place du champ de saisie libre, un choix dans une liste contenant toutes les disciplines (sous forme de boite de sélection ou de boutons radio).<br />Cette liste sera codée \"en dur\".
		</p>
	");

	include('pied.php');

?>
