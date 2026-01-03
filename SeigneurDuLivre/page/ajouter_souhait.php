<?php
require 'config_webetu.php';
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || !isset($_GET['ajouter_souhait'])) {
    echo "Non autorisé";
    exit;
}

$client_id = (int) $_SESSION['user_id'];
$livre_id = (int) $_GET['ajouter_souhait'];

$check = mysqli_prepare($connect, "SELECT 1 FROM SDL_WISHLIST WHERE CT_Code = ? AND BK_Code = ?");
mysqli_stmt_bind_param($check, 'ii', $client_id, $livre_id);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);

if (mysqli_stmt_num_rows($check) === 0) {
    $insert = mysqli_prepare($connect, "INSERT INTO SDL_WISHLIST (CT_Code, BK_Code) VALUES (?, ?)");
    mysqli_stmt_bind_param($insert, 'ii', $client_id, $livre_id);
    if (!mysqli_stmt_execute($insert)) {
        echo "Erreur insert : " . mysqli_error($connect);
        exit;
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;