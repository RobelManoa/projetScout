<?php
session_start();
include '../base.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Récupérer les données saisies dans le formulaire
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    // Vérifier si les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {
        // Préparer et exécuter la requête SQL pour récupérer l'utilisateur avec cet email
        $query = $conn->prepare("SELECT * FROM admins WHERE mail_admin = :email");
        $query->bindParam(":email", $email);
        $query->execute();

        // Vérifier si un utilisateur correspondant a été trouvé
        if ($query->rowCount() > 0) {
            $user = $query->fetch(PDO::FETCH_ASSOC);

            // Vérifier si le mot de passe saisi correspond au mot de passe haché dans la base de données
            if (password_verify($password, $user['mdp_admin'])) {
                // Authentification réussie, enregistrer l'utilisateur dans la session
                $_SESSION["admin_id"] = $user["id_admin"];
                $_SESSION["admin_email"] = $user["mail_admin"];
                $_SESSION["nom_admin"] = $user["nom_admin"];
                
                // Rediriger vers la page d'accueil ou une autre page sécurisée
                header("Location: index.php?mpiandraikitra=".$_SESSION["nom_admin"]);
                exit();
            } else {
                // Mot de passe incorrect
                $error = "Mot de passe incorrect.";
            }
        } else {
            // Aucun utilisateur trouvé avec cet email
            $error = "Aucun compte trouvé avec cet email.";
        }
    } else {
        // Les champs ne doivent pas être vides
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header d-flex align-content-center">
                                    <img src="https://upload.wikimedia.org/wikipedia/fr/e/e4/Logo_Tily_eto_Madagasikara.svg" alt="" class="w-25 h-25">
                                    <h3 class="text-center font-weight-light my-4 ms-5">Connexion</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="inputEmail" type="email" placeholder="name@example.com" required>
                                            <label for="inputEmail">Adresse Mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Password" required>
                                            <label for="inputPassword">Mot de Passe</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Connexion</button>
                                            <a href="register.php">Pas encore inscrit ?</a>
                                            <a href="../" class="btn btn-primary">Miverina</a>
                                        </div>
                                    </form>
                                    <?php if (isset($error)) { ?>
                                        <div class="alert alert-danger mt-3" role="alert">
                                            <?php echo $error; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
