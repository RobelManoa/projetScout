<?php
session_start();
include '../base.php';
if (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"])) {
    header("location: login.php");
    exit();
}
?>
<?php
include '../assets/head.php';
?>

<head>
    <link href="styles.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">
            <?php echo $_SESSION["tonia_nom"]; ?>
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Rechercher ..." aria-label="Rechercher ..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="./profile.php">Kaonty</a></li>
                    <li><a class="dropdown-item" href="./demande.php">Fangatahana</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="./deconnexion.php">Mivoka</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Accueil</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Tableau de bord
                        </a>
                        <div class="sb-sidenav-menu-heading">Présence</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users-viewfinder"></i></div>
                            Présence
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../presence/mpiandraikitra/">Mpiandraikitra</a>
                                <a class="nav-link" href="../presence/beazina/">Beazina</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                            Gestion membre
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Hampiditra
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="../beazina/add.php">Beazina</a>
                                        <a class="nav-link" href="../mpiandraikitra/register.php">Mpiandraikitra</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Hijery
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="../beazina/list.php">Beazina</a>
                                        <a class="nav-link" href="../mpiandraikitra/list.php">Mpiandraikitra</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Budget</div>
                        <a class="nav-link" href="../budget/index.php#menu1">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                            Faire une transaction
                        </a>
                        <a class="nav-link" href="../budget/index.php#home">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                            Historique
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tableau de Bord</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Table Tonia</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Mpiandraikitra</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link"
                                        href="../mpiandraikitra/list.php">Miditra</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Beazina</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../beazina/list.php">Miditra</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Vola</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../budget/">Miditra</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Hetsika</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../hetsika/index.php">Miditra</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Tanjona sy tetikasa
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Fivoaran'ny vola
                                </div>
                                <?php
                                include '../assets/demo/vola.php';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Lisitry ny Mpiandraikitra
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Anarana</th>
                                        <th>Sampana</th>
                                        <th>Taona</th>
                                        <th>Kaontakita</th>
                                        <th>Fonenana</th>
                                        <th>Fahavitriana</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $admis = $conn->query('SELECT * FROM admins');
                                    while ($admin = $admis->fetch()) {
                                        $beazinaId = $admin['idAdmin'];
                                        // Récupérer la somme des présences de chaque beazina depuis la table presence_beazina
                                        $stmt = $conn->prepare("SELECT COUNT(*) AS total_presence FROM presence_admin WHERE id_admin_present = :beazinaId");
                                        $stmt->bindParam(":beazinaId", $beazinaId);
                                        $stmt->execute();
                                        $totalPresence = $stmt->fetchColumn();
                                        echo '
                                                <tr>
                                                <td>' . $admin['nom_admin'] . '</td>
                                                <td>' . $admin['id_responsabilite'] . '</td>
                                                <td>' . $admin['age_admin'] . '</td>
                                                <td>0' . $admin['contact_admin'] . '</td>
                                                <td>' . $admin['residence_admin'] . '</td>
                                                <td>' . $totalPresence . '</td>
                                            </tr>
                                                ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Sampana Tily 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php
    include '../assets/foot.php';
    ?>
</body>

</html>