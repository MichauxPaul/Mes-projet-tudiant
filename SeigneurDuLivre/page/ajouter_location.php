<?php
require 'config_webetu.php';
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || !isset($_GET['id_livre'])) {
    echo "Non autorisé";
    exit;
}

$client_id = (int) $_SESSION['user_id'];
$livre_id = (int) $_GET['id_livre'];
$start = date('Y-m-d');
$end = date('Y-m-d', strtotime('+31 days'));

// Insère la facture, récupère l'ID généré automatiquement
mysqli_query($connect, "INSERT INTO SDL_BILL (BL_Date) VALUES (NOW())");
$bill_id = mysqli_insert_id($connect);

// Insère la location avec l'ID de la facture
$stmt = mysqli_prepare($connect, "INSERT INTO SDL_RENTAL (BK_Code, CT_Code, BL_Code, RL_Start, RL_End) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'iiiss', $livre_id, $client_id, $bill_id, $start, $end);
if (!mysqli_stmt_execute($stmt)) {
    echo "Erreur location : " . mysqli_error($connect);
    exit;
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
