<?php
include '../base.php';
include './assets/password.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nom = $_POST['inputLastName'];
    $prenom = $_POST['inputFirstName'];
    $mail = $_POST['inputEmail'];
    $mdp = $_POST['inputPassword'];
    $totem = $_POST['totem'];
    $naissance = $_POST['datenaissance'];
    $dirige = $_POST['datedirige'];

    // Vérification des champs
    if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($mdp) && !empty($totem) && !empty($dirige) && !empty($naissance)) {
        // Echapper les variables pour éviter les injections SQL
        $nom = $conn->quote($nom);
        $prenom = $conn->quote($prenom);
        $mail = $conn->quote($mail);
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        $totem = $conn->quote($totem);
        $naissance = $conn->quote($naissance);
        $dirige = $conn->quote($dirige);

        // Préparation de la requête SQL
        $insertonia = $conn->prepare("INSERT INTO tonia (nom_tonia, prenom_tonia, date_naissance, mail, mdp_tonia, date_dirige, totem) VALUES (:nom, :prenom, :naissance, :mail, :mdp, :dirige, :totem)");
        // Liaison des paramètres
        $insertonia->bindParam(':nom', $nom);
        $insertonia->bindParam(':prenom', $prenom);
        $insertonia->bindParam(':naissance', $naissance);
        $insertonia->bindParam(':mail', $mail);
        $insertonia->bindParam(':mdp', $mdp);
        $insertonia->bindParam(':dirige', $dirige);
        $insertonia->bindParam(':totem', $totem);
        // Exécution de la requête
        $insertonia->execute();
        header('Location: login.php');
        exit(); // Terminer le script après la redirection
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tonia</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header d-flex" style="align-items: center;"><img
                                        src="https://upload.wikimedia.org/wikipedia/fr/e/e4/Logo_Tily_eto_Madagasikara.svg"
                                        alt="" class="w-25 h-25">
                                    <h3 class="text-center font-weight-light my-4 ms-5">Hiditra ho Tonia</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="register.php">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="inputFirstName"
                                                        id="inputFirstName" type="text"
                                                        placeholder="Enter your first name" />
                                                    <label for="inputFirstName">Anarana Fanampiny</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input class="form-control" name="inputLastName" id="inputLastName"
                                                        type="text" placeholder="Enter your last name" />
                                                    <label for="inputLastName">Anarana</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="totem" id="totem" type="text"
                                                        placeholder="Totem" />
                                                    <label for="totem">Solon'anarana</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="inputEmail" id="inputEmail"
                                                        type="email" placeholder="anarana@example.com" />
                                                    <label for="inputEmail">Adresse Mail</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="inputPassword" id="inputPassword"
                                                        type="password" placeholder="Teny miafina" />
                                                    <label for="inputPassword">Teny Miafina</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" name="datenaissance" id="datenaissance"
                                                        type="date" />
                                                    <label for="datenaissance">Daty nahaterahana</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" name="datedirige" id="datedirige"
                                                        type="date" />
                                                    <label for="datedirige">Fotoana nitondrana</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"> <input type="submit" class="btn btn-primary btn-block"
                                                    value="Alefa"></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Efa Tonia?</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>