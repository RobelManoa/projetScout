<?php
session_start();
include '../base.php';

// Vérifier si l'identifiant de l'utilisateur est passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];

    // Récupérer les données de l'utilisateur à partir de la base de données
    try {
        $query = $conn->prepare("SELECT * FROM beazina WHERE id_beazina = :id");
        $query->bindParam(":id", $userId);
        $query->execute();
        $userData = $query->fetch(PDO::FETCH_ASSOC);

        // Assurez-vous que les données de l'utilisateur existent avant de les afficher
        if ($userData) {
            // Vous pouvez maintenant remplir les champs du formulaire avec les données récupérées
            $nom = $userData['nom_beazina'];
            $prenom = $userData['prenom_beazina'];
            $date_naissance = $userData['date_naissance'];
            $contact_beazina = $userData['contact_beazina'];
            $nom_pere = $userData['nom_pere'];
            $contact_pere = $userData['contact_pere'];
            $nom_mere = $userData['nom_mere'];
            $contact_mere = $userData['contact_mere'];
            $adresse_beazina = $userData['adresse_beazina'];
            $date_inscriptionb = $userData['date_inscriptionb'];
            $ecole = $userData['ecole'];
            $totem = $userData['totem'];
            $photo = $userData['photo'];
            $exploits = $userData['exploits'];
        } else {
            // Rediriger si l'utilisateur avec l'identifiant donné n'existe pas
            header("Location: list.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Rediriger si aucun identifiant d'utilisateur n'a été passé dans l'URL
    header("Location: list.php");
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données envoyées par le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $contact_beazina = $_POST['contact_beazina'];
    $categorie = $_POST['categorie'];
    $nom_pere = $_POST['nom_pere'];
    $contact_pere = $_POST['contact_pere'];
    $nom_mere = $_POST['nom_mere'];
    $contact_mere = $_POST['contact_mere'];
    $adresse_beazina = $_POST['adresse_beazina'];
    $date_inscriptionb = $_POST['date_inscriptionb'];
    $ecole = $_POST['ecole'];
    $totem = $_POST['totem'];
    $exploits = $_POST['exploits'];

    // Vérifier si un fichier a été téléchargé
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Récupérer les informations sur le fichier
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Vérifier l'extension du fichier
        $allowedExtensions = array("jpg", "jpeg", "png");
        if (in_array($fileExtension, $allowedExtensions)) {
            // Supprimer l'ancienne photo si elle existe
            if (!empty($photo) && file_exists($photo)) {
                unlink($photo);
            }

            // Déplacer le nouveau fichier vers le dossier images
            $uploadFileDir = './images/';
            $dest_path = $uploadFileDir . $fileName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photo = $dest_path; // Mettre à jour le chemin de la photo dans la base de données
            } else {
                echo "Erreur lors du téléchargement du fichier.";
            }
        } else {
            echo "Extension de fichier non autorisée. Veuillez télécharger une image avec une extension JPG, JPEG ou PNG.";
        }
    }

    // Mettre à jour les données dans la base de données
    try {
        $updateQuery = $conn->prepare("UPDATE beazina SET nom_beazina = :nom, prenom_beazina = :prenom, date_naissance = :date_naissance, contact_beazina = :contact_beazina, categories = :categorie, nom_pere = :nom_pere, contact_pere = :contact_pere, nom_mere = :nom_mere, contact_mere = :contact_mere, adresse_beazina = :adresse_beazina, date_inscriptionb = :date_inscriptionb, ecole = :ecole, totem = :totem, photo = :photo, exploits = :exploits WHERE id_beazina = :id");
        $updateQuery->bindParam(":nom", $nom);
        $updateQuery->bindParam(":prenom", $prenom);
        $updateQuery->bindParam(":date_naissance", $date_naissance);
        $updateQuery->bindParam(":contact_beazina", $contact_beazina);
        $updateQuery->bindParam(":categorie", $categorie);
        $updateQuery->bindParam(":nom_pere", $nom_pere);
        $updateQuery->bindParam(":contact_pere", $contact_pere);
        $updateQuery->bindParam(":nom_mere", $nom_mere);
        $updateQuery->bindParam(":contact_mere", $contact_mere);
        $updateQuery->bindParam(":adresse_beazina", $adresse_beazina);
        $updateQuery->bindParam(":date_inscriptionb", $date_inscriptionb);
        $updateQuery->bindParam(":ecole", $ecole);
        $updateQuery->bindParam(":totem", $totem);
        $updateQuery->bindParam(":photo", $photo);
        $updateQuery->bindParam(":exploits", $exploits);
        $updateQuery->bindParam(":id", $userId);
        $updateQuery->execute();

        // Rediriger vers la page de profil une fois la mise à jour terminée
        header("Location: profile.php?id=" . $userId);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
</head>

<body>
    <div class="container">
        <h2>Modification du profil</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom; ?>">
            </div>
            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de Naissance</label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance"
                    value="<?php echo $date_naissance; ?>">
            </div>
            <div class="mb-3">
                <label for="contact_beazina" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact_beazina" name="contact_beazina"
                    value="<?php echo $contact_beazina; ?>">
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie</label>
                <select class="form-select" id="categorie" name="categorie">
                    <option value="1" <?php if ($userData['categories'] == 1)
                        echo "selected"; ?>>Mavo</option>
                    <option value="2" <?php if ($userData['categories'] == 2)
                        echo "selected"; ?>>Maintso</option>
                    <option value="3" <?php if ($userData['categories'] == 3)
                        echo "selected"; ?>>Mena</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nom_pere" class="form-label">Nom du Père</label>
                <input type="text" class="form-control" id="nom_pere" name="nom_pere" value="<?php echo $nom_pere; ?>">
            </div>
            <div class="mb-3">
                <label for="contact_pere" class="form-label">Contact du Père</label>
                <input type="text" class="form-control" id="contact_pere" name="contact_pere"
                    value="<?php echo $contact_pere; ?>">
            </div>
            <div class="mb-3">
                <label for="nom_mere" class="form-label">Nom de la Mère</label>
                <input type="text" class="form-control" id="nom_mere" name="nom_mere" value="<?php echo $nom_mere; ?>">
            </div>
            <div class="mb-3">
                <label for="contact_mere" class="form-label">Contact de la Mère</label>
                <input type="text" class="form-control" id="contact_mere" name="contact_mere"
                    value="<?php echo $contact_mere; ?>">
            </div>
            <div class="mb-3">
                <label for="adresse_beazina" class="form-label">Adresse</label>
                <textarea class="form-control" id="adresse_beazina"
                    name="adresse_beazina"><?php echo $adresse_beazina; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="date_inscriptionb" class="form-label">Date d'Inscription</label>
                <input type="date" class="form-control" id="date_inscriptionb" name="date_inscriptionb"
                    value="<?php echo $date_inscriptionb; ?>">
            </div>
            <div class="mb-3">
                <label for="ecole" class="form-label">École</label>
                <input type="text" class="form-control" id="ecole" name="ecole" value="<?php echo $ecole; ?>">
            </div>
            <div class="mb-3">
                <label for="totem" class="form-label">Totem</label>
                <input type="text" class="form-control" id="totem" name="totem" value="<?php echo $totem; ?>">
            </div>
            <div class="mb-3">
                <label for="exploits" class="form-label">Exploits</label>
                <textarea class="form-control" id="exploits" name="exploits"><?php echo $exploits; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" value="<?php echo $photo; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="profile.php?id=<?php echo $userId; ?>" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>

</html>