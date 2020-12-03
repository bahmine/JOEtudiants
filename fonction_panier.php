<?php
 session_start ();
//on vérifie si le panier existe,sinon on le crée
 function creepanier () {
  if (!isset($_SESSION['panier'])) {
		//initialisation du panier
		$_SESSION['panier'] = array();
		/*subdivision du panier*/
		$_SESSION['panier']['numE'] = array ();
		$_SESSION['panier']['forme'] = array();
		$_SESSION['panier']['nomE'] = array();
		$_SESSION['panier']['dateE'] = array();
		$_SESSION['panier']['categ'] = array();
		$_SESSION['panier']['prix'] = array ();
		$_SESSION['panier']['nbr'] = array();
	} 
	return true;
 }
//on ajoute dans le panier le contenu de select
  function ajout($select) {
   
	  if (creepanier()) {
		  //Si l'épreuve existe on augmente juste le nombre
		  $pos = array_search($select['numE'],$_SESSION['panier']['numE']);
		  if ($pos !== false) {
			  //on augmente le nombre qu'il y a de cette épreuve;
			 // echo $_SESSION['panier']['nbr'][$pos]."<br/>";
			   $_SESSION['panier']['nbr'][$pos] += 1;  
		  } else {
			  $select['nbr'] = 1;
			  //on ajoute l'épreuve comme elle existe pas
	          array_push ($_SESSION['panier']['numE'],$select['numE']);
	          array_push($_SESSION['panier']['forme'],$select['forme']);
	          array_push($_SESSION['panier']['nomE'],$select['nomE']);
	          array_push($_SESSION['panier']['dateE'],$select['dateE']);
	          array_push($_SESSION['panier']['categ'],$select['categ']);
	          array_push($_SESSION['panier']['prix'],$select['prix']);
	          array_push($_SESSION['panier']['nbr'],$select['nbr']);
		  }
	  } else {
		  echo "<p class=\"erreur\"><b> IL y a un problème veuillez contactez l'administrateur du site </b></p>" ;
	  }
  
  } 
  //calcul du montant total dans le panier
  function montantTot () {
	  $montant = 0;
	  for ($i = 0; $i < count ($_SESSION['panier']['numE']);$i ++) {
		  $montant += $_SESSION['panier']['nbr'][$i] * $_SESSION['panier']['prix'][$i]; 
	  }
	  return $montant;
  }
  //fonction d'affichage du panier
  function afficher_panier () {
	  //lien pour vider le panier
	  //nbre d'épreuves différentes
	  $nbrE = count ($_SESSION['panier']['numE']);
	  if ($nbrE <= 0) {
		  echo "<p class=\"erreur\">Votre panier est Vide</p>";
	  } else {
		  $total = 0;
		  echo "<table>
		  <tr><td colspan =\"8\"></td><td><a href=\"vider.php\">Vider Mon panier</a></td></tr>
		  <tr><td colspan =\"8\"></td><td><a href=\"Ventes.php\">Ajouter une nouvelle Epreuve</a></td></tr>
		    <tr>
		     <td>N° Epreuve</td> <td>Nom Epreuve</td><td>Forme</td>
		     <td>Date</td><td>Categorie</td><td>Prix Unitaire</td>
		     <td>Nombre de Billets</td><td>Prix total Par Epreuve </td>
		    </tr>
		  ";
		      for ($i = 0; $i < $nbrE ; $i ++) {
				  $total = $total + $_SESSION['panier']['nbr'][$i];
				  echo "<tr>";
				   echo ("
				     <td>".$_SESSION['panier']['numE'][$i]."</td>
				     <td>".$_SESSION['panier']['nomE'][$i]."</td>
				     <td>".$_SESSION['panier']['forme'][$i]."</td>
				     <td>".$_SESSION['panier']['dateE'][$i]."</td>
				     <td>".$_SESSION['panier']['categ'][$i]."</td>
				     <td>".$_SESSION['panier']['prix'][$i]." €</td>
				     <td>".$_SESSION['panier']['nbr'][$i]."</td>
				     <td>".$_SESSION['panier']['nbr'][$i]*$_SESSION['panier']['prix'][$i]." €</td>
				     <td><a href=\"supprimer.php?id=".$_SESSION['panier']['numE'][$i]."\">Supprimer L'Epreuve</a></td>
				   ");
				  echo "</tr>";
			  }
			  $montant = montantTot ();
			  echo ("<tr>
			  <td colspan=\"6\">Nombre total d'Epreuve différentes</td><td>$nbrE</td><td></td>
			  </tr>
			  <tr>
			    <td colspan=\"6\">Total Epreuve</td><td>$total</td><td></td>
			  </tr>
			  <tr>
			   <td colspan=\"7\">Motant TOTAL</td><td>$montant €</td>
			  </tr>
			  ");
		  echo "</table>";
		  echo ("
		      
		       <form action =\"valid.php\" method=\"POST\">
		       <label for=\"sel_nDossier\">Votre Email pour la confirmation du paiement</label><input type=\"email\" name=\"mail\" required=\"required\"/>
		         <br/>	
		         <input type=\"submit\" value=\"Acheter ces Places\"/>
		         <input type=\"reset\" value=\"Annuler\"/>
		       </form>
		      
		  ");
	  }
  }
  //fonction de suppression d'un article dans le panier
  function supprimerEpreuve ($numE) {
	  if (creepanier ()) {
		  //Nous allons faire recours à un tableau temporaire
		$tmp = array ();
		$tmp['numE'] = array ();
		$tmp['forme'] = array();
		$tmp['nomE'] = array();
		$tmp['dateE'] = array();
		$tmp['categ'] = array();
		$tmp['prix'] = array ();
		$tmp['nbr'] = array();
		for ($i = 0 ; $i < count ($_SESSION['panier']['numE']);$i ++) {
			if ($_SESSION['panier']['numE'][$i] !== $numE)
			{
				array_push( $tmp['numE'],$_SESSION['panier']['numE'][$i]);
				array_push( $tmp['forme'],$_SESSION['panier']['forme'][$i]);
				array_push( $tmp['nomE'],$_SESSION['panier']['nomE'][$i]);
				array_push( $tmp['dateE'],$_SESSION['panier']['dateE'][$i]);
				array_push( $tmp['categ'],$_SESSION['panier']['categ'][$i]);
				array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
				array_push( $tmp['nbr'],$_SESSION['panier']['nbr'][$i]);
			}
		}
		//on affecte le contenu du panier temporaire dans notre panier principale
		$_SESSION['panier'] =  $tmp;
		//On efface notre panier temporaire
        unset($tmp);
	  } else {
		  echo "<p class=\"erreur\">Erreur réessyer ou contacter l'aministrateur</p>";
	  }
  }
  //fonction pour vider le panier c'est à dire vider le contenu de la session panier
  function viderpanier () {
	  //si le panier existe on la vide sinon on fait rien
	  unset ($_SESSION['panier']);
  }
?>

