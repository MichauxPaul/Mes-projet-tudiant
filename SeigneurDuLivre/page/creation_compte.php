<?php
session_start();
require '../config_webetu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['first_name'] ?? '';
    $nom = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = sha1($_POST['password'] ?? '');

    if ($prenom && $nom && $email && $password) {
        $stmt = mysqli_prepare(
            $connect,
            "INSERT INTO SDL_CLIENT (CT_Firstname, CT_Surname, CT_Password, CT_Email) VALUES (?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, 'ssss', $prenom, $nom, $password, $email);
    
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['user_email'] = $email;
            header('Location: https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/index.php');
            exit();
        } else {
            error_log("Erreur MySQL : " . mysqli_error($connect));
            $error = "Erreur lors de la création du compte.";
        }
    
        mysqli_stmt_close($stmt);
    }
    
    
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../logo/logo_SDL.webp" type="image/webp">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-dialog {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .form-label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }
        .mb-4 { margin-bottom: 1.5rem; }
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .form-card {
            background-color: #343a40;
            color: white;
            border-radius: 1rem;
            width: 100%;
            max-width: 600px;
        }
        .card-body { padding: 2rem; }
        .vh-100 { height: 100vh; }
    </style>
</head>
<body>
<?php require 'nav/nav.php'; ?>
<main>
<section class="vh-100">
  <div class="container py-5 h-100">
      <div class="center-content">
          <div class="form-card">
              <div class="card-body p-5 text-center">
                  <div class="mb-md-5 mt-md-4 pb-5">
                      <h2 class="fw-bold mb-2 text-uppercase">Création de votre compte</h2>
                      <p class="text-white-50 mb-5">Entrer votre nom, prénom, adresse email et votre mot de passe pour créer votre compte chez Seigneur du Livre et commencer à bouquiner !</p>

                      <?php if (!empty($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>

                      <form action="" method="POST">
                          <div class="mb-4">
                              <label for="typeFirstName" class="form-label text-left">Prénom</label>
                              <input type="text" id="typeFirstName" name="first_name" class="form-control form-control-lg" required />
                          </div>
                          <div class="mb-4">
                              <label for="typeLastName" class="form-label text-left">Nom</label>
                              <input type="text" id="typeLastName" name="last_name" class="form-control form-control-lg" required />
                          </div>
                          <div class="mb-4">
                              <label for="typeEmailX" class="form-label text-left">Email</label>
                              <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" required />
                          </div>
                          <div class="mb-4">
                              <label for="typePasswordX" class="form-label text-left">Mot de passe</label>
                              <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" required />
                          </div>
                          <button class="btn btn-outline-light btn-lg px-5" type="submit">Créer mon compte</button>
                      </form>

                      <div>
                          <p class="mb-0">Vous avez déjà un compte ? <a href="login.php" class="text-white-50 fw-bold">Connectez-vous ici</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<footer class="py-3 my-4 border-top">
        <p>&copy; Paul Michaux</p>
</footer>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
