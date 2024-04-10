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
include '../assets/head.php';
?>


<body>
    <div class="container mt-4">
        <div class="card">
            <div class="row center">
                <div class="col-md-6 ps-5">
                    <h2>Profile de
                        <?php echo $_SESSION["tonia_nom"]; ?>
                    </h2>
                    <ul>
                        <li>Nom :
                            <?php echo $userData['nom_tonia']; ?>
                        </li>
                        <li>Prenom :
                            <?php echo $userData['prenom_tonia']; ?>
                        </li>
                        <li>Date de naissance :
                            <?php echo $userData['date_naissance']; ?>
                        </li>
                        <li>Adresse mail :
                            <?php echo $userData['mail']; ?>
                        </li>
                        <li>Année dirigé :
                            <?php echo $userData['date_dirige']; ?>
                        </li>
                        <li>Totem :
                            <?php echo $userData['totem']; ?>
                        </li>
                    </ul>
                    <a href="edit.php" class="btn btn-primary">Modifier</a>
                    <a href="index.php" class="btn btn-outline-primary">Revenir à l'accueil</a>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <img src="<?php echo $userData['photo']; ?>" alt="" class="w-100 h-50">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>