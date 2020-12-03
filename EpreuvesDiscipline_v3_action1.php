<?php
	session_start();
	
	//recupere le numero du dossier choisie
	$_SESSION['dossiers'] = $_POST['dossier'];
	$doss = $_SESSION['dossiers'];
	
	$titre = "Choisissez la discipline pour le dossier $doss";
	
	include('entete.php');
	
	//requete pour afficher les numeros de dossier
	$requete = ("select distinct discipline from JO_INF245.LesBillets natural join JO_INF245.LesEpreuves where nDossier=:n");
	
	// analyse de la requete et association au curseur
	$curseur = oci_parse ($lien, $requete) ;
	
	// affectation de la variable
	oci_bind_by_name ($curseur,':n', $doss);
	
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
			echo "<p class=\"erreur\"><b>Aucune discipline pour ce dossier selectionner</b></p>" ;
		}
		else {
			// on affiche le formulaire de sélection
			echo ("
				<form action=\"EpreuvesDiscipline_v3_action.php\" method=\"post\">
				<label for=\"sel_discipline\">Sélectionnez une discipline :</label>
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
	
	include('pied.php');
?>
