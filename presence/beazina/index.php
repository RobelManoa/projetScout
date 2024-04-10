<?php
session_start();
include '../../base.php';

// Vérifier si l'utilisateur est connecté
if ((!isset($_SESSION["nom_admin"]) || empty($_SESSION["nom_admin"])) && (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"]))) {
    header("Location: login.php");
    exit();
} else {
    echo '<h1 class="text-center">Présence des Beazina</h1>';
}

// Récupérer les catégories de beazina depuis la base de données
try {
    $query = $conn->query("SELECT id_beazina, prenom_beazina, categories FROM beazina");
    $beazinaData = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Enregistrer la présence dans la base de données
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_presence'])) {
    // Récupérer les beazina présents depuis le formulaire
    $presentBeazinaIds = isset($_POST['beazina']) ? $_POST['beazina'] : array();

    // Récupérer la date actuelle
    $currentDate = date("Y-m-d");

    // Préparer la requête pour insérer la présence dans la table presence_beazina
    $stmt = $conn->prepare("INSERT INTO presence_beazina (id_beazinaP, categ_beazina, dates_present, presence) VALUES (:id_beazina, :categorie, :date_presence, 1)");

    // Parcourir les beazina présents et les enregistrer dans la base de données
    foreach ($presentBeazinaIds as $beazinaId) {
        try {
            // Exécuter la requête en liant les paramètres
            $stmt->bindParam(":id_beazina", $beazinaId);
            $stmt->bindValue(":categorie", 1); // Remplacez 1 par la catégorie appropriée
            $stmt->bindParam(":date_presence", $currentDate);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    // Rediriger ou afficher un message de confirmation
    // header("Location: nom_de_la_page.php");
    // exit();
}
?>

<?php
    include '../../assets/head.php';
?>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="categorie" class="form-label">Catégorie :</label>
                        <select class="form-select" id="categorie" name="categorie">
                            <option value="0">Toutes les catégories</option>
                            <option value="1">Mavo</option>
                            <option value="2">Maintso</option>
                            <option value="3">Mena</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </form>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <table class="table table-hover mt-3">
                        <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Catégorie</th>
                                <th>Présent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['categorie'])) {
                                $selectedCategory = $_POST['categorie'];
                                foreach ($beazinaData as $beazina) {
                                    if ($selectedCategory == 0 || $beazina['categories'] == $selectedCategory) {
                                        echo '<tr>';
                                        echo '<td>' . $beazina['prenom_beazina'] . '</td>';
                                        echo '<td>';
                                        switch ($beazina['categories']) {
                                            case 1:
                                                echo 'Mavo';
                                                break;
                                            case 2:
                                                echo 'Maintso';
                                                break;
                                            case 3:
                                                echo 'Mena';
                                                break;
                                            default:
                                                echo 'Autre';
                                                break;
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<input type="checkbox" name="beazina[]" value="' . $beazina['id_beazina'] . '">';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <button type="submit" name="save_presence" class="btn btn-primary">Enregistrer la présence</button>
                </form>
            </div>
            <div class="col-md-6">
                <?php
                include 'table.php';

                if (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"])) {
                    echo '<a href="../../mpiandraikitra/index.php?mpiandraikitra="' . $_SESSION["nom_admin"] . '" class="btn btn-primary">Retour</a>';
                    exit();
                } else {
                    echo '<a href="../../tonia/index.php?tonia="' . $_SESSION["tonia_nom"] . '" class="btn btn-primary">Retour</a>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>