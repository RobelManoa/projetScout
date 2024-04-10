<?php
session_start();

include("../base.php");
include_once("../assets/password.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = $_POST["inputEmail"];
    $mdp = $_POST["inputPassword"];

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("SELECT * FROM tonia WHERE mail = :mail");
        $query->bindParam(":mail", $mail);
        $query->execute();

        $rowCount = $query->rowCount();

        if ($rowCount > 0) {
            $admin = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($mdp, $admin["mdp_tonia"])) {
                $_SESSION["tonia_id"] = $admin["id_tonia"];
                $_SESSION["tonia_nom"] = $admin["nom_tonia"];
                header("Location: index.php?tonia=".$_SESSION['tonia_nom']);
                exit();
            } else {
                echo "Mot de passe incorrect";
                exit();
            }
        } else {
            echo "Admin introuvable avec l'adresse mail: $mail";
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
include '../assets/head.php';
?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header d-flex align-content-center"><img src="https://upload.wikimedia.org/wikipedia/fr/e/e4/Logo_Tily_eto_Madagasikara.svg" alt="" class="w-25 h-25"><h3 class="text-center font-weight-light my-4 ms-5">Connection Tonia</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="inputEmail" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Adresse Mail</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="inputPassword" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Mot de Passe</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input class="btn btn-primary" type="submit" value="Miditra">
                                                <a href="../" class="btn btn-primary">Miverina</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php
            include '../assets/foot.php';
        ?>
    </body>
</html>
