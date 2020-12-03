<?php

	$titre = 'Liste des épreuves associées à un dossier donné pour une discipline donnée, et nombre de billets pour chacune';
	include('entete.php');
	
	//requete pour afficher les numeros de dossier
	$requete = ("select nDossier from LesDossiers order by 1");
	
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
				<form action=\"EpreuvesDiscipline_v3_action1.php\" method=\"post\">
					<label for=\"sel_dossier\">Sélectionnez un dossier :</label>
					<select id=\"sel_dossier\" name=\"dossier\">
			");
			// création des options
			do {

				$dos = oci_result($curseur, 1);
				echo ("<option value=\"$dos\">$dos</option>");

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
			Ajoutez une étape à cet enchaînement de scripts, de façon à obtenir le fonctionnement suivant :
			<ul>
				<li><b>Etape 1 :</b> un formulaire nous demande de choisir un numéro de dossier dans une liste extraite de la base de données</li>
				<li><b>Etape 2 :</b> pour le numéro de dossier choisi, un formulaire nous demande de sélectionner une discipline dans une liste qui ne contiendra que les disciplines concernées par le numéro de dossier demandé</li>
				<li><b>Etape 3 :</b> affichage de la liste des billets correspondant à la discipline et au numéro de dossier sélectionnés, et pour chacun nombre de places. </li>
			</ul>
		</p>
	");

	include('pied.php');

?>
