<?php
session_start(); // Démarrez la session

// Vérifiez si l'utilisateur est authentifié
if (!isset($_SESSION['utilisateur_id'])) {
    // Redirigez vers la page de connexion s'il n'est pas authentifié
    header("Location: login.php");
    exit();
}

// Récupérez l'identifiant de l'utilisateur à partir de la session
$id_utilisateur = $_SESSION['utilisateur_id'];
?>
