<?php
session_start();

// Supprimer toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Redirection vers la page de connexion ou l'accueil
header("Location: entre.php"); // tu peux changer "entre.php" par "login.php" ou "index.php"
exit();
?>
