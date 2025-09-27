<?php
@include 'bdd.php';

// Vérifiez si l'utilisateur est authentifié
include 'verifier_auth.php';

if (isset($_POST['logout'])) {
    header('location:logout.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'étudiant</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .user-info {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .user-info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .user-info li {
            margin-bottom: 10px;
        }

        .logout-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .header-section h1 {
            color: #007bff;
            margin-top: 20px;
        }

        .demandes-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .demandes-table th,
        .demandes-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .demandes-table th {
            background-color: #007bff;
            color: #fff;
        }

        .demandes-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="user-info">
            <?php
            $query = "SELECT * FROM login WHERE id_login = $id_utilisateur";
            $resul = mysqli_query($conn, $query);
            if (mysqli_num_rows($resul) > 0) :
                while ($row = mysqli_fetch_assoc($resul)) :
            ?>
                    <ul>
                        <li><?php echo 'Nom : ' . $row['nom']; ?></li>
                        <li><?php echo 'Prenom : ' . $row['prenom']; ?></li>
                        <li><?php echo 'Login : ' . $row['login']; ?></li>
                        <li><a href="demandes.php">Plus</a></li>
                    </ul>
            <?php
                endwhile;
            endif;
            ?>
        </div>

        <form method="post" action="">
            <input type="submit" name="logout" class="logout-btn" value="Déconnecter" />
        </form>

        <div class="header-section">
            <h1>Votre demande :</h1>
        </div>

        <?php
        $id = "SELECT * FROM etudiant WHERE id_login = $id_utilisateur";
        $resultat = mysqli_query($conn, $id);
        if (mysqli_num_rows($resultat) > 0) {
            while ($row = mysqli_fetch_assoc($resultat)) {
                $id_etudiant = $row['id_etudiant'];
            }
        }

        $sql = "SELECT * FROM demande WHERE id_etudiant = $id_etudiant";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) :
        ?>
            <table class="demandes-table">
                <thead>
                    <tr>
                        <th>Date de demande</th>
                        <th>Status</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Date de prise</th>
                        <th>Date de cessation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['date_demande']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['date_debut']; ?></td>
                            <td><?php echo $row['date_fin']; ?></td>
                            <td><?php echo $row['date_prise']; ?></td>
                            <td><?php echo $row['date_cessation']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php
        endif;
        mysqli_close($conn);
        ?>
    </div>
</body>

</html>
