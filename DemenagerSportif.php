<?php
	session_start();
	$titre = 'Demenager Un Sportif';
	
	include('entete.php');
	
	//on verifie si le sportif saisie existe
	
	
	
	echo("
		<form action=\"DemenagerSportif.php\" method=\"POST\">
		
				<label for=\"sel_nSportif\">Donnez le numero du Sportif :</label>
				<input type=\"number\" name=\"nSportif\" placeholder=\"numero du Sportif\" required=\"required\" autocomplete=\"off\" min=\"0\"/>
				
          <br /><br />
          <input type=\"submit\" value=\"Valider\" />
          <input type=\"reset\" value=\"Annuler\" />
          </form>
		");

	$nSportif = $_POST['nSportif'];
	
	if(isset($nSportif))
	{
			$req = ("select * from LesSportifs natural join LesLocataires where nSportif = :n");
			
			//analyse de la requete et assoiation au curseur
			$curseur = oci_parse($lien, $req);
			//affectation de la variable
			oci_bind_by_name($curseur, ':n', $nSportif);
			//execution de la requete
			$ok=oci_execute($curseur);
			if($ok)
			{
				$res=oci_fetch($curseur);
			
				if($res)
				{
					$nSpo = oci_result($curseur, 1);
					$nom = oci_result($curseur, 2);
					$prenom = oci_result($curseur, 3);
					$pays = oci_result($curseur, 4);
					$categorie = oci_result($curseur, 5);
					$dateN = oci_result($curseur, 6);
					$nLogement = oci_result($curseur, 7);
					$nomBat = oci_result($curseur, 8);
					
					echo("<form action=\"DemenagerSportif_action.php\" method=\"POST\">
							<table>
							 <tr><th>Numero</th><td>$nSpo <input type=\"hidden\" value=\"$nSpo\" name=\"nSportif\"/> </td></tr>
							 <tr><th>Nom</th><td>$nom <input type=\"hidden\" value=\"$nom\" name=\"nom\"/> </td></tr>
							 <tr><th>Prenom</th><td>$prenom <input type=\"hidden\" value=\"$prenom\" name=\"prenom\"/></td></tr>
							 <tr><th>Pays</th><td>$pays <input type=\"hidden\" value=\"$pays\" name=\"pays\"/></td></tr>
							 <tr><th>Categorie</th><td>$categorie <input type=\"hidden\" value=\"$categorie\" name=\"categorie\"/></td></tr>
							 <tr><th>Date Naissance </th><td>$dateN <input type=\"hidden\" value=\"$dateN\" name=\"dateN\"/></td></tr>
							 <tr><th>Numero Logement </th><td>$nLogement <input type=\"hidden\" value=\"$nLogement\" name=\"nLogement\"/></td></tr>
							 <tr><th>Batiment </th><td>$nomBat <input type=\"hidden\" value=\"$nomBat\" name=\"nomBat\"/></td></tr>
							</table>
							
							<input type=\"submit\" value=\"Changer de Logement\" />
							<input type=\"reset\" value=\"Annuler\" /> 
						  </form>");
				}else echo("<p class=\"erreur\"> Ce Sportif nexiste pas dans la base de données</p> ");
			}
			
			oci_free_statement($curseur);
	}

	include ('pied.php');
?>

