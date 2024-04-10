<?php
session_start();
include '../base.php';

// // Vérifier si l'utilisateur est connecté
// if (!isset($_SESSION["nom_admin"]) || empty($_SESSION["nom_admin"])) {
//     header("location: login.php");
//     exit();
// }

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
            $num_beazina = $userData['contact_beazina'];
            $pere = $userData['nom_pere'];
            $contact_pere = $userData['contact_pere'];
            $mere = $userData['nom_mere'];
            $contact_mere = $userData['contact_mere'];
            $adresse = $userData['adresse_beazina'];
            $inscription = $userData['date_inscriptionb'];
            $ecole = $userData['ecole'];
            $totem = $userData['totem'];
            $photo = $userData['photo'];
            $exploit = $userData['exploits'];
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
    <title>Profile</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <h2>Profile de </h2>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Nom :
                                    <?php echo $nom; ?>
                                </li>
                                <li>Prenom :
                                    <?php echo $prenom ?>
                                </li>
                                <li>Contact :</li>
                                <li>Date de naissance :
                                    <?php echo $date_naissance; ?>/ <span>Âge actuel :</span>
                                </li>
                                <li>Date Inscription :
                                    <?php echo $inscription; ?>
                                </li>
                                <li>Totem :
                                    <?php echo $totem; ?>
                                </li>
                                <li>Catégorie :
                                    <?php $categorie = $userData['categories'];
                                    if ($categorie == 1) {
                                        echo 'Mavo';
                                    } elseif ($categorie == 2) {
                                        echo 'Maintso';
                                    } elseif ($categorie == 3) {
                                        echo 'Mena';
                                    } else {
                                        echo 'Autre';
                                    } ?>
                                </li>
                                <li>Exploits :
                                    <?php echo $exploit; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Nom du père :
                                    <?php echo $pere; ?>/ <span><b>Contact :
                                            <?php echo $contact_pere; ?>
                                        </b></span>
                                </li>
                                <li>Nom de la mère :
                                    <?php echo $mere; ?>/ <span><b>Contact :
                                            <?php echo $contact_mere; ?>
                                        </b></span>
                                </li>
                                <li>Adresse :
                                    <?php echo $adresse; ?>
                                </li>
                                <li>Ecole :
                                    <?php echo $ecole; ?>
                                </li>
                            </ul>
                            <a href="./edit.php?id=<?php echo $userId; ?>" class="btn btn-info">Modifier</a>
                            <a href="./list.php" class="btn btn-primary">Retour</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 colsm-12">
                    <div class="ps-5">
                        <img src="<?php echo $photo; ?>" alt="" style="width: 50%; height:50%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>