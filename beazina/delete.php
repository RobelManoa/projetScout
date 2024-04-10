<?php
// Inclure le fichier de connexion à la base de données
include '../base.php';

// Vérifier si un identifiant d'événement a été fourni dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'identifiant de l'événement depuis l'URL
    $id_evenement = $_GET['id'];

    // Supprimer l'événement correspondant de la base de données
    try {
        $query = $conn->prepare("DELETE FROM beazina WHERE id_beazina = :id");
        $query->bindParam(":id", $id_evenement);
        $query->execute();

        // Rediriger vers la page principale avec un message de succès
        header("Location: list.php?success=1");
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, rediriger vers la page principale avec un message d'erreur
        header("Location: list.php?error=1");
        exit();
    }
} else {
    // Si aucun identifiant d'événement n'est fourni, rediriger vers la page principale
    header("Location: list.php");
    exit();
}
?>
