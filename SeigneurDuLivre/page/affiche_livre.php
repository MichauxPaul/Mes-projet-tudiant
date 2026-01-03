<?php
require 'config_webetu.php';
session_start();

$requete = "
SELECT
  SDL_BOOK.BK_Code AS id,
  SDL_BOOK.BK_Name AS titre,
  SDL_BOOK.BK_Description AS resume,
  SDL_BOOK.BK_Cost AS prix_location,
  SDL_BOOK.BK_Visual AS image,
  SDL_AUTHOR.AR_Firstname,
  SDL_AUTHOR.AR_Surname,
  SDL_PUBLISHER.PR_Name AS editeur,
  SDL_THEME.TH_Name AS theme,
  IFNULL(AVG(SDL_RATING.RG_Value), 0) AS score
FROM SDL_BOOK
JOIN SDL_TYPE ON SDL_BOOK.TE_Code = SDL_TYPE.TE_Code
JOIN SDL_WRITE ON SDL_BOOK.BK_Code = SDL_WRITE.BK_Code
JOIN SDL_AUTHOR ON SDL_WRITE.AR_Code = SDL_AUTHOR.AR_Code
JOIN SDL_PUBLISH ON SDL_BOOK.BK_Code = SDL_PUBLISH.BK_Code
JOIN SDL_PUBLISHER ON SDL_PUBLISH.PR_Code = SDL_PUBLISHER.PR_Code
JOIN SDL_COVER ON SDL_BOOK.BK_Code = SDL_COVER.BK_Code
JOIN SDL_THEME ON SDL_COVER.TH_Code = SDL_THEME.TH_Code
LEFT JOIN SDL_RATING ON SDL_BOOK.BK_Code = SDL_RATING.BK_Code
GROUP BY SDL_BOOK.BK_Code
ORDER BY SDL_BOOK.BK_Name ";

$result = mysqli_query($connect, $requete);
$livres = mysqli_fetch_all($result, MYSQLI_ASSOC);

$livres_souhaits = [];
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $req_souhaits = "SELECT BK_Code as id_livre FROM SDL_WISHLIST WHERE CT_Code = $user_id";
  $res_souhaits = mysqli_query($connect, $req_souhaits);
  while ($row = mysqli_fetch_assoc($res_souhaits)) {
    $livres_souhaits[] = $row['id_livre'];
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="tout les livres disponibles chez Seigneurdulivre">
    <meta name="author" content="Paul Michaux">
    <link rel="icon" href="../logo/logo_SDL.webp" type="image/webp">
    

    <title>Livres</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .modal-content {
        background-color: black;
        color: white;
      }
    </style>
  </head>
  <body>
    

    <div class="container">
      <?php require 'nav/nav.php'; ?>
      <div class="page-header">
        <h1>Nos livres <small class="text-muted">Retrouvez nos offres !</small></h1>
        <hr />
      </div>

      <div class="row">
        <?php foreach ($livres as $livre): 
          $score = (int)$livre['score'];
          $color = 'bg-success';
          if ($score <= 50) $color = 'bg-danger';
          elseif ($score <= 70) $color = 'bg-warning text-dark';
          elseif ($score >= 90) $color = 'bg-warning';
          $est_dans_souhaits = in_array($livre['id'], $livres_souhaits);
        ?>
        <div class="col-sm-6 col-md-4">
          <div class="card mb-3">
            <img class="card-img-top" src="../media/livre/<?= $livre['image'] ?>" alt="Image <?= $livre['titre'] ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $livre['titre'] ?></h5>
              <p class="card-text"><?= substr($livre['resume'], 0, 100) . '...' ?></p>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $livre['id'] ?>">Détails</button>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal<?= $livre['id'] ?>" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><?= $livre['titre'] ?></h5>
              </div>
              <div class="modal-body">
                <p><img src="../media/livre/<?= $livre['image'] ?>" class="img-fluid" alt="<?= $livre['titre'] ?>" /></p>
                <p><b>Résumé :</b> <?= $livre['resume'] ?></p>
                <p><b>Écrit par :</b> <?= $livre['AR_Firstname'] . ' ' . $livre['AR_Surname'] ?></p>
                <p><b>Publié par :</b> <?= $livre['editeur'] ?></p>
                <p><b>Prix à la location :</b> <?= number_format($livre['prix_location'], 2, ',', ' ') ?>€</p>
                <p><b>Score des utilisateurs :</b></p>
                <div class="progress">
                  <div class="progress-bar <?= $color ?>" role="progressbar" style="width: <?= $score ?>%" aria-valuenow="<?= $score ?>" aria-valuemin="0" aria-valuemax="100"><?= $score ?></div>
                </div>
              </div>
              <div class="modal-footer">
                <?php if (isset($_SESSION['user_id'])): ?>
                  <a href="ajouter_location.php?id_livre=<?= $livre['id'] ?>" class="btn btn-warning">Louez-moi</a>
                  <a href="<?= $est_dans_souhaits ? '#' : 'ajouter_souhait.php?ajouter_souhait=' . $livre['id'] ?>" class="btn btn-outline-warning <?= $est_dans_souhaits ? 'disabled' : '' ?>">
                    <?= $est_dans_souhaits ? 'Déjà dans les souhaits' : 'Ajouter aux souhaits' ?>
                  </a>
                <?php else: ?>
                  <a href="login.php" class="btn btn-warning">Connectez-vous pour louer</a>
                  <a href="login.php" class="btn btn-outline-warning">Connectez-vous pour ajouter aux souhaits</a>
                <?php endif; ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <footer class="py-3 my-4 border-top">
        <p>&copy; Paul Michaux</p>
      </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
