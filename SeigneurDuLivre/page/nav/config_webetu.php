<?php
//données pour webetu
$server = 'localhost';
$username = 'e50199u';
$password = 'C0llège_Ren&_C';
$database = 'e50199u';
// Connexion à la base de données
$connect = mysqli_connect($server, $username, $password, $database);
//si connexion échoue
if (!$connect) {
 error_log("Erreur de connexion : " . mysqli_connect_error());
 die("Une erreur est survenue. Veuillez réessayer plus tard.");
}
mysqli_set_charset($connect, 'utf8'); //encodage des caractères
?>