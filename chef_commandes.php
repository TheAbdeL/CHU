<?php
@include 'bdd.php';

// Vérifiez si l'utilisateur est authentifié
include 'verifier_auth.php';

//? echo "Bienvenue sur votre page, utilisateur $id_utilisateur!";

require_once 'mail.php';

// Récupérer l'ID depuis le paramètre d'URL
$id_etudiant = $_GET['id'] ?? '';

// Assurez-vous que l'ID est un nombre entier valide
$id_etudiant = filter_var($id_etudiant, FILTER_VALIDATE_INT);

if ($id_etudiant === false || $id_etudiant === null) {
    // Gérer le cas où l'ID n'est pas valide
    echo "ID non valide.";
    exit;
}

$query = "SELECT nom, prenom, email FROM etudiant WHERE id_etudiant = $id_etudiant";
$res = mysqli_query($conn, $query);

if ($res) {
    $rowEt = mysqli_fetch_assoc($res);
    $nom = $rowEt['nom'];
    $prenom = $rowEt['prenom'];
    $email = $rowEt['email'];
}

if (isset($_POST['favorable'])) {
    $sql = "UPDATE demande SET status = 'Acceptée' WHERE id_etudiant = $id_etudiant";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo '<script>alert("Erreur lors de la modification du statut");</script>';
    }

    $mail->setFrom('abdou.sabo02@gmail.com', 'CHU');
    $mail->addAddress($email);
    $mail->Subject = 'Avis favorable';
    $mail->Body = <<<EOT
        <!DOCTYPE html>
        <html lang="fr">
        <head>
        <meta charset="UTF-8">
        <title>Votre demande est acceptée</title>
        </head>
        <body>
        <header>
        <h1>Votre demande est acceptée</h1>
        </header>
        <p>Cordialement,</p>
        <p>CHU</p>
        </body>
        </html>
        EOT;

    if ($mail->send()) {
        echo '<script>alert("L\'avis a été envoyé avec succès");</script>';
    } else {
        echo '<script>alert("Erreur lors de l\'envoi de l\'avis");</script>';
    }
}

if (isset($_POST['defavorable'])) {
    $sql = "UPDATE demande SET status = 'Refusée' WHERE id_etudiant = $id_etudiant";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo '<script>alert("Erreur lors de la modification du statut");</script>';
    }

    $motifs = $_POST['motifs'];

    $mail->setFrom('abdou.sabo02@gmail.com', 'CHU');
    $mail->addAddress($email);
    $mail->Subject = 'Avis défavorable';
    $mail->Body = <<<EOT
        <!DOCTYPE html>
        <html lang="fr">
        <head>
        <meta charset="UTF-8">
        <title>Votre demande est refusée</title>
        </head>
        <body>
        <header>
        <h1>Votre demande est refusée</h1>
        </header>
        <main>
        <p>Bonjour,</p>
        <p>Votre demande est refusée :</p>
        <table>
            <tr>
            <th>Les motifs :</th>
            <td>$motifs</td>
            </tr>
        </table>
        <p>Cordialement,</p>
        <p>CHU</p>
        </main>
        </body>
        </html>
        EOT;

    if ($mail->send()) {
        echo '<script>alert("L\'avis a été envoyé avec succès");</script>';
    } else {
        echo '<script>alert("Erreur lors de l\'envoi de l\'avis");</script>';
    }
}
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title>Favoriser les demandes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Favoriser la Demande :</h1>
        </div>
    </div>

    <form method="post" action="">
        <div class="form-group row">
            <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nom; ?>" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $prenom; ?>" readonly>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success" name="favorable">Avis Favorable</button>
            </div>
        </div>
    </form>

    <form method="post">
        <div class="form-group row">
            <label for="motifs" class="col-sm-2 col-form-label">Motifs de l'avis défavorable :</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="motifs" id="motifs" required></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-danger" name="defavorable">Avis défavorable</button>
            </div>
        </div>
    </form>
</div>


</body>
</html>
