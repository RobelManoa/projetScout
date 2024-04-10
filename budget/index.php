<?php
session_start();
include '../base.php';
if ((!isset($_SESSION["nom_admin"]) || empty($_SESSION["nom_admin"])) && (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"]))) {
    header("Location: login.php");
    exit();
} else {
    echo '<h1 class="text-center">Budget Sampana Tily</h1>';
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget</title>
</head>

<body>


    <div class="container mt-3">
        <h2>Gestion des Budgets</h2>
        <br>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home">Historique</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#menu1">Nouvelle transaction</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>
                <h3>Historique</h3>
                <?php include 'historique.php'; ?>
            </div>
            <div id="menu1" class="container tab-pane fade"><br>
                <h3>Transaction</h3>
                <?php include 'mouvement.php'; ?>
            </div>
        </div>
        <?php

        if (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"])) {
            echo '<a href="../mpiandraikitra/index.php?mpiandraikitra="' . $_SESSION["nom_admin"] . '" class="btn btn-primary">Retour</a>';
            exit();
        } else {
            echo '<a href="../tonia/index.php?tonia="' . $_SESSION["tonia_nom"] . '" class="btn btn-primary">Retour</a>';
        }
        ?>
    </div>
</body>

</html>