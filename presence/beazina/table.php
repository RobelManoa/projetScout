
<div class="card-header">
    <i class="fas fa-table me-1"></i>
    Lisitry ny Beazina
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
            $beazinas = $conn->query('SELECT * FROM beazina');
            while ($beazina = $beazinas->fetch()) {
                $beazinaId = $beazina['id_beazina'];
                // Récupérer la somme des présences de chaque beazina depuis la table presence_beazina
                $stmt = $conn->prepare("SELECT COUNT(*) AS total_presence FROM presence_beazina WHERE id_beazinaP = :beazinaId");
                $stmt->bindParam(":beazinaId", $beazinaId);
                $stmt->execute();
                $totalPresence = $stmt->fetchColumn();

                echo '
            <tr>
                <td>' . $beazina['nom_beazina'] . '</td>
                <td>' . $beazina['prenom_beazina'] . '</td>
                <td>';
                $categorie = $beazina['categories'];
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>