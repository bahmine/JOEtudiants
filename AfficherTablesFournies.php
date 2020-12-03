<?php

	$titre = 'Contenu des relations fournies';
	include('entete.php');

	// définition des relations
$lesRelations = array ("JO_INF245.LesBatiments", "JO_INF245.LesDisciplines", "JO_INF245.LesEpreuves", "JO_INF245.LesEquipes", "JO_INF245.LesInscriptions", "JO_INF245.LesLocataires", "JO_INF245.LesLogements", "JO_INF245.LesResultats", "JO_INF245.LesSportifs", "JO_INF245.LesBillets", "JO_INF245.LesDossiers_base", "JO_INF245.LesDossiers" );

// définition des attributs
$lesSchemas = array ("JO_INF245.LesBatiments"  => array("nomBat","numero", "rue", "ville"),
             "JO_INF245.LesDisciplines" => array ("discipline"),
		     "JO_INF245.LesEpreuves" => array("nEpreuve", "nomE", "forme", "discipline", "categorie", "nbs", "dateEpreuve"),
		     "JO_INF245.LesEquipes" => array("nEquipe", "nSportif"),
		     "JO_INF245.LesInscriptions" => array("nInscrit", "nEpreuve"),
		     "JO_INF245.LesLocataires" => array("nSportif", "nLogement", "nomBat"),
		     "JO_INF245.LesLogements" => array("nLogement", "capacite", "nomBat"),
		     "JO_INF245.LesResultats" => array("nEpreuve", "gold", "silver", "bronze"),
             "JO_INF245.LesSportifs" => array("nSportif", "nomS", "prenomS", "pays", "categorie", "dateNais"),
             "JO_INF245.LesBillets"  => array("nDossier", "nBillet","nEpreuve"),
             "JO_INF245.LesDossiers_base" => array("nDossier", "nUtil", "dateEmission"),
             "JO_INF245.LesDossiers" => array("nDossier", "nUtil", "dateEmission", "prix")
	);

	// pour chaque relation
	foreach ($lesRelations as $uneRelation) {
		// construction de la requête
		$requete = "select * from $uneRelation ORDER BY {$lesSchemas[$uneRelation][0]}";
		// analyse de la requete et association au curseur
		$curseur = oci_parse ($lien, $requete) ;
		// execution de la requete
		oci_execute ($curseur);
		if (!($row = oci_fetch_assoc ($curseur))) {
			// le resultat est vide
			echo "<p><b>La relation ".$uneRelation." est vide </b></p>" ;
		}
		else {
			// création de la table qui va servir a la mise en page du resultat
			echo "<p><table> <tr><th> ".$uneRelation." </th></tr><tr>" ;
			foreach ($lesSchemas[$uneRelation] as $unAttr)
				echo "<td><th> ".$unAttr." </th></td>";
			echo "</tr>";
			// Affichage du resultat (non vide)
			do {
				echo "<tr>";
				foreach ($lesSchemas[$uneRelation] as $unAttr) {
				  echo "<td> ".$row[strtoupper($unAttr)]." </td>";
				}
				echo "</tr>";
			} while ($row = oci_fetch_assoc ($curseur));
			echo "</table></p>";
		}
		oci_free_statement($curseur);
	}
	include('pied.php');
?>
