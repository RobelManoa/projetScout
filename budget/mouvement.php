<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $types = $_POST['type'];
    $motif = $_POST['motif'];
    $montant = $_POST['montant'];
    $dates = $_POST['dates'];
    $resp = $_POST['resp'];

    if (!empty($types) && !empty($motif) && !empty($montant) && !empty($dates)) {
        include '../base.php';
        $lastCaisse = $conn->query("SELECT fond FROM caisse ORDER BY id_caisse DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $lastReste = $lastCaisse['fond'];
        if ($types == 1) {
            $newReste = $lastReste + $montant;
        } elseif ($types == 2) {
            $newReste = $lastReste - $montant;
        }

        $updateCaisse = $conn->prepare("INSERT INTO caisse(fond, dates) VALUES (:newReste, :dates)");
        $updateCaisse->bindParam(":newReste", $newReste);
        $updateCaisse->bindParam(":dates", $dates);
        $updateCaisse->execute();

        $bouger = $conn->prepare("INSERT INTO mouvement(types, motif, montant, dates_mouvement, responsable) VALUES (:types, :motif, :montant, :dates, :resp)");
        $bouger->bindParam(":types", $types);
        $bouger->bindParam(":motif", $motif);
        $bouger->bindParam(":montant", $montant);
        $bouger->bindParam(":dates", $dates);
        $bouger->bindParam(":resp", $resp);
        $bouger->execute();

        header('location: index.php');
    } else {
        echo "Complétez tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mouvement</title>
</head>

<body>
    <form action="./mouvement.php" method="post">
        <label for="type" class="form-label">Type de transaction</label>
        <select name="type" id="" class="form-select">
            <option value="1">Débit</option>
            <option value="2">Retrait</option>
        </select>
        <label for="motif" class="form-label">Motife du transaction</label>
        <input type="text" name="motif" id="" class="form-control">
        <label for="montant" class="form-label">Montant</label>
        <input type="number" name="montant" id="" class="form-control">
        <label for="dates" class="form-label">Dates</label>
        <input type="date" name="dates" id="" class="form-control">
        <label for="resp" class="form-label">Responsable</label>
        <input type="text" name="resp" id="" value="<?php if (isset($_SESSION["nom_admin"])) {
            echo htmlspecialchars($_SESSION["nom_admin"]);
        }  else {
            echo htmlspecialchars($_SESSION["tonia_nom"]);
        } ?>" readonly class="form-control">
        <input type="submit" value="Valider" class="btn btn-outline-primary mt-4">
    </form>
</body>

</html>