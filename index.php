<?php
include 'base.php';
$stmt = $conn->query('SELECT * FROM evenement ORDER BY datevenement DESC');
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
include 'assets/head.php';
?>
<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">
                <img src="https://upload.wikimedia.org/wikipedia/fr/e/e4/Logo_Tily_eto_Madagasikara.svg" alt=""
                    style="width: 50px; height:50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="tonia/">Tonia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mpiandraikitra/">Mpiandraikitra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mpiandraikitra/register.php">Hiditra ho Mpiandraikitra</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <?php foreach ($evenements as $evenement): ?>
            <div class="card mb-3 p-5">
                <div class="row">

                    <div class="col-md-6">
                        <h2><?php echo htmlspecialchars($evenement['titre']); ?></h2>
                        <i><?php echo htmlspecialchars($evenement['datevenement']); ?></i>
                        <p><?php echo htmlspecialchars($evenement['responsable']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php
                        // Convertir les pièces jointes JSON en tableau PHP
                        $pieces_evenement = json_decode($evenement['piece_evenement']);
                        if (!empty($pieces_evenement)) {
                            echo '<p class="card-text">Pièces jointes :</p>';
                            echo '<ul>';
                            foreach ($pieces_evenement as $piece) {
                                echo '<li><a href="hetsika/' . htmlspecialchars($piece) . '">' . basename($piece) . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>