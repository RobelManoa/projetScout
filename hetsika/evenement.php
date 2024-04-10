<?php
include '../base.php'; // Inclure le fichier de connexion à la base de données

// Récupérer tous les événements depuis la base de données
$stmt = $conn->query('SELECT * FROM evenement ORDER BY datevenement DESC');
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des publications</title>
    <!-- Inclure les liens vers Bootstrap et d'autres bibliothèques CSS/JS ici -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Liste des publications</h1>
        <div class="row">
            <?php foreach ($evenements as $evenement): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title"><?php echo htmlspecialchars($evenement['titre']); ?></h5>
                                </div>
                                <div class="col-md-6">
                                    <a href="modifier_evenement.php?id=<?php echo $evenement['id_evenement']; ?>"
                                        class="btn btn-primary float-end"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="supprimer_evenement.php?id=<?php echo $evenement['id_evenement']; ?>"
                                        class="btn btn-danger float-end me-2"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>
                            <p class="card-text"><?php echo htmlspecialchars($evenement['legende']); ?></p>
                            <p class="card-text">Date de l'événement :
                                <?php echo htmlspecialchars($evenement['datevenement']); ?></p>
                            <!-- <p class="card-text">Responsable : <?php echo htmlspecialchars($evenement['responsable']); ?>
                            </p> -->
                            <?php
                            // Convertir les pièces jointes JSON en tableau PHP
                            $pieces_evenement = json_decode($evenement['piece_evenement']);
                            if (!empty($pieces_evenement)) {
                                echo '<p class="card-text">Pièces jointes :</p>';
                                echo '<ul>';
                                foreach ($pieces_evenement as $piece) {
                                    echo '<li><a href="' . htmlspecialchars($piece) . '">' . basename($piece) . '</a></li>';
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Inclure les scripts JavaScript ici -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>