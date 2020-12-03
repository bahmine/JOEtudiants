<?php

	$titre = 'Liste des épreuves associées au dossier 2 pour une discipline donnée, et nombre de billets pour chacune';
	include('entete.php');

	// affichage du formulaire
	echo ("
		<form action=\"EpreuvesDiscipline_action.php\" method=\"POST\">
			<label for=\"inp_discipline\">Veuillez saisir une discipline :</label>
			<input type=\"text\" name=\"discipline\" />
			<br /><br />
			<input type=\"submit\" value=\"Valider\" />
			<input type=\"reset\" value=\"Annuler\" />
		</form>
	");

	include('pied.php');

?>
