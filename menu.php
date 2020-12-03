<?php
	session_start();
	$login = $_SESSION['login'];
	$motdepasse = $_SESSION['motdepasse'];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" dir="ltr">
<head>
   <title>Gestion de compétitions : Menu </title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="style.css" rel="stylesheet" media="all" type="text/css">
</head>

<!-- procedures et fonctions pour les mises a jour des JO
	 MC Fauvet, Janvier 2016 -->
<body>

<?php require_once ("utils.php");

// si l'une des variables globales est sans valeur, cela signifie
// que le navigateur n'accepte pas les cookies. Inutile de continuer
if (!isset ($login) or !isset ($motdepasse)) {
	$codeerreur = "problemevariables" ;
	echo LeMessage ($codeerreur) ;
}
else {
   include ("navigation.php");
?>

<h1>Bienvenue dans l’application JO !</h1>

      <?php if(isset($_SESSION['login'])) {
         echo '<p id="identif"> Vous êtes identifié-e avec l’identifiant ', $_SESSION['login'], '. <a href="connexion.php">Changer</a>.</p>';
      } else {
         echo '<p id="identif"> Peut-être que vous voulez vous <a href="connexion.php">identifier</a> ?</p>';
      } ?>

      <h2> Contenu des relations de la base de données </h2>
      <ul class="menu">
	      <li><a href="AfficherTablesFournies.php">Contenu des relations fournies </a> </li>
	      <li><a href="tables.php"> Relations appartenant au compte connecté </a></li>
      </ul>

      <h2> Requêtes fournies (observer le comportement et le code) sur la BD fournie </h2>
      <ul class="menu">
	      <li><a href="SkiAlpin.php"> Les épreuve(s) de Ski Alpin </a></li>
	      <li><a href="EpreuvesDiscipline.php"> Donner le nombre de billets achetés par le dossier No 2 pour les épreuves
                    d'une discipline donnée </a> </li>
      </ul>

      <h2> Requêtes à modifier sur la BD fournie</h2>
      <ul class="menu">
          <li><a href="Dossier.php">Afficher les détails d'un dossier  </a></li>
	      <li><a href="EpreuvesDiscipline_v2.php">
Donner le nombre de billets achetés par le dossier No 2 pour les épreuves
d'une discipline donnée <br />(version améliorée 1)</a></li>
	      <li><a href="EpreuvesDiscipline_v1.php">
Donner le nombre de billets achetés par le dossier No 2 pour les épreuves
d'une discipline donnée <br />(version améliorée 2)</a></li>
		  <li><a href="EpreuvesDiscipline_v3.php">
Donner le nombre de billets achetés par le dossier No 2 pour les épreuves
d'une discipline donnée <br />(version améliorée 3)</a></li>
      </ul>

      <h2> Requêtes à réaliser sur la BD fournie</h2>
      <ul class="menu">
	      <li><a href="EpreuvesVides.php">Afficher les épreuves sans billet vendu</a></li>
	      <li><a href="ResaEpreuves1.php">
Pour chaque dossier, la date d'émission du dossier, et pour chaque billet associé, <br/> les épreuves associées, leur numéro, leur nom, et leur date (version avec deux curseurs)
            </a></li>
            <li><a href="ResaEpreuves2.php">
Pour chaque dossier, la date d'émission du dossier, et pour chaque billet associé, <br/> les épreuves associées, leur numéro, leur nom, et leur date (version avec seul curseur)
            </a></li>
      </ul>

      <h2> Requêtes fournies (observer le comportement et le code) sur la BD à créer </h2>
      <ul class="menu">
	      <li><a href="Epreuve_add_v1.php">Une nouvelle épreuve de la discipline 'bob' est programmée le 29/02/2016 (version 1) </a> </li>
	      <li><a href="Epreuve_add_v2.php">Une nouvelle épreuve de la discipline 'bob' est programmée le 29/02/2016 (version 2) </a> </li>
	      <li><a href="Epreuve_add_v3.php">Une nouvelle épreuve de la discipline 'bob' est programmée le 29/02/2016 (version 3) </a> </li>
      </ul>

      <h2> Tâches à réaliser sur la BD à créer</h2>
      <ul class="menu">
		  <li><a href="GererEpreuves.php">Gérer les épreuves</a></li>
          <li><a href="GererEpreuvesScenario.php"> Voir le scénario type pour la
          gestion des épreuves </a></li>
<li><a href="Ventes.php">Gérer la vente de billets</a></li>
<li><a href="GererVentesScenario.php"> Voir le scénario type  pour la
gestion des ventes </a></li>
<li><a href="InscrireSportif.php"> Inscrire un sportif </a></li>
<li><a href="InscrireSportifScenario.php"> Voir le scénario type  pour la
gestion de l'inscriptions d'un sportif </a></li>
<li><a href="DemenagerSportif.php"> Déménager un sportif </a> </li>
<li><a href="DemenagerSportifScenario.php"> Voir le scénario type  pour la
gestion du déménagement d'un sportif </a></li>
      </ul>

<?php } ?>

<?php
// si l'une des variables globales est sans valeur, cela signifie
// que le navigateur n'accepte pas les cookies. Inutile de continuer
if (!isset ($login) or !isset ($motdepasse)) {
    $codeerreur = "problemevariables" ;
    echo LeMessage ($codeerreur) ;
}
else {
    include ("navigation.php");
    }
?>
