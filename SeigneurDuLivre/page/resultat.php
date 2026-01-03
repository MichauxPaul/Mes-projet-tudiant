<?php
require '../config_webetu.php';
session_start();

$chaine = $_GET['q'] ?? '';
$highlight = '<span style="color: #cc0000; font-style: italic;">' . htmlspecialchars($chaine) . '</span>';

$livres = [];
if (!empty($chaine)) {
    $chaine_safe = mysqli_real_escape_string($connect, $chaine);
    $requete = "
        SELECT B.BK_Code AS id, B.BK_Name AS titre, B.BK_Description AS resume, B.BK_Visual AS image, B.BK_Cost AS prix_location,
               A.AR_Firstname, A.AR_Surname, PUB.PR_Name AS editeur,
               IFNULL(AVG(RG.RG_Value), 0) AS score
        FROM SDL_BOOK B
        LEFT JOIN SDL_WRITE W ON B.BK_Code = W.BK_Code
        LEFT JOIN SDL_AUTHOR A ON W.AR_Code = A.AR_Code
        LEFT JOIN SDL_PUBLISH P ON B.BK_Code = P.BK_Code
        LEFT JOIN SDL_PUBLISHER PUB ON P.PR_Code = PUB.PR_Code
        LEFT JOIN SDL_RATING RG ON B.BK_Code = RG.BK_Code
        WHERE B.BK_Name LIKE '%$chaine_safe%' OR B.BK_Description LIKE '%$chaine_safe%'
        GROUP BY B.BK_Code
        ORDER BY B.TE_Code ASC, B.BK_Cost ASC";

    $result = mysqli_query($connect, $requete);
    if ($result) {
        $livres = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../logo/logo_SDL.webp" type="image/webp">
  <title>Résultat de recherche</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <?php require 'nav/nav.php'; ?>
  <div class="page-header mt-4">
    <h1>Résultats pour "<span style='color:#cc0000; font-style:italic;'><?= htmlspecialchars($chaine) ?></span>"</h1>
    <hr />
  </div>

  <div class="row">
    <?php if (empty($livres)): ?>
      <div class="col-12">
        <p class="text-center text-danger fs-4">Aucun résultat trouvé.</p>
      </div>
    <?php else: ?>
      <?php foreach ($livres as $livre): 
        $score = (int) $livre['score'];
        $color = $score <= 50 ? 'bg-danger' : ($score <= 70 ? 'bg-warning text-dark' : 'bg-success');
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

      <div class="modal fade" id="modal<?= $livre['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?= $livre['titre'] ?></h5>
            </div>
            <div class="modal-body">
              <img src="../media/livre/<?= $livre['image'] ?>" class="img-fluid mb-3">
              <p><b>Résumé :</b> <?= $livre['resume'] ?></p>
              <p><b>Auteur :</b> <?= $livre['AR_Firstname'] . ' ' . $livre['AR_Surname'] ?></p>
              <p><b>Éditeur :</b> <?= $livre['editeur'] ?></p>
              <p><b>Prix :</b> <?= number_format($livre['prix_location'], 2, ',', ' ') ?> €</p>
              <p><b>Score :</b></p>
              <div class="progress">
                <div class="progress-bar <?= $color ?>" role="progressbar" style="width: <?= $score ?>%" aria-valuenow="<?= $score ?>" aria-valuemin="0" aria-valuemax="100"><?= $score ?></div>
              </div>
            </div>
            <div class="modal-footer">
              <?php if (isset($_SESSION['user_id'])): ?>
                <a href="ajouter_souhait.php?ajouter_souhait=<?= $livre['id'] ?>" class="btn btn-outline-warning">
                  Ajouter à ma liste de souhaits
                </a>
              <?php else: ?>
                <a href="login.php" class="btn btn-outline-warning">Connectez-vous pour ajouter aux souhaits</a>
              <?php endif; ?>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <footer class="py-3 my-4 border-top text-center">
    <p>&copy; Paul Michaux</p>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
