<?php
@include 'bdd.php';

// Vérifiez si l'utilisateur est authentifié
include 'verifier_auth.php';

// Le reste du code de votre page va ici
//? echo "Bienvenue sur votre page, utilisateur $id_utilisateur!";



if (isset($_POST['logout'])) {
    header('location:logout.php');

}
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>page de chef</title> 
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding: 20px;
            }

            .user-info {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                width: 300px;
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
            }

            .demandes-table {
                width: 100%;
                margin-top: 20px;
                border-collapse: collapse;
            }

            .demandes-table th, .demandes-table td {
                border: 1px solid #ced4da;
                padding: 10px;
                text-align: left;
            }

            .demandes-table th {
                background-color: #007bff;
                color: #fff;
            }

            .demandes-table tbody tr:nth-child(even) {
                background-color: #f8f9fa;
            }

            .pagination {
                margin-top: 20px;
            }

            .pagination a {
                padding: 8px;
                text-decoration: none;
                color: #007bff;
                border: 1px solid #007bff;
                border-radius: 4px;
                margin-right: 5px;
            }

            .pagination a:hover {
                background-color: #007bff;
                color: #fff;
            }
        </style>
    </head>

    <body>
        <div class="user-info">
            <?php 
                $query = "SELECT * FROM login WHERE id_login = $id_utilisateur";
                $resul = mysqli_query($conn,$query);
                if (mysqli_num_rows($resul) > 0):
                    while ($row = mysqli_fetch_assoc($resul)): 
            ?>
            <ul>
                <li><?php echo 'Nom : ' . $row['nom']; ?></li>
                <li><?php echo 'Prenom : ' . $row['prenom'] ;?></li>
                <li><?php echo 'Service : ' . $row['service'] ;?></li>
                <li><?php echo 'Login : ' . $row['login'] ;?></li>
            </ul>
            <?php 
                endwhile;
            endif;
            ?>
        </div>
        <div>
            <form method="post" action="">
                <input type="submit" name="logout" id="logout" class="logout-btn" value="Déconnecter"/>
            </form>
        </div>

        <div class="header-section">
            <?php 
                //todo: si vous voulez ajouter des filtres plus tard

            ?>    
            <h1>Les demandes :</h1>
        </div>
        <div>
            <?php
                //* les paramètres de pagination
                $elements_par_page = 10;  // Nombre d'enregistrements par page
                $page_actuelle = isset($_GET['page']) ? $_GET['page'] : 1;
                $debut_index = ($page_actuelle - 1) * $elements_par_page;
                $sql = "SELECT * FROM demande LIMIT $debut_index, $elements_par_page";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0):
                
            ?>

        <table class="demandes-table">
            <thead>
                <tr>
                    <th> Nom </th>
                    <th> Prenom </th>
                    <th> Date de demande </th>
                    <th> Status </th>
                    <th> Date de début </th>
                    <th> Date de fin </th>
                    <th> Date de prise </th>
                    <th> Date de cessation </th>
                    <th> Plus </th>
                    <th> Détails </th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <?php 
                    $id_etudiant = $row['id_etudiant'];
                    $query = "SELECT nom, prenom FROM etudiant WHERE id_etudiant = $id_etudiant";
                    $res = mysqli_query($conn, $query);
                    if ($res) {
                        $rowEt = mysqli_fetch_assoc($res);
                        $nom = $rowEt['nom'];
                        $prenom = $rowEt['prenom'];
                    }
                ?>
                <td><?php echo $nom; ?></td>
                <td><?php echo $prenom; ?></td>
                <td><?php echo $row['date_demande']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['date_debut']; ?></td>
                <td><?php echo $row['date_fin']; ?></td>
                <td><?php echo $row['date_prise']; ?></td>
                <td><?php echo $row['date_cessation']; ?></td>
                <td><?php 
                        $linkToOtherPage = "demandes.php?id=" . urlencode($id_etudiant);
                    ?>
                    <a href="<?php echo $linkToOtherPage; ?>">plus</a>
                </td>
                <td><?php 
                        $linkToOtherPage = "chef_commandes.php?id=" . urlencode($id_etudiant);
                    ?>
                    <a href="<?php echo $linkToOtherPage; ?>">détails</a></td>
            </tr>
            <?php 
                endwhile;

                //* Afficher les liens de pagination
                $sql_total = "SELECT COUNT(*) as total FROM demande";
                $result_total = mysqli_query($conn, $sql_total);
                $row_total = mysqli_fetch_assoc($result_total);
                $total_elements = $row_total['total'];
                $nombre_pages = ceil($total_elements / $elements_par_page);

            endif;
            mysqli_close($conn);
            ?>
            </tbody>

        </table>
            <div class="pagination">
                <?php 
                    for ($i = 1; $i <= $nombre_pages; $i++) {
                        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
                    }
                ?>
            </div>
        </div>

    </body>

</html>

