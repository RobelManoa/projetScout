<?php
session_start();
include '../base.php';
if (!isset($_SESSION["nom_admin"]) || empty($_SESSION["nom_admin"])) {
    if (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"])) {
        header("Location: ../index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Mpiandraikitra</title>
</head>

<body>
    <div class="container mt-3">
        <h2>Lisitry ny Mpiandraikitra</h2>
        <p>Lisitry ny mpiandraikitra ao amin'ny Sampana Tily</p>
        <div class="row mb-3">
            <div class="col-md-6">
                <input class="form-control" id="searchInput" type="text" placeholder="Recherche...">
            </div>
            <div class="col-md-6">
                <div class="btn-group" role="group">
                    <a href="?filter=1" class="btn btn-warning">Mavo</a>
                    <a href="?filter=2" class="btn btn-success">Maintso</a>
                    <a href="?filter=3" class="btn btn-danger">Mena</a>
                    <a href="?" class="btn btn-light">Rehetra</a>
                </div>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Anarana</th>
                    <th>Fanampiny</th>
                    <th>Solon'anarana</th>
                    <th>Sampana</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
                $filterCondition = '';
                if (!empty($filter)) {
                    $filterCondition = ' WHERE id_responsabilite = :category';
                }

                $query = $conn->prepare('SELECT * FROM admins' . $filterCondition);
                if (!empty($filter)) {
                    $query->bindParam(':category', $filter);
                }
                $query->execute();

                while ($user = $query->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $user['nom_admin'] . '</td>';
                    echo '<td>' . $user['prenom_admin'] . '</td>';
                    echo '<td>' . $user['totem'] . '</td>';
                    echo '<td>';
                    $categorie = $user['id_responsabilite'];
                    if ($categorie == 1) {
                        echo 'Mavo';
                    } elseif ($categorie == 2) {
                        echo 'Maintso';
                    } elseif ($categorie == 3) {
                        echo 'Mena';
                    } else {
                        echo 'Autre';
                    }
                    echo '</td>';
                    echo '<td>';
                    echo '<a href="profile.php?id=' . $user['idAdmin'] . '" class="btn btn-info me-2"><i class="fa-solid fa-eye"></i></a>';
                    echo '<a href="delete.php?id=' . $user['idAdmin'] . '" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php

        if (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"])) {
            echo '<a href="../mpiandraikitra/index.php?mpiandraikitra="' . $_SESSION["nom_admin"] . '" class="btn btn-primary">Retour</a>';
            exit();
        } else {
            echo '<a href="../tonia/index.php?tonia="' . $_SESSION["tonia_nom"] . '" class="btn btn-primary">Retour</a>';
        }
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('searchInput').addEventListener('input', function (event) {
                const searchQuery = event.target.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const name = row.querySelectorAll('td')[0].textContent.toLowerCase();
                    const surname = row.querySelectorAll('td')[1].textContent.toLowerCase();
                    if (name.includes(searchQuery) || surname.includes(searchQuery)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>