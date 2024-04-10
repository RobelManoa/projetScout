<?php
session_start();
include '../base.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["tonia_nom"]) || empty($_SESSION["tonia_nom"])) {
    header("location: login.php");
    exit();
}

// Récupérer les données de l'utilisateur à partir de la base de données
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare("SELECT * FROM tonia WHERE nom_tonia = :nom");
    $query->bindParam(":nom", $_SESSION["tonia_nom"]);
    $query->execute();

    $userData = $query->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les nouvelles données saisies dans le formulaire
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauPrenom = $_POST['nouveauPrenom'];
    $nouvelleDateNaissance = $_POST['nouvelleDateNaissance'];
    $nouveauMail = $_POST['nouveauMail'];
    $nouvelleAnneeDirige = $_POST['nouvelleAnneeDirige'];
    $nouveauTotem = $_POST['nouveauTotem'];

    // Traitement de l'image
    $nomFichier = $_FILES['nouvellePhoto']['name'];
    $tailleFichier = $_FILES['nouvellePhoto']['size'];
    $typeFichier = $_FILES['nouvellePhoto']['type'];
    $tempFichier = $_FILES['nouvellePhoto']['tmp_name'];
    $erreurFichier = $_FILES['nouvellePhoto']['error'];

    // Vérifier si une nouvelle photo a été téléchargée
    if ($erreurFichier === UPLOAD_ERR_OK) {
        // Déplacer la photo vers le dossier de destination
        $destination = 'assets/img/' . $nomFichier; // Spécifiez le chemin de destination
        move_uploaded_file($tempFichier, $destination);
    }

    // Mettre à jour les données de l'utilisateur dans la base de données
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $updateQuery = $conn->prepare("UPDATE tonia SET nom_tonia = :nom, prenom_tonia = :prenom, date_naissance = :date_naissance, mail = :mail, date_dirige = :date_dirige, totem = :totem, photo = :photo WHERE nom_tonia = :ancienNom");
        $updateQuery->bindParam(":nom", $nouveauNom);
        $updateQuery->bindParam(":prenom", $nouveauPrenom);
        $updateQuery->bindParam(":date_naissance", $nouvelleDateNaissance);
        $updateQuery->bindParam(":mail", $nouveauMail);
        $updateQuery->bindParam(":date_dirige", $nouvelleAnneeDirige);
        $updateQuery->bindParam(":totem", $nouveauTotem);
        $updateQuery->bindParam(":photo", $destination); // Utilisez $destination si une photo a été téléchargée, sinon utilisez l'ancienne photo ou NULL
        $updateQuery->bindParam(":ancienNom", $_SESSION["tonia_nom"]);
        $updateQuery->execute();

        // Mettre à jour le nom de l'utilisateur dans la session PHP
        $_SESSION["tonia_nom"] = $nouveauNom;

        // Rediriger l'utilisateur vers la page de profil
        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
include '../assets/head.php';
?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Modifier le profil de
                    <?php echo $_SESSION["tonia_nom"]; ?>
                </h5>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nouveauNom" class="form-label">Nouveau Nom</label>
                        <input type="text" class="form-control" id="nouveauNom" name="nouveauNom"
                            value="<?php echo isset($userData['nom_tonia']) ? $userData['nom_tonia'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nouveauPrenom" class="form-label">Nouveau Prénom</label>
                        <input type="text" class="form-control" id="nouveauPrenom" name="nouveauPrenom"
                            value="<?php echo isset($userData['prenom_tonia']) ? $userData['prenom_tonia'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="nouvelleDateNaissance" class="form-label">Nouvelle Date de Naissance</label>
                        <input type="date" class="form-control" id="nouvelleDateNaissance" name="nouvelleDateNaissance"
                            value="<?php echo isset($userData['date_naissance']) ? $userData['date_naissance'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="nouveauMail" class="form-label">Nouvelle Adresse mail</label>
                        <input type="email" class="form-control" id="nouveauMail" name="nouveauMail"
                            value="<?php echo isset($userData['mail']) ? $userData['mail'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nouvelleAnneeDirige" class="form-label">Nouvelle Année dirigée</label>
                        <input type="date" class="form-control" id="nouvelleAnneeDirige" name="nouvelleAnneeDirige"
                            value="<?php echo isset($userData['date_dirige']) ? $userData['date_dirige'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="nouveauTotem" class="form-label">Nouveau Totem</label>
                        <input type="text" class="form-control" id="nouveauTotem" name="nouveauTotem"
                            value="<?php echo isset($userData['totem']) ? $userData['totem'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nouvellePhoto" class="form-label">Nouvelle Photo de profil</label>
                        <input type="file" class="form-control" id="nouvellePhoto" name="nouvellePhoto">
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>