<?php
session_start();
require 'config_webetu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = sha1($_POST['password'] ?? '');

    if ($email && $password) {
        $stmt = mysqli_prepare($connect, "SELECT * FROM SDL_CLIENT WHERE CT_Email = ? AND CT_Password = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($user = mysqli_fetch_assoc($result)) {
                $_SESSION['user_email'] = $user['CT_Email'];
                $_SESSION['user_id'] = $user['CT_Code'];
                $_SESSION['utilisateur'] = $user; // stocker infos utilisateur
                $_SESSION['flash'] = 'Connexion réussie !';
                header('Location: https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre/index.php');
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Erreur dans la requête SQL : " . mysqli_error($connect);
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}


?>


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
                      <h2 class="fw-bold mb-2 text-uppercase">Connexion</h2>
                      <p class="text-white-50 mb-5">Entrer votre adresse email et votre mot de passe pour vous connecter !</p>

                      <?php if (!empty($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>

                      <form action="" method="POST">
                          <div class="mb-4">
                              <label for="typeEmailX" class="form-label text-left">Email</label>
                              <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" required />
                          </div>
                          <div class="mb-4">
                              <label for="typePasswordX" class="form-label text-left">Mot de passe</label>
                              <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" required />
                          </div>
                          <button class="btn btn-outline-light btn-lg px-5" type="submit">Connexion</button>
                      </form>

                      <div>
                          <p class="mb-0">Vous n'avez pas encore de compte ? <a href="creation_compte.php" class="text-white-50 fw-bold">Créez-vous en un ici</a></p>
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
