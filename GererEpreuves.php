<?php
	$titre = 'Menu Epreuves';
	
	include('entete.php');
			
	//recuperer le dernier numero depreuve
	$req = ("select max(nEpreuve)+1 from LesEpreuves ");
	//analyse de la requete et assoiation au curseur
	$curseur = oci_parse($lien, $req);
	//execution de la requete
	$ok=oci_execute($curseur);
	if($ok)
	{
			$res=oci_fetch($curseur);
			if($res)
			{
				$nE = oci_result($curseur, 1);
			}
	}
	
	echo("
		<form action=\"GererEpreuves_action.php\" method=\"POST\">
		
			<table border=\"0\">
				<tr><td colspan=\"2\"><input type=\"hidden\" name=\"numE\" value=\"$nE\"/></td></tr>");
				
				//on libere le curseur
				oci_free_statement($curseur);
				
			echo("
				<tr><td>Nom de L'epreuve</td><td><input type=\"text\" name=\"nomE\" placeholder=\"nom de l'epreuve\" required=\"required\" autocomplete=\"off\"/></td></tr>
				<tr><td rowspan=\"3\"> Forme </td> <td> <input type=\"radio\" name=\"formeE\" value=\"par equipe\" /> Par Equipe </td></tr>
					<tr><td> <input type=\"radio\" name=\"formeE\" value=\"individuelle\" checked=\"checked\"/> Individuelle </td></tr>
					<tr><td> <input type=\"radio\" name=\"formeE\" value=\"par couple\" /> Par Couple </td></tr>
				<tr><td rowspan=\"3\"> Categorie </td> <td> <input type=\"radio\" name=\"categorieE\" value=\"feminin\" /> Feminin </td></tr>
					<tr><td> <input type=\"radio\" name=\"categorieE\" value=\"masculin\" checked=\"checked\"/> Masculin </td></tr>
					<tr><td> <input type=\"radio\" name=\"categorieE\" value=\"mixte\" /> Mixte </td></tr>
				<tr><td> DATE </td> <td> <input type=\"date\" name=\"dateE\" required=\"required\"/> </td></tr>
				<tr><td> nbr de Sportif </td> <td> <input type=\"number\" name=\"nbs\" default=\"NULL\" min=\"0\" placeholder=\"vide si individuelle\"/> </td></tr>
				<tr><td> Prix </td> <td> <input type=\"number\" name=\"prix\" placeholder=\"1.0\" step=\"0.01\" min=\"0\" required=\"required\"/> </td></tr>
				<tr><td> Discipline </td> <td> ");  
				
		//extraction des disciplines dans la base de données
		$req = ("select discipline from LesDisciplines");
		// analyse de la requete et association au curseur
		$curseur = oci_parse ($lien, $req) ;
		// execution de la requete
		$ok = oci_execute ($curseur) ;
	
		if($ok) {
			// oci_execute a réussi, on fetch sur le premier résultat
			$res = oci_fetch ($curseur);
			if (!$res) {
				// il n'y a aucun résultat
				echo "<p class=\"erreur\"><b>Aucune discipline pour ce dossier selectionner</b></p>" ;
			}
			else {
			// on affiche le formulaire de sélection
			echo ("
					<select id=\"sel_discipline\" name=\"discipline\">
			");
			// création des options
			do {
				$disc = oci_result($curseur, 1);
				echo ("<option value=\"$disc\">$disc</option>");

			} while ($res = oci_fetch ($curseur));
				echo("<option value=\"autre\">Autre</option>");
			echo ("
					</select>
			");
		}
	}
	// on libère le curseur
	oci_free_statement($curseur);
	echo("	</td></tr>	
			<tr><td colspan=\"2\">Si autre, saisissez la nouvelle discipline <input type=\"text\" name=\"newDisc\" placeholder=\"nom de la Discipline\" /></td></tr>
			</table>
          <br /><br />
          <input type=\"submit\" value=\"Valider\" />
          <input type=\"reset\" value=\"Annuler\" />
          </form>
		");

	include ('pied.php');
?>
