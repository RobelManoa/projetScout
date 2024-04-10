<?php
include '../base.php';
include './assets/password.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nom = $_POST['inputLastName'];
    $prenom = $_POST['inputFirstName'];
    $adresse = $_POST['inputEmail'];
    $mdp = $_POST['inputPassword'];
    $dates = $_POST['datRentre'];
    $categ = $_POST['categ'];

    if (!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($mdp) && !empty($categ) && !empty($dates)){
        // Echapper les variables pour éviter les injections SQL
        $nom = $conn->quote($nom);
        $prenom = $conn->quote($prenom);
        //$adresse = $conn->quote($adresse);
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        // Supprimer l'utilisation de quote pour les champs date et categ
        // $dates = $conn->quote($dates);
        // $categ = $conn->quote($categ);

        // Préparation de la requête SQL
        $insertonia = $conn->prepare("INSERT INTO demande (nom_resp, prenom_resp, mail_resp, mdp_resp, categories, date_demande) VALUES (:nom, :prenom, :adresse, :mdp, :categ, :dates)");
        // Liaison des paramètres
        $insertonia->bindParam(':nom', $nom);
        $insertonia->bindParam(':prenom', $prenom);
        $insertonia->bindParam(':adresse', $adresse);
        $insertonia->bindParam(':mdp', $mdp);
        $insertonia->bindParam(':categ', $categ);
        $insertonia->bindParam(':dates', $dates);
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
    <title>Mpiandraikitra</title>
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
                                    <h3 class="text-center font-weight-light my-4 ms-5">Hiditra ho Mpiandraikitra</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text"
                                                        placeholder="Anarana Fanampiny" name="inputFirstName" />
                                                    <label for="inputFirstName">Anarana Fanampiny</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputLastName" type="text"
                                                        placeholder="Anarana" name="inputLastName" />
                                                    <label for="inputLastName">Anarana</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email"
                                                placeholder="Adresse Mail" name="inputEmail" />
                                            <label for="inputEmail">Adresse Mail</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" type="password"
                                                        placeholder="Teny Miafina" name="inputPassword" />
                                                    <label for="inputPassword">Teny Miafina</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm" type="date"
                                                        placeholder="Daty nidirana skoto" name="datRentre" />
                                                    <label for="datRentre">Daty nidirana skoto</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select name="categ" class="form-select">
                                                        <option value="1">Mavo</option>
                                                        <option value="2">Maintso</option>
                                                        <option value="3">Mena</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary btn-block" value="Alefa">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Efa Mpiandraikitra?</a></div>
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