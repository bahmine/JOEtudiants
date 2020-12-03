<?php

$titre = 'Gestion des Epreuves';

include('entete.php');

//test sur les erreurs, 1 si rien, 0 si oui
$test=1;

/*recuperation des variables*/
//numero de l'epreuve
$nEpreuve = $_POST['numE'];

//nom de l'epreuve
$nomE = $_POST['nomE'];

//forme
$formeE = $_POST['formeE'];

//categorie
$categorieE = $_POST['categorieE'];

//date
$dateE = $_POST['dateE'];

//nombre de sportif si par equipe
$nbsE = $_POST['nbs'];


//prix
$prixE = floatval($_POST['prix']);

//Discipline
$discE = $_POST['discipline'];

/*traitement des variables*/
if($formeE == 'par equipe' || $formeE == 'par couple' || $formeE == 'individuelle')  
{
	if($formeE =='par equipe')
	{
		if($nbsE=="")
		{
			echo "<p class=\"erreur\">vous avez choisie la forme <b>$formeE</b>, vous devez obligatoirement saisir un nombre</p>"; 
					$test=0;
		}
	}
	if($formeE=='par couple')
	{
		if($nbsE!=2)
		{
			echo "<p class=\"erreur\">vous avez choisie la forme <b>$formeE</b>, le nombre de sportif doit etre egal a 2</p>";
				$test=0;
		}
		if($categorieE != 'mixte')
		{
			echo "<p class=\"erreur\">vous avez choisie la forme <b>$formeE</b>, la categorie doit etre de type Mixte</p>";
			$test=0;
		}
	}
	if($formeE =='individuelle')
	{
		if($nbsE!="")
		{
			echo "<p class=\"erreur\">vous avez choisie la forme <b>$formeE</b>, le nombre de sportif doit etre vide</p>";
			echo $nbsE;
					$test=0;
		}
	}
	
}

if($discE == 'autre')
{
	//nouvelle discipline si autre
		$discE = $_POST['newDisc'];
		
		if($discE == "")
		{
				 echo("<p class=\"erreur\">veuillez saisir la nouvelle discipline </p>");
				 $test=0;
		}
		else
		{
			if($test==1)
			{
				//ajout de la nouvelle discipline
				$requete = (" INSERT INTO LesDisciplines(discipline) values ('$discE') ");

				//test de la requete
				$curseur=oci_parse($lien, $requete);

				//execution de la requete
				$ok= @oci_execute ($curseur, OCI_NO_AUTO_COMMIT);
  
				//test de l'execution	
				if (!$ok) {
					// oci_execute a echoue, on affiche l'erreur
					$error_message = oci_error($curseur);
					echo "<p class=\"erreur\">{$error_message['message']}</p>";
					echo "<p class=\"erreur\">Erreur lors de l'ajout de la nouvelle discipline</p>";
					oci_rollback($lien);
				}else {
						echo "<p class=\"ok\">Nouvelle discipline ajouter</p>"; 
						oci_commit($lien);

						//on libere le curseur
						oci_free_statement($curseur);
					  }
			}
		}
}

if($test==1)
{	
	
	//insertion des donnees du formulaire
	$requete = (" INSERT INTO LesEpreuves values ($nEpreuve, '$nomE', '$formeE', '$discE', '$categorieE', '$nbsE', to_date('$dateE','yyyy/mm/dd'), $prixE) ");

				//test de la requete
				$curseur=oci_parse($lien, $requete);

				//execution de la requete
				$ok= @oci_execute ($curseur, OCI_NO_AUTO_COMMIT);
  
				//test de l'execution	
				if (!$ok) {
					// oci_execute a echoue, on affiche l'erreur
					$error_message = oci_error($curseur);
					echo "<p class=\"erreur\">{$error_message['message']}</p>";
					echo "<p class=\"erreur\">Erreur lors de l'ajout de la nouvelle epreuve</p>";
					oci_rollback($lien);
				}else {
						echo "<p class=\"ok\">Nouvelle Epreuve Ajouter</p>"; 
						oci_commit($lien);
						echo "<p class=\"ok\"><a href=\"GererEpreuves.php\">Ajouter une nouvelle epreuve</a></p>"; 
						//on libere le curseur
						oci_free_statement($curseur);
					  }
}

include('pied.php');

?> 
