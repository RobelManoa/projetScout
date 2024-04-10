<?php
include ("../base.php");
require_once ("assets/password.php");

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    // Récupérer les données de la demande
    $id_demande = $_GET['id_demande'];
    $nom_admin = $_GET['nom_resp'];
    $prenom_admin = $_GET['prenom_resp'];
    $mail_admin = $_GET['mail_resp'];
    $mdp_admin = $_GET['mdp_resp'];
    $categories = $_GET['categories'];
    $date_demande = $_GET['date_demande'];

    // Insérer les données dans la table 'admins'
    $insertAdmin = $conn->prepare("INSERT INTO admins (nom_admin, prenom_admin, mail_admin, mdp_admin, id_responsabilite, date_inscription) VALUES (:nom_admin, :prenom_admin, :mail_admin, :mdp_admin, :categories, :date_demande)");

    $insertAdmin->bindParam(':nom_admin', $nom_admin);
    $insertAdmin->bindParam(':prenom_admin', $prenom_admin);
    $insertAdmin->bindParam(':mail_admin', $mail_admin);
    $insertAdmin->bindParam(':mdp_admin', $mdp_admin);
    $insertAdmin->bindParam(':categories', $categories);
    $insertAdmin->bindParam(':date_demande', $date_demande);

    $insertAdmin->execute();

    // Supprimer les données de la demande de la table 'demande'
    $deleteDemande = $conn->prepare("DELETE FROM demande WHERE id_demande = :id_demande");
    $deleteDemande->bindParam(':id_demande', $id_demande);
    $deleteDemande->execute();

    // Rediriger vers la page d'attente
    header("Location: demande.php");
    exit();
}
?>