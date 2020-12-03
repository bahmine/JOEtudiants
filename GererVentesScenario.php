<?php
    session_start();
    $login = $_SESSION['login'];
    $motdepasse = $_SESSION['motdepasse'];

require_once ("utils.php");

    $titre = "Scénario pour la gestion des ventes";
    include('entete.php');
    echo ("
          <p class=\"scenario\"> Vincent est un utilisateur de l'application. Il y
          accède afin d'acheter des places à des épreuves à venir. Il peut supprimer des places déjà achetées au cours de la transaction (ou session). Il peut aussi en ajouter pour une épreuve pour laquelle il a déjà des places. Il peut aussi en acheter pour 
          d'autres épreuves.
          Il constitue ainsi son panier.
          
          Lorsque Vincent valide son panier, terminant ainsi la transaction, l'application demande une adresse où envoyer les tickets correspondants. Si Vincent quitte l'application, où si un autre utilisateur se connecte, avant que Vincent ne valide son panier, celui-ci est perdu (il n'est pas sauvegardé).</p>
     ");
    include('pied.php');
 ?>
    