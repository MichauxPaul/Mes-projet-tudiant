<?php
require 'config_webetu.php';
session_start();

if (!isset($_SESSION['user_id'], $_POST['bk_code'], $_POST['note'])) {
    header('Location: espace_personnel.php');
    exit();
}

$ct_code = (int) $_SESSION['user_id'];
$bk_code = (int) $_POST['bk_code'];
$note = (int) $_POST['note'];

if ($note < 0 || $note > 100) {
    die("Note invalide (doit être entre 0 et 100).");
}

$check = mysqli_prepare($connect, "SELECT 1 FROM SDL_RATING WHERE BK_Code = ? AND CT_Code = ?");
mysqli_stmt_bind_param($check, 'ii', $bk_code, $ct_code);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);

if (mysqli_stmt_num_rows($check) > 0) {
    die("Vous avez déjà noté ce livre.");
}

$stmt = mysqli_prepare($connect, "INSERT INTO SDL_RATING (BK_Code, CT_Code, RG_Value) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'iii', $bk_code, $ct_code, $note);
mysqli_stmt_execute($stmt);

header('Location: espace_personnel.php');
exit();
