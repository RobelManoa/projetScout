<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Hetsika</title>
</head>

<body>
  <div class="container mt-3">
    <h2>Evènement dans la Catégories des éclaireurs</h2>
    <br>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#home">Publication</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#menu1">Nouvelle Publication</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#menu2">Sortir</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active"><br>
        <h3>Article publier</h3>
        <?php include './evenement.php'; ?>
      </div>
      <div id="menu1" class="container tab-pane fade"><br>
        <?php include './traitement_formulaire.php'; ?>
      </div>
      <div id="menu2" class="container tab-pane fade"><br>
        <h3>Sortir</h3>
        <?php
        if (!isset($_SESSION["tonia_id"]) || empty($_SESSION["tonia_nom"])) {
          echo '<a href="../mpiandraikitra/index.php?mpiandraikitra="' . $_SESSION["nom_admin"] . '" class="btn btn-primary">Retour</a>';
          exit();
        } else {
          echo '<a href="../tonia/index.php?tonia="' . $_SESSION["tonia_nom"] . '" class="btn btn-primary">Retour</a>';
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>