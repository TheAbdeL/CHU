<?php
@include 'bdd.php';

// Vérifiez si l'utilisateur est authentifié
include 'verifier_auth.php';

//? echo "Bienvenue sur votre page, utilisateur $id_utilisateur!";

// Récupérer l'ID depuis le paramètre d'URL
$idElement = $_GET['id'] ?? '';

// Assurez-vous que l'ID est un nombre entier valide
$idElement = filter_var($idElement, FILTER_VALIDATE_INT);

if ($idElement === false || $idElement === null) {
    // Gérer le cas où l'ID n'est pas valide
    echo "ID non valide.";
    exit;
}

$sql = "SELECT lm FROM demande WHERE id_etudiant = $idElement";
$res = mysqli_query($conn,$sql);
if(mysqli_num_rows($res)>0){
    while($row = mysqli_fetch_array($res)){
        if (!empty($row['lm'])) {
            $lmDeserialized = unserialize($row['lm']);
        
            if ($lmDeserialized !== false) {
                // Création d'un fichier temporaire pour le téléchargement
                
                echo "<embed src='data:application/pdf;base64," . base64_encode($lmDeserialized) . "' type='application/pdf' width='100%' height='600px'>";
                
            } else {
                // La désérialisation a échoué
                echo "Échec de la désérialisation du LM.";
            }
        }
    } 
}







?>