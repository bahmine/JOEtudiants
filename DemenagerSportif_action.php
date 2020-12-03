<?php
	session_start();
	
	$titre='choisissez le nouvel logement';
	
	include('entete.php');
	
	
	
	//la categorie du sportif
	$pays = $_POST['pays'];
	
	//le pays du sportif
	$cat = $_POST['categorie'];
	
	//le numero du sportif
	$_SESSION['nSportif'] = $_POST['nSportif'];
	$nSportif = $_SESSION['nSportif'];
	//batiment du sportif
	$_SESSION['nomBat'] = $_POST['nomBat'];
	$nomBat = $_SESSION['nomBat'];
	
	$req =("select distinct nLogement, nomBat
			from( select nLogement, nomBat, (capacite-nR) as Restant
				  from( select nLogement, nomBat, capacite
						from LesLogements natural join LesLocataires natural join LesSportifs
						where pays=:p and categorieS=:c and nLogement not in (select nLogement from LesLocataires where nSportif=:s )
					  )	
				   natural join 
				   (
					select nLogement, nomBat, count(nSportif) as nR
					from LesLocataires
					where nLogement not in (select nLogement from LesLocataires where nSportif=:s )
					group by nomBat, nLogement
				   )
			)
			where Restant>0
		  ");

		// analyse de la requete et association au curseur
		$curseur = oci_parse ($lien, $req) ;
		
		//affectation de la variable
		oci_bind_by_name($curseur, ':p', $pays);
		oci_bind_by_name($curseur, ':c', $cat);
		oci_bind_by_name($curseur, ':s', $nSportif);
		// execution de la requete
		$ok = oci_execute ($curseur) ;
		
		if($ok) { 
			
			// oci_execute a réussi, on fetch sur le premier résultat
			$res = oci_fetch ($curseur);
			if (!$res) {
				// il n'y a aucun résultat
				echo ("<p class=\"erreur\"><b>Aucun Logement Disponible</b></p>
						$pays $cat $nSportif" );
			}
			else {
				// on affiche le formulaire de sélection
				echo ("<form action=\"DemenagerSportif_action1.php\" method=\"POST\">
					<select id=\"sel_discipline\" name=\"logement\">
				");
			// création des options
			do {
				$nLogement = oci_result($curseur, 1);
				$nomBat = oci_result($curseur, 2);
				echo ("<option value=\"$nLogement\">$nLogement $nomBat</option> ");

				} while ($res = oci_fetch ($curseur));
			echo ("
					</select><br /><br />
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
