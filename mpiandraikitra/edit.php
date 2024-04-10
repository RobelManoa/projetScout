<?php
session_start();
include '../base.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["nom_admin"]) || empty($_SESSION["nom_admin"])) {
    header("location: login.php");
    exit();
}

if (isset($_GET['id']) || !empty($_GET['id'])) {
    // Récupérer les données de l'utilisateur à partir de la base de données
    $id_admins = $_GET['id'];
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare("SELECT * FROM admins WHERE idAdmin = :id_admin");
    $query->bindParam(":id_admin", $id_admin);
    $query->execute();

    $userData = $query->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les nouvelles données saisies dans le formulaire
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauPrenom = $_POST['nouveauPrenom'];
    $residence = $_POST['residence'];
    $nouvelleDateNaissance = $_POST['nouvelleDateNaissance'];
    $nouveauMail = $_POST['nouveauMail'];
    $contacte = $_POST['contacte'];
    $inscription = $_POST['inscription'];
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
        $destination = 'images/' . $nomFichier;
        move_uploaded_file($tempFichier, '../' . $destination); // Chemin relatif par rapport au script
    } else {
        // Utilisez l'ancienne photo si aucune nouvelle photo n'a été téléchargée
        $destination = $userData['photo'];
    }

    // Mettre à jour les données de l'utilisateur dans la base de données
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $updateQuery = $conn->prepare("UPDATE admins SET nom_admin = :nom, prenom_admin = :prenom, residence_admin = :residence, age_admin = :date_naissance, mail_admin = :mail, contact_admin = :contacte, date_inscription = :inscription, totem = :totem, photo = :photo WHERE nom_admin = :ancienNom");
        $updateQuery->bindParam(":nom", $nouveauNom);
        $updateQuery->bindParam(":prenom", $nouveauPrenom);
        $updateQuery->bindParam(":residence", $residence);
        $updateQuery->bindParam(":date_naissance", $nouvelleDateNaissance);
        $updateQuery->bindParam(":mail", $nouveauMail);
        $updateQuery->bindParam(":contacte", $contacte);
        $updateQuery->bindParam(":inscription", $inscription);
        $updateQuery->bindParam(":totem", $nouveauTotem);
        $updateQuery->bindParam(":photo", $destination); // Utilisez $destination si une photo a été téléchargée, sinon utilisez l'ancienne photo
        $updateQuery->bindParam(":ancienNom", $_SESSION["nom_admin"]);
        $updateQuery->execute();

        // Mettre à jour le nom de l'utilisateur dans la session PHP
        $_SESSION["nom_admin"] = $nouveauNom;

        // Rediriger l'utilisateur vers la page de profil
        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Modifier le profil de
                    <?php echo $_SESSION["nom_admin"]; ?>
                </h5>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nouveauNom" class="form-label">Nouveau Nom</label>
                        <input type="text" class="form-control" id="nouveauNom" name="nouveauNom"
                            value="<?php echo isset($userData['nom_admin']) ? $userData['nom_admin'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nouveauPrenom" class="form-label">Nouveau Prénom</label>
                        <input type="text" class="form-control" id="nouveauPrenom" name="nouveauPrenom"
                            value="<?php echo isset($userData['prenom_admin']) ? $userData['prenom_admin'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="residence" class="form-label">Résidence</label>
                        <input type="text" class="form-control" id="residence" name="residence"
                            value="<?php echo isset($userData['residence_admin']) ? $userData['residence_admin'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="nouvelleDateNaissance" class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" id="nouvelleDateNaissance" name="nouvelleDateNaissance"
                            value="<?php echo isset($userData['age_admin']) ? $userData['age_admin'] : ''; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="nouveauMail" class="form-label">Nouvelle Adresse mail</label>
                        <input type="email" class="form-control" id="nouveauMail" name="nouveauMail"
                            value="<?php echo isset($userData['mail_admin']) ? $userData['mail_admin'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contacte" class="form-label">Contact </label>
                        <input type="text" class="form-control" id="contacte" name="contacte"
                            value="<?php echo isset($userData['contact_admin']) ? $userData['contact_admin'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="inscription" class="form-label">Date inscription</label>
                        <input type="date" class="form-control" id="inscription" name="inscription"
                            value="<?php echo isset($userData['date_inscription']) ? $userData['date_inscription'] : ''; ?>" required>
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
