<?php
@include 'bdd.php';

// Vérifiez si l'utilisateur est authentifié
include 'verifier_auth.php';

//? echo "Bienvenue sur votre page, utilisateur $id_utilisateur!";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Infos d'étudiant</title>
    <!-- Ajouter la référence à Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        h1 {
            text-align: left;
            color: #007bff;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        a {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div>
        <h1>Les informations d'étudiant :</h1>
    </div>
    <div>
        <?php
        // Vérifier si 'id' est défini dans l'URL
        if (isset($_GET['id'])) {
            // Récupérer l'ID depuis l'URL
            $id_etudiant = $_GET['id'];

            // Assurez-vous que l'ID est un nombre entier valide
            $id_etudiant = filter_var($id_etudiant, FILTER_VALIDATE_INT);

            if ($id_etudiant !== false && $id_etudiant !== null) {
                // L'ID est un nombre entier valide, utilisez-le dans la requête SQL
                $sql = "SELECT * FROM etudiant WHERE id_etudiant = $id_etudiant";
            } else {
                // L'ID n'est pas un nombre entier valide, traiter le cas correspondant
                echo "ID non valide.";
                // Ou redirigez vers une page d'erreur, par exemple
                // header("Location: erreur.php");
                exit;
            }
        } else {
            // Aucun ID n'a été passé dans l'URL, traiter le cas correspondant
            $sql = "SELECT * FROM etudiant WHERE id_login = $id_utilisateur";
        }

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) :
        ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th> Nom </th>
                        <th> Prenom </th>
                        <th> CIN </th>
                        <th> Tél </th>
                        <th> Email </th>
                        <th> Niveau </th>
                        <th> Etablissement </th>
                        <th> Service </th>
                        <th> CV </th>
                        <th> LM </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['prenom']; ?></td>
                            <td><?php echo $row['cin']; ?></td>
                            <td><?php echo $row['tel']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['niveau']; ?></td>
                            <td><?php echo $row['etablissement']; ?></td>
                            <td><?php echo $row['service']; ?></td>
                            <td><?php
                                    $idElement = $row['id_etudiant'];
                                    $linkToOtherPage = "cv.php?id=" . urlencode($idElement);
                                    ?>
                                <a href="<?php echo $linkToOtherPage; ?>">Voir CV</a>
                            </td>
                            <td><?php
                                    $linkToOtherPage = "lm.php?id=" . urlencode($idElement);
                                    ?>
                                <a href="<?php echo $linkToOtherPage; ?>">Voir LM</a>
                            </td>
                        </tr>
                    <?php
                        endwhile;
                    endif;
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
    </div>
</body>

</html>



