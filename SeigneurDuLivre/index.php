<?php
require 'config_webetu.php';
session_start();

$sqlCategories = "SELECT TE_Code AS id, TE_Name AS nom FROM SDL_TYPE ORDER BY TE_Name";
$categories = mysqli_fetch_all(mysqli_query($connect, $sqlCategories), MYSQLI_ASSOC);

$sqlThemes = "SELECT TH_Code AS id, TH_Name AS nom FROM SDL_THEME ORDER BY TH_Name";
$themes = mysqli_fetch_all(mysqli_query($connect, $sqlThemes), MYSQLI_ASSOC);

$sqlLivres = "
  SELECT 
    b.BK_Code AS id,
    b.BK_Name AS titre,
    b.BK_Description AS resume,
    b.BK_Visual AS image,
    b.BK_Cost AS prix_location,
    CONCAT(a.AR_Firstname, ' ', a.AR_Surname) AS auteur,
    p.PR_Name AS editeur,
    COALESCE(AVG(rg.RG_Value), 0) AS score,
    COUNT(DISTINCT rl.CT_Code) AS nombre_locations
  FROM SDL_BOOK b
  LEFT JOIN SDL_WRITE w ON b.BK_Code = w.BK_Code
  LEFT JOIN SDL_AUTHOR a ON w.AR_Code = a.AR_Code
  LEFT JOIN SDL_PUBLISH pb ON b.BK_Code = pb.BK_Code
  LEFT JOIN SDL_PUBLISHER p ON pb.PR_Code = p.PR_Code
  LEFT JOIN SDL_RATING rg ON b.BK_Code = rg.BK_Code
  LEFT JOIN SDL_RENTAL rl ON b.BK_Code = rl.BK_Code
  GROUP BY b.BK_Code
  ORDER BY nombre_locations DESC
  LIMIT 9
";
$result = mysqli_query($connect, $sqlLivres);
$livres = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (!$result) {
    echo "<pre>Erreur SQL : " . mysqli_error($connect) . "</pre>";
    exit;
}

$livres_souhaits = [];
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $req_souhaits = "SELECT BK_Code AS id_livre FROM SDL_WISHLIST WHERE CT_Code = $user_id";
  $res_souhaits = mysqli_query($connect, $req_souhaits);
  while ($row = mysqli_fetch_assoc($res_souhaits)) {
    $livres_souhaits[] = $row['id_livre'];
  }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['email'] ?? '';
    $sujet = $_POST['objet'] ?? '';
    $message = $_POST['message'] ?? '';

    if ($from && $sujet && $message) {
        $to = 'paul.michaux9@etu.univ-lorraine.fr';
        $headers = "From: $from\r\nReply-To: $from\r\nContent-Type: text/plain; charset=utf-8";

        if (mail($to, $sujet, $message, $headers)) {
            $confirmation = "Message envoyé avec succès.";
        } else {
            $confirmation = "Erreur lors de l'envoi du message.";
        }
    } else {
        $confirmation = "Tous les champs sont obligatoires.";
}
}
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Accueil Seigneur du Livre">
    <meta name="author" content="Paul Michaux et Lilou Toussaint-Erraes">
    <link rel="icon" type="image/jpeg" href="media/logo/logo_SDL.webp">
    <title>Accueil Seigneur du Livre</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bg-dark {
        --bs-bg-opacity: 1;
        background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;
      }
      .bg-light {
        --bs-bg-opacity: 1;
        background-color: rgb(244 248 252) !important;
      }
    </style>
  </head>
  <script>
document.querySelectorAll('.louer-btn').forEach(button => {
  button.addEventListener('click', function () {
    const idLivre = this.dataset.id;
    const titre = this.dataset.title;

    fetch('ajax/ajouter_location.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'id_livre=' + encodeURIComponent(idLivre)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        document.getElementById('confirmationText').textContent = `Le livre "${titre}" a bien été ajouté à vos locations.`;
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
      } else {
        alert('Erreur lors de la location.');
      }
    });
  });
});
</script>

  <body>
  <main class="container">
  <?php require 'page/nav/nav.php'; ?>

    <div class="p-3 mb-4 bg-light rounded-3">
      <div class="container-fluid py-4">
        <h1 class="display-5 fw-bold"><img src="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/media/logo/logo_SDL.png" alt="" /> Bienvenue chez Seigneur du Livre !</h1>
        <p class="fs-4">Seigneur du Livre est une bibliothèque en ligne où vous pouvez louer des ouvrages littéraires et les noter</p>
      </div>
    </div>

    <h1>Notre Top 9 des Locations</h1>
    <div id="carouselLivres" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach (array_chunk($livres, 3) as $index => $chunk): ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
          <div class="row">
            <?php foreach ($chunk as $livre): ?>
            <div class="col-md-4">
              <div class="card">
                <img src="media/livre/<?= $livre['image'] ?>" class="card-img-top" alt="<?= $livre['titre'] ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= $livre['titre'] ?></h5>
                  <p class="card-text"><?= substr($livre['resume'], 0, 80) ?>...</p>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $livre['id'] ?>">Détails</button>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselLivres" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselLivres" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    <?php foreach ($livres as $livre): 
  $score = (int)$livre['score'];
  $color = 'bg-success';
  if ($score <= 50) $color = 'bg-danger';
  elseif ($score <= 70) $color = 'bg-warning text-dark';
  elseif ($score >= 90) $color = 'bg-warning';
  $est_dans_souhaits = in_array($livre['id'], $livres_souhaits);
?>
<div class="modal fade" id="modal<?= $livre['id'] ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= $livre['titre'] ?></h5>
      </div>
      <div class="modal-body">
        <img src="media/livre/<?= $livre['image'] ?>" class="img-fluid" alt="<?= $livre['titre'] ?>">
        <p><strong>Résumé :</strong> <?= $livre['resume'] ?></p>
        <p><strong>Auteur :</strong> <?= $livre['auteur'] ?></p>
        <p><strong>Éditeur :</strong> <?= $livre['editeur'] ?></p>
        <p><strong>Prix :</strong> <?= number_format($livre['prix_location'], 2, ',', ' ') ?> €</p>
        <p><strong>Score des utilisateurs :</strong></p>
        <div class="progress">
          <div class="progress-bar <?= $color ?>" style="width: <?= $score ?>%"><?= $score ?></div>
        </div>
      </div>
      <div class="modal-footer">
        <?php if (isset($_SESSION['user_id'])): ?>
          <button class="btn btn-warning louer-btn" data-id="<?= $livre['id'] ?>" data-title="<?= htmlspecialchars($livre['titre']) ?>">Louez-moi</button>
          <a href="<?= $est_dans_souhaits ? '#' : 'ajouter_souhait.php?ajouter_souhait=' . $livre['id'] ?>" class="btn btn-outline-warning <?= $est_dans_souhaits ? 'disabled' : '' ?>">
            <?= $est_dans_souhaits ? 'Déjà dans les souhaits' : 'Ajouter aux souhaits' ?>
          </a>
        <?php else: ?>
          <a href="page/login.php" class="btn btn-warning">Connectez-vous pour louer</a>
          <a href="page/login.php" class="btn btn-outline-warning">Connectez-vous pour ajouter aux souhaits</a>
        <?php endif; ?>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<h2>Une question ? Contacter nous ici</h2>

    <?php if (!empty($confirmation)): ?>
      <div class="alert alert-info"><?= $confirmation ?></div>
    <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Votre adresse email</label>
      <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Objet</label>
      <input type="text" name="objet" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Zone de texte</label>
      <textarea name="message" class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </form>

  <footer class="py-3 my-4 border-top">
        <p>&copy; Paul Michaux</p>
      </footer>

    <script>
      function showConfirmationModal(titre) {
        const text = `Le livre "${titre}" a bien été ajouté à votre liste de location.`;
        document.getElementById('confirmationText').textContent = text;
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </main>
  </body>
</html>
