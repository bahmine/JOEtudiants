<?php
	$titre = 'Liste des épreuves associées au dossier 2 pour une discipline donnée, et nombre de billets pour chacune';
	include('entete.php');
    echo ("
          <form action=\"EpreuvesDiscipline_v1_action.php\" method=\"POST\">
          <label for=\"inp_discipline\">Veuillez choisir une discipline :</label>
          <select id=\"sel_discipline\" name=\"discipline\">
			<option value=\"Ski alpin\">Ski alpin</option>
			<option value=\"Ski de fond\">Ski de fond</option>
			<option value=\"Patinage artistique\">Patinage artistique</option>
			<option value=\"Sports de glace\">Sports de glace</option>
          </select>
          <br /><br />
          <input type=\"submit\" value=\"Valider\" />
          <input type=\"reset\" value=\"Annuler\" />
          </form>
          ");
   
// travail à réaliser
echo (" <p class=\"work\">
      Améliorez l'interface utilisateur en proposant, à la place du champ de saisie libre, un choix dans une liste contenant toutes les disciplines (sous forme de boite de sélection ou de boutons radio).
      Cette fois-ci, la liste sera extraite de la base de données. </p>
");
                                
	include('pied.php');
?>
