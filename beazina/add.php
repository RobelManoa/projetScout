<?php
session_start();
include '../base.php';

// if (!isset($_SESSION["nom_admin"]) || !isset($_SESSION["tonia_nom"])) {
//     header("location: login.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $nom_beazina = $_POST['name'];
    $prenom_beazina = $_POST['fanampiny'];
    $date_naissance = $_POST['birthday'];
    $contact_beazina = $_POST['contacts'];
    $categories = $_POST['categ'];
    $nom_pere = $_POST['dada'];
    $contact_pere = $_POST['contactra'];
    $nom_mere = $_POST['neny'];
    $contact_mere = $_POST['contactre'];
    $date_inscription = $_POST['datetily'];
    $adresse_beazina = $_POST['adresse'];
    $ecole = $_POST['ecole'];
    $totem = $_POST['totem'];

    // Préparer la requête d'insertion
    $insertQuery = $conn->prepare("INSERT INTO beazina (nom_beazina, prenom_beazina, date_naissance, contact_beazina, categories, nom_pere, contact_pere, nom_mere, contact_mere, date_inscriptionb, adresse_beazina, ecole, totem) VALUES (:nom_beazina, :prenom_beazina, :date_naissance, :contact_beazina, :categories, :nom_pere, :contact_pere, :nom_mere, :contact_mere, :date_inscription, :adresse_beazina, :ecole, :totem)");

    // Liaison des paramètres
    $insertQuery->bindParam(':nom_beazina', $nom_beazina);
    $insertQuery->bindParam(':prenom_beazina', $prenom_beazina);
    $insertQuery->bindParam(':date_naissance', $date_naissance);
    $insertQuery->bindParam(':contact_beazina', $contact_beazina);
    $insertQuery->bindParam(':categories', $categories);
    $insertQuery->bindParam(':nom_pere', $nom_pere);
    $insertQuery->bindParam(':contact_pere', $contact_pere);
    $insertQuery->bindParam(':nom_mere', $nom_mere);
    $insertQuery->bindParam(':contact_mere', $contact_mere);
    $insertQuery->bindParam(':date_inscription', $date_inscription);
    $insertQuery->bindParam(':adresse_beazina', $adresse_beazina);
    $insertQuery->bindParam(':ecole', $ecole);
    $insertQuery->bindParam(':totem', $totem);

    // Exécution de la requête d'insertion
    $insertQuery->execute();

    // Redirection vers une page de confirmation ou une autre page appropriée
    header("Location: index.php");
    exit(); // Terminer le script après la redirection
}
?>

<?php
include '../assets/head.php';
?>

<head>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Inscription</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Anarana" name="name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Fanampiny" name="fanampiny">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1 js-datepicker" type="text" placeholder="Nahaterahana"
                                        name="birthday">
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Finday" name="contacts">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="categ">
                                    <option disabled="disabled" selected="selected">Sampana</option>
                                    <option value="1">Mavo</option>
                                    <option value="2">Maintso</option>
                                    <option value="2">Mena</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Anarani'i Ray" name="dada">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Finday" name="contactra">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Anarani'i Reny" name="neny">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Finday" name="contactre">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1 js-datepicker" type="text" placeholder="Nidirana Tily"
                                        name="datetily">
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Fonenana" name="adresse">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Toerana Enarana"
                                        name="ecole">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Totem" name="totem">
                                </div>
                            </div>
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Ampidirina</button>
                            <?php
                            if (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"])) {
                                echo '<a href="../mpiandraikitra/index.php?mpiandraikitra="' . $_SESSION["nom_admin"] . '" class="btn btn-primary">Retour</a>';
                                exit();
                            } else {
                                echo '<a href="../../tonia/index.php?tonia="' . $_SESSION["tonia_nom"] . '" class="btn btn-primary">Retour</a>';
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include '../assets/foot.php';
    ?>

</body>

</html>