<?php
session_start();
include '../base.php';

// Vérifier si l'utilisateur est connecté
if ((!isset($_SESSION["nom_admin"]) || empty($_SESSION["nom_admin"])) && (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"]))) {
    // Les sessions ne sont pas définies ou sont vides
    // Autoriser l'accès à la page
    header("Location: login.php");
    exit();
}

// Initialiser la variable $userData
$userData = array();

// Récupérer le nom de l'utilisateur à partir de l'URL
if (isset($_GET['profile'])) {
    $nom_utilisateur = $_GET['profile'];
} else {
    // Rediriger vers la page de connexion si aucun nom d'utilisateur n'est fourni dans l'URL
    header("Location: login.php");
    exit();
}

// Récupérer les données de l'utilisateur à partir de la base de données
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare("SELECT idAdmin, nom_admin, prenom_admin, residence_admin, age_admin, mail_admin, contact_admin, id_responsabilite, date_inscription, totem, photo FROM admins WHERE nom_admin = :nom");
    $query->bindParam(":nom", $nom_utilisateur);
    $query->execute();

    // Vérifier si la requête a retourné des résultats
    if ($query->rowCount() > 0) {
        // Récupérer les données de l'utilisateur
        $userData = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        // Rediriger vers la page de connexion si aucun utilisateur correspondant n'est trouvé
        header("Location: login.php");
        exit();
    }
} catch (PDOException $e) {
    // En cas d'erreur lors de la récupération des données de l'utilisateur, afficher un message d'erreur
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="row center">
                <div class="col-md-6 ps-5">
                    <h2>Profile de
                        <?php echo $_SESSION["nom_admin"]; ?>
                    </h2>
                    <?php if (!empty($userData)): ?>
                        <ul>
                            <li>Nom :
                                <?php echo $userData['nom_admin']; ?>
                            </li>
                            <li>Prenom :
                                <?php echo $userData['prenom_admin']; ?>
                            </li>
                            <li>Résidence :
                                <?php echo $userData['residence_admin']; ?>
                            </li>
                            <li>
                                Date de naissance : <?php echo $userData['age_admin']; ?>
                            </li>
                            <li>Age Actuel:
                                <?php
                                $dateNaissance = $userData['age_admin'];
                                $timestampDateNaissance = strtotime($dateNaissance);
                                $age = floor((time() - $timestampDateNaissance) / 31556926);
                                echo $age;
                                echo " ans";
                                ?>

                            </li>
                            <li>Adresse mail :
                                <?php echo $userData['mail_admin']; ?>
                            </li>
                            <li>Contact :
                                <?php echo "0";
                                echo $userData['contact_admin']; ?>
                            </li>
                            <li>Date inscription :
                                <?php echo $userData['date_inscription']; ?>
                            </li>
                            <li>Totem :
                                <?php echo $userData['totem']; ?>
                            </li>
                        </ul>
                        <a href="edit.php?id=<?php echo $userData['idAdmin']; ?>" class="btn btn-primary">Modifier</a>
                    <?php endif; ?>
                    <?php
                    if (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"])) {
                        echo '<a href="../mpiandraikitra/index.php?mpiandraikitra="' . $_SESSION["nom_admin"] . '" class="btn btn-primary">Retour</a>';
                        exit();
                    } else {
                        echo '<a href="../tonia/index.php?tonia="' . $_SESSION["tonia_nom"] . '" class="btn btn-primary">Retour</a>';
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    <div class="container">
                        <img src='<?php echo $userData['photo']; ?>' alt="pdp" class="w-100 h-50">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>