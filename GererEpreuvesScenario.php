<?php
    session_start();
    $login = $_SESSION['login'];
    $motdepasse = $_SESSION['motdepasse'];
    require_once ("utils.php");
    $titre= 'Scénario pour la gestion des épreuves';
    include('entete.php');
    echo ("
          <p class=\"scenario\"> Pascal est secrétaire de l'organisation, il se connecte à l'application afin de créer une
          nouvelle épreuve. L'IHM propose un formulaire permettant à ce secrétaire de saisir : le nom, la
          catégorie (féminin, masculin ou mixte), la forme (individuelle, par équipe ou par couple),
          la date et le prix associé à l'épreuve.
          La discipline peut être choisie dans la liste des disciplines existantes, ou si elle n'existe pas,
          l'IHM permet d'en créer un nouvelle.
          </p>");
    include('pied.php');
?>