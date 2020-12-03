<?php
	session_start();
    header('Content-Type: application/xhtml+xml; charset=utf-8');
    require_once ("utils.php");
    ?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
	   <title>Gestion des JO</title>
	   <meta charset="utf-8" />
	   <style>
	      h2 { text-align:left }
            h3 { text-align:center }
	   </style>
	   <link rel="stylesheet" href="style.css" />
	</head>
	<body>

<?php include_once("navigation.php");

?>

<h1> Gestion des JO </h1>

	   <h2> Connexion à la base de données </h2>
	   <?php
	   		if(isset($_SESSION['login'])) {
	      		echo '<p id="identif"> Vous êtes actuellement identifié-e avec l’identifiant ', $_SESSION['login'], '.</p>';
	   		}
	   ?>
<h3>
    <form method="post" action="index-action.php">
	      <p>
	         <label>
	            Votre nom :
	            <input type="text" name="login" />
	         </label>
	      </p>
	      <p>
	         <label>Votre mot de passe :
	            <input type="password" name="motdepasse" />
	         </label>
	      </p>

	      <p>
	         <input type="submit" value="Connexion" />
	         <input type="reset" value="Remise à zéro" />
	      </p>
	   </form>
	   <p><a href="menu.php">Menu principal</a></p>
    </h3>
</body>
</html>
