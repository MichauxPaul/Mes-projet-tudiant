
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'config_webetu.php';


// Charger les catégories (SDL_TYPE) et thèmes (SDL_THEME)
$categories = mysqli_fetch_all(
  mysqli_query($connect, "SELECT TE_Code AS id, TE_Name AS nom FROM SDL_TYPE ORDER BY TE_Name"),
  MYSQLI_ASSOC
);

$themes = mysqli_fetch_all(
  mysqli_query($connect, "SELECT TH_Code AS id, TH_Name AS nom FROM SDL_THEME ORDER BY TH_Name"),
  MYSQLI_ASSOC
);
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/index.php">Seigneur Du Livre</a>
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
      <li class="nav-item">
        <a href="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/index.php" class="nav-link px-2 text-white">Accueil</a>
      </li>

      <!-- Dropdown Catégories -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Catégories
        </a>
        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
          <?php foreach ($categories as $cat): ?>
            <li><a class="dropdown-item" href="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/page/affiche_livre.php?categorie=<?= $cat['id'] ?>"><?= $cat['nom'] ?></a></li>
          <?php endforeach; ?>
        </ul>
      </li>

      <!-- Dropdown Thèmes -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Thème
        </a>
        <ul class="dropdown-menu" aria-labelledby="themeDropdown">
          <?php foreach ($themes as $theme): ?>
            <li><a class="dropdown-item" href="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/affiche_livre.php?theme=<?= $theme['id'] ?>"><?= $theme['nom'] ?></a></li>
          <?php endforeach; ?>
        </ul>
      </li>
    </ul>

    <!-- Barre de recherche -->
    <form action="resultat.php" method="get" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
      <input type="search" name="q" class="form-control form-control-dark text-bg-dark" placeholder="Recherche..." aria-label="Search">
    </form>

    <?php if (isset($_SESSION['utilisateur'])): ?>
    <!-- Menu connecté -->
    <div class="dropdown text-end">
      <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/media/logo/logo_Commando_57.png" alt="profil" width="32" height="32" class="rounded-circle">
      </a>
      <ul class="dropdown-menu text-small">
        <li><a class="dropdown-item" href="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/page/espace_personnel.php">Profil</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="logout.php">Se déconnecter</a></li>
      </ul>
    </div>
    <?php else: ?>
    <!-- Boutons connexion / inscription -->
    <div class="text-end">
      <a href="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/page/login.php" class="btn btn-outline-light me-2">Connexion</a>
      <a href="https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/page/creation_compte.php" class="btn btn-warning">Créez un compte</a>
    </div>
    <?php endif; ?>
  </div>
</nav>



