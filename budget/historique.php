<?php

$budgets = $conn->query('SELECT * FROM mouvement');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique</title>
</head>

<body>
    <table class="table table-hover">
        <thead>
            <th>Responsable</th>
            <th>Motife</th>
            <th>Type</th>
            <th>Dates</th>
            <th>Montant</th>
        </thead>
        <tbody>
            <?php
            while ($budget = $budgets->fetch()) {
                if ($budget['types'] == 1) {
                    $type = "Débit";
                }else {
                    $type = "Crédit";
                }
                echo '<tr>
                    <td>'.$budget['responsable'].'</td>
                    <td>'.$budget['motif'].'</td>
                    <td>'.$type.'</td>
                    <td>'.$budget['dates_mouvement'].'</td>
                    <td>'.$budget['montant'].'</td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>