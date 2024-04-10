<?php
include '../base.php'; // Inclure le fichier de connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $legende = $_POST['legende'];
    $date_evenement = $_POST['date_evenement'];
    $responsable = $_SESSION['tonia_nom']; // Utilisateur connecté
    $pieces_evenement = array();

    // Vérifier s'il y a des fichiers téléchargés
    if (!empty($_FILES['pieces_evenement']['name'][0])) {
        $files = $_FILES['pieces_evenement'];

        // Parcourir les fichiers téléchargés
        foreach ($files['name'] as $key => $name) {
            // Chemin de destination pour enregistrer le fichier sur le serveur
            $target_dir = "../assets/uploads/";
            $target_file = $target_dir . basename($name);

            // Déplacer le fichier téléchargé vers le dossier de destination
            $tempFile = $files['tmp_name'][$key];
            if (move_uploaded_file($tempFile, $target_file)) {

                $pieces_evenement[] = $target_file; // Ajouter le chemin du fichier à la liste
            } else {
                echo "Erreur lors de l'upload du fichier $name.";
            }
        }
    }

    // Insérer les données dans la table evenement de la base de données
    try {
        $query = $conn->prepare("INSERT INTO evenement (titre, legende, datevenement, responsable, piece_evenement) VALUES (:titre, :legende, :date_evenement, :responsable, :piece_evenement)");
        $query->bindParam(":titre", $titre);
        $query->bindParam(":legende", $legende);
        $query->bindParam(":date_evenement", $date_evenement);
        $query->bindParam(":responsable", $responsable);
        $query->bindParam(":piece_evenement", json_encode($pieces_evenement)); // Convertir en JSON pour stockage dans la base de données
        $query->execute();

        echo json_encode(['success' => true, 'message' => 'Événement ajouté avec succès.']);
        header('location:index.php');
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
    }
    exit; // Arrêter l'exécution du script après avoir traité le formulaire
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un événement</title>
    <!-- Inclure les liens vers Bootstrap et d'autres bibliothèques CSS/JS ici -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclure les scripts JavaScript ici -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Ajouter un événement</h1>
        <!-- Formulaire HTML -->
        <form id="uploadForm" action="./traitement_formulaire.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="legende" class="form-label">Légende</label>
                <textarea class="form-control" id="legende" name="legende" required></textarea>
            </div>
            <div class="mb-3">
                <label for="date_evenement" class="form-label">Date de l'événement</label>
                <input type="date" class="form-control" id="date_evenement" name="date_evenement" required>
            </div>
            <div class="mb-3">
                <label for="pieces_evenement" class="form-label">Pièces jointes</label>
                <input type="file" class="form-control" id="pieces_evenement" name="pieces_evenement[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <!-- Script JavaScript -->
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (event) {
            //event.preventDefault(); // Empêcher le formulaire de se soumettre normalement

            const form = event.target;
            const formData = new FormData(form); // Créer un objet FormData pour les données du formulaire
            const files = document.getElementById('pieces_evenement').files; // Récupérer les fichiers sélectionnés

            // Ajouter chaque fichier sélectionné à l'objet FormData
            for (let i = 0; i < files.length; i++) {
                formData.append('pieces_evenement[]', files[i]);
            }

            // Envoyer les données du formulaire au serveur via une requête AJAX
            fetch(form.action, {
                method: form.method,
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Réponse du serveur :', data);
                    // Traiter la réponse du serveur ici (afficher un message de succès, etc.)
                })
                .catch(error => {
                    console.error('Erreur lors de l\'envoi des données :', error);
                    // Traiter les erreurs ici (afficher un message d'erreur, etc.)
                });
        });
    </script>
</body>

</html>