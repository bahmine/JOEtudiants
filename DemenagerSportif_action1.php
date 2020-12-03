<?php
	session_start();
	
	include('entete.php');
	
	$newLogement = $_POST['logement'];
	
	
	$nSportif = $_SESSION['nSportif'];
	
	$req = (" update LesLocataires
			  set nLogement=:n
			  where nSportif = :ns			
	");
	
	//analyse de la requete et assoiation au curseur
	$curseur = oci_parse($lien, $req);
	//affectation de la variable
	oci_bind_by_name($curseur, ':n', $newLogement);
	oci_bind_by_name($curseur, ':ns', $nSportif);
	//execution de la requete
	$ok=oci_execute($curseur);
	
	if(!$ok) { 
			echo("<p class=\"erreur\">Erreur lors de mise a jour du nouvel batiment</p>");
					$error_message = oci_error($curseur);
			echo("<p class=\"erreur\">{$error_message['message']}</p>");
		} else { 
				echo("<p class=\"ok\"> Mise a jour effectuer avec succes</p>");
				echo("<p class=\"ok\"> <a href=\"menu.php\">Menu Principal</a></p>");
				echo("<p class=\"ok\"> <a href=\"DemenagerSportif.php\">Demenager Sportif</a></p>");
			}

	oci_free_statement($curseur);

	
	
	
	include('pied.php');
?>
