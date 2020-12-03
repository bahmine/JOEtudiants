<?php
    session_start();
    $login = $_SESSION['login'];
    $motdepasse = $_SESSION['motdepasse'];
    require_once ("utils.php");
    $titre= "Scénario pour le déménagement d'un sportif";
    include('entete.php');
    echo ("
          <p class=\"scenario\"> Gabrielle est la secrétaire chargée de l'inscription des délégations et des sportifs. Un sportif déjà enregistré 
          désire cajnger de logement. Gabrielle procède à l'affectation de ce sportif à un autre logement.
          </p>
        ");
    include('pied.php');
?>