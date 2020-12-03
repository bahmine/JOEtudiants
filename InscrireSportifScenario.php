<?php
    session_start();
    $login = $_SESSION['login'];
    $motdepasse = $_SESSION['motdepasse'];

$titre = "Scénario pour l'inscription d'un sportif";
include('entete.php');
require_once ("utils.php");
    echo ("
          <p class=\"scenario\"> Gabrielle est la secrétaire chargée de l'inscription des délégations et des sportifs. Un sportif vient d'être sélectionné par sa délégation, il(elle) vient d'arriver sur le site. Gabrielle procède à l'enregistrement de ce sportif et à son affectation à un logement.
          L'inscription de ce sportif à des épreuves sera effectuée plus tard.</p>
          ");
include('pied.php');
?>
    