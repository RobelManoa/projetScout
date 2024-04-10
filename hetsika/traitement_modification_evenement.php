<?php
// Inclure le fichier de connexion à la base de données
include '../base.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'identifiant de l'événement à modifier depuis le formulaire
    $id_evenement = $_POST['id'];

    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $legende = $_POST['legende'];
    $date_evenement = $_POST['date_evenement'];
    $pieces_evenement = array();

    // Vérifier s'il y a des fichiers téléchargés
    if (!empty($_FILES['pieces_evenement']['name'][0])) {
        $files = $_FILES['pieces_evenement'];

        // Parcourir les fichiers téléchargés
        foreach ($files['name'] as $key => $name) {
            // Chemin de destination pour enregistrer le fichier sur le serveur
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($name);

            // Déplacer le fichier téléchargé vers le dossier de destination
            if (move_uploaded_file($files['tmp_name'][$key], $target_file)) {
                $pieces_evenement[] = $target_file; // Ajouter le chemin du fichier à la liste
            } else {
                echo "Erreur lors de l'upload du fichier $name.";
            }
        }
    }

    // Modifier les données de l'événement dans la base de données
    try {
        $query = $conn->prepare("UPDATE evenement SET titre = :titre, legende = :legende, datevenement = :date_evenement, piece_evenement = :piece_evenement WHERE id_evenement = :id");
        $query->bindParam(":titre", $titre);
        $query->bindParam(":legende", $legende);
        $query->bindParam(":date_evenement", $date_evenement);
        $query->bindParam(":piece_evenement", json_encode($pieces_evenement)); // Convertir en JSON pour stockage dans la base de données
        $query->bindParam(":id", $id_evenement);
        $query->execute();

        // Rediriger vers la page de liste des événements avec un message de succès
        header("Location: index.php?success=1");
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur lors de la modification de l'événement, rediriger vers la page de liste des événements avec un message d'erreur
        header("Location: index.php?error=1");
        exit();
    }
} else {
    // Si le formulaire n'a pas été soumis via la méthode POST, rediriger vers la page de liste des événements
    header("Location: index.php");
    exit();
}
?>
