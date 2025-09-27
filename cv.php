<?php
@include 'bdd.php';

// Vérifiez si l'utilisateur est authentifié
include 'verifier_auth.php';

// Récupérer l'ID depuis le paramètre d'URL
$idElement = $_GET['id'] ?? '';

// Assurez-vous que l'ID est un nombre entier valide
$idElement = filter_var($idElement, FILTER_VALIDATE_INT);

if ($idElement === false || $idElement === null) {
    // Gérer le cas où l'ID n'est pas valide
    echo "ID non valide.";
    exit;
}

$sql = "SELECT cv FROM demande WHERE id_etudiant = $idElement";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_array($res)) {
        if (!empty($row['cv'])) {
            $cvDeserialized = unserialize($row['cv']);

            if ($cvDeserialized !== false) {
                // Création d'un fichier temporaire pour le téléchargement
                ?>
                <!DOCTYPE html>
                <html lang="fr">

                <head>
                    <meta charset="UTF-8">
                    <title>Affichage du CV</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            overflow: hidden;
                        }

                        iframe {
                            width: 100%;
                            height: 100vh;
                            border: none;
                        }
                    </style>
                </head>

                <body>
                    <iframe src="data:application/pdf;base64,<?php echo base64_encode($cvDeserialized); ?>" type="application/pdf"></iframe>
                </body>

                </html>
                <?php
            } else {
                // La désérialisation a échoué
                echo "Échec de la désérialisation du CV.";
            }
        }
    }
}
?>




