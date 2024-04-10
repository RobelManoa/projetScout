<?php
// Inclure le fichier de connexion à la base de données
include '../base.php';

// Vérifier si un identifiant d'événement a été fourni dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'identifiant de l'événement depuis l'URL
    $id_evenement = $_GET['id'];

    // Récupérer les détails de l'événement depuis la base de données
    try {
        $query = $conn->prepare("SELECT * FROM evenement WHERE id_evenement = :id");
        $query->bindParam(":id", $id_evenement);
        $query->execute();

        // Vérifier si un événement correspondant a été trouvé
        if ($query->rowCount() == 1) {
            // Récupérer les données de l'événement
            $evenement = $query->fetch(PDO::FETCH_ASSOC);
        } else {
            // Si aucun événement correspondant n'est trouvé, rediriger vers la liste des événements
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur lors de la récupération des données de l'événement, rediriger vers la liste des événements avec un message d'erreur
        header("Location: index.php?error=1");
        exit();
    }
} else {
    // Si aucun identifiant d'événement n'est fourni dans l'URL, rediriger vers la liste des événements
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un événement</title>
    <!-- Inclure les liens vers Bootstrap et d'autres bibliothèques CSS/JS ici -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Modifier un événement</h1>
        <!-- Formulaire HTML pour la modification de l'événement -->
        <form action="traitement_modification_evenement.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $evenement['id_evenement']; ?>">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($evenement['titre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="legende" class="form-label">Légende</label>
                <textarea class="form-control" id="legende" name="legende" required><?php echo htmlspecialchars($evenement['legende']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="date_evenement" class="form-label">Date de l'événement</label>
                <input type="date" class="form-control" id="date_evenement" name="date_evenement" value="<?php echo htmlspecialchars($evenement['datevenement']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="pieces_evenement" class="form-label">Pièces jointes</label>
                <input type="file" class="form-control" id="pieces_evenement" name="pieces_evenement[]" multiple>
            </div>
            <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>

    <!-- Inclure les scripts JavaScript ici -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
