<?php
session_start();
require 'config_webetu.php';

if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit();
}

$user_email = $_SESSION['user_email'];
$user_query = mysqli_prepare($connect, "SELECT CT_Code, CT_Firstname, CT_Surname FROM SDL_CLIENT WHERE CT_Email = ?");
mysqli_stmt_bind_param($user_query, 's', $user_email);
mysqli_stmt_execute($user_query);
$user_result = mysqli_stmt_get_result($user_query);
$user = mysqli_fetch_assoc($user_result);
$ct_code = $user['CT_Code'];
$prenom = $user['CT_Firstname'];
$nom = $user['CT_Surname'];

if (isset($_GET['supprimer_souhait'])) {
    $bk_code = (int) $_GET['supprimer_souhait'];
    $delete_query = mysqli_prepare($connect, "DELETE FROM SDL_WISHLIST WHERE CT_Code = ? AND BK_Code = ?");
    mysqli_stmt_bind_param($delete_query, 'ii', $ct_code, $bk_code);
    mysqli_stmt_execute($delete_query);
    header('Location: espace_personnel.php');
    exit();
}

$locations_en_cours = mysqli_query($connect, "
    SELECT B.BK_Name, B.BK_Visual, R.RL_Start, R.RL_End, B.BK_Cost, B.BK_Code
    FROM SDL_RENTAL R
    JOIN SDL_BOOK B ON R.BK_Code = B.BK_Code
    WHERE R.CT_Code = $ct_code
    AND R.RL_End > NOW()");

if (!$locations_en_cours) {
    die("Erreur SQL pour locations en cours : " . mysqli_error($connect));
}

$locations_passees = mysqli_query($connect, "
    SELECT B.BK_Name, B.BK_Visual, R.RL_Start, R.RL_End, B.BK_Cost
    FROM SDL_RENTAL R
    JOIN SDL_BOOK B ON R.BK_Code = B.BK_Code
    WHERE R.CT_Code = $ct_code
    AND R.RL_End <= NOW()");

if (!$locations_passees) {
    die("Erreur SQL pour locations passées : " . mysqli_error($connect));
}

$souhaits = mysqli_query($connect, "
  SELECT W.BK_Code, B.BK_Visual AS image, B.BK_Cost AS prix, B.BK_Name AS titre, 1 AS disponible
  FROM SDL_WISHLIST W
  JOIN SDL_BOOK B ON W.BK_Code = B.BK_Code
  WHERE W.CT_Code = $ct_code");

if (!$souhaits) {
    die("Erreur SQL pour souhaits : " . mysqli_error($connect));
}

$factures = []; // Désactivé car SDL_FACTURE n'existe pas
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../logo/logo_SDL.webp" type="image/webp">
  <title>Espace personnel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container">
<?php require 'nav/nav.php'; ?>
  <h1>Bonjour <?= "$prenom $nom" ?> <small class="text-muted">Vous voici dans votre espace personnel</small></h1>
  <hr />

  <div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
          Vos locations en cours
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show">
        <div class="accordion-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Livre</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Prix</th>
                <th>Lire</th>
                <th>Noter</th>
              </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($locations_en_cours)) { ?>
              <tr>
                <td><img src="../media/livre/<?= $row['BK_Visual'] ?>" width="50"></td>
                <td><?= $row['RL_Start'] ?></td>
                <td><?= $row['RL_End'] ?></td>
                <td><?= $row['BK_Cost'] ?> €</td>
                <td><a href="../media/livre/<?= $row['BK_Visual'] ?>" target="_blank">Lire</a></td>
                <td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#noter<?= $row['BK_Code'] ?>"> Noter </button></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?php
mysqli_data_seek($locations_en_cours, 0);
while($row = mysqli_fetch_assoc($locations_en_cours)) {
?>
<div class="modal fade" id="noter<?= $row['BK_Code'] ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="noter_livre.php">
        <div class="modal-header">
          <h5 class="modal-title">Notez le livre : <?= htmlspecialchars($row['BK_Name']) ?></h5>
        </div>
        <div class="modal-body">
          <input type="hidden" name="bk_code" value="<?= $row['BK_Code'] ?>">
          <div class="mb-3">
            <label class="form-label">Note (0 à 100)</label>
            <input type="number" name="note" class="form-control" min="0" max="100" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Soumettre</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>


    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
          Vos locations passées
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse show">
        <div class="accordion-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Livre</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Prix</th>
                <th>Noter</th>
              </tr>
            </thead>

            <tbody>
            <?php while($row = mysqli_fetch_assoc($locations_passees)) { ?>
              <tr>
                <td><img src="<?= $row['BK_Visual'] ?>" width="50"></td>
                <td><?= $row['RL_Start'] ?></td>
                <td><?= $row['RL_End'] ?></td>
                <td><?= $row['BK_Cost'] ?> €</td>
                <td><button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#noter<?= $row['BK_Code'] ?>"> Noter </button>
              </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?php
mysqli_data_seek($locations_passees, 0);
while($row = mysqli_fetch_assoc($locations_passees)) {
?>
<div class="modal fade" id="noter<?= $row['BK_Code'] ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="noter_livre.php">
        <div class="modal-header">
          <h5 class="modal-title">Notez le livre : <?= htmlspecialchars($row['BK_Name']) ?></h5>
        </div>
        <div class="modal-body">
          <input type="hidden" name="bk_code" value="<?= $row['BK_Code'] ?>">
          <div class="mb-3">
            <label for="note<?= $row['BK_Code'] ?>" class="form-label">Note (0 à 100)</label>
            <input type="number" class="form-control" name="note" id="note<?= $row['BK_Code'] ?>" min="0" max="100" required>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Soumettre</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
          Vos livres pour plus tard
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse show">
        <div class="accordion-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Livre</th>
                <th>Prix</th>
                <th>Disponibilité</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($souhaits)) { ?>
              <tr>
                <td><img src="../media/livre/<?= $row['image'] ?>" width="50"></td>
                <td><?= number_format($row['prix'], 2, ',', ' ') ?> €</td>
                <td><?= $row['disponible'] ? 'Oui' : 'Non' ?></td>
                <td><a class="btn btn-danger btn-sm" href="?supprimer_souhait=<?= $row['BK_Code'] ?>">Supprimer</a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <footer class="py-3 my-4 border-top">
        <p>&copy; Paul Michaux</p>
      </footer>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
