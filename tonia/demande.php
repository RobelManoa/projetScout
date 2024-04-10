<?php
session_start();
include '../base.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["tonia_nom"]) || empty($_SESSION["tonia_nom"])) {
    header("location: login.php");
    exit();
}

// Récupérer les demandes de la base de données
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare("SELECT * FROM demande");
    $query->execute();

    $demandes = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
include '../assets/head.php';
?>


<body>
    <div class="container">
        <div class="row">
            <h2>Listry ny fangatahana ho mpiandraikitra</h2>
            <div class="card-body">
                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th>Anarana</th>
                            <th>Fanampiny</th>
                            <th>Sampana</th>
                            <th>Mailaka</th>
                            <th>Taona andraiketana</th>
                            <th>Fanampankevitra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($demandes as $demande): ?>
                            <tr>
                                <td>
                                    <?php echo $demande['nom_resp']; ?>
                                </td>
                                <td>
                                    <?php echo $demande['prenom_resp']; ?>
                                </td>
                                <td>
                                    <?php
                                    // Afficher le nom de la catégorie en fonction de la valeur
                                    if ($demande['categories'] == 1) {
                                        echo "Mavo";
                                    } elseif ($demande['categories'] == 2) {
                                        echo "Maintso";
                                    } elseif ($demande['categories'] == 3) {
                                        echo "Mena";
                                    } else {
                                        echo "Autre";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $demande['mail_resp']; ?>
                                </td>
                                <td>
                                    <?php echo $demande['date_demande']; ?>
                                </td>
                                <td>
                                    <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    <a href="ajout_admin.php?id_demande=<?php echo $demande['id_demande']; ?>&nom_resp=<?php echo $demande['nom_resp']; ?>&prenom_resp=<?php echo $demande['prenom_resp']; ?>&mail_resp=<?php echo $demande['mail_resp']; ?>&mdp_resp=<?php echo $demande['mdp_resp']; ?>&categories=<?php echo $demande['categories']; ?>&date_demande=<?php echo $demande['date_demande']; ?>"
                                        class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-primary">Miverina</a>
            </div>
        </div>
    </div>
</body>

</html>