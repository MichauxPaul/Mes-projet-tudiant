<?php
session_start();

// Supprimer toutes les variables de session
$_SESSION = [];

// Détruire la session
session_destroy();

// Rediriger vers l'accueil
header('Location: https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/index.php');
exit();
?>
