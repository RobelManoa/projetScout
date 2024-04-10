<?php
    include '../../assets/head.php';
?>
<div class="card-header">
    <i class="fas fa-table me-1"></i>
    Lisitry ny Mpiandraikitra
</div>
<div class="card-body">
    <table id="datatablesSimple" class="table table-bordered">
        <thead>
            <tr>
                <th>Anarana</th>
                <th>Fanampiny</th>
                <th>Sampana</th>
                <th>Totem</th>
                <th>Fahavitriana</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $beazinas = $conn->query('SELECT * FROM admins');
            while ($beazina = $beazinas->fetch()) {
                $beazinaId = $beazina['idAdmin'];
                // Récupérer la somme des présences de chaque beazina depuis la table presence_beazina
                $stmt = $conn->prepare("SELECT COUNT(*) AS total_presence FROM presence_admin WHERE id_admin_present = :beazinaId");
                $stmt->bindParam(":beazinaId", $beazinaId);
                $stmt->execute();
                $totalPresence = $stmt->fetchColumn();

                echo '
            <tr>
                <td>' . $beazina['nom_admin'] . '</td>
                <td>' . $beazina['prenom_admin'] . '</td>
                <td>';
                $categorie = $beazina['id_responsabilite'];
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
                echo '<td>' . $beazina['totem'] . '</td>
                <td>' . $totalPresence . '</td>
            </tr>';
            }
            ?>
        </tbody>
    </table>

</div>
<?php
include '../../assets/foot.php';
?>