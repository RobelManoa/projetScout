<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un événement</h2>
        <form action="traitement_formulaire.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre de l'événement</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="legende" class="form-label">Légende</label>
                <textarea class="form-control" id="legende" name="legende" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="date_publication" class="form-label">Date de publication</label>
                <input type="date" class="form-control" id="date_publication" name="date_publication" required>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
            </div>
            <div class="mb-3">
                <label for="pieces_jointes" class="form-label">Pièces jointes (PDF, Excel, Word, vidéos, etc.)</label>
                <input type="file" class="form-control" id="pieces_jointes" name="pieces_jointes[]" multiple accept=".pdf,.xls,.xlsx,.doc,.docx,.ppt,.pptx,.mp4,.avi,.mov">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter l'événement</button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
