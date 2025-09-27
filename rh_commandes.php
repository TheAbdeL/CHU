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


if (isset($_POST['modifier'])){
    $status = $_POST['status'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $date_prise = $_POST['date_prise'];
    $date_cessation = $_POST['date_cessation'];

    if ($status != null && $date_debut != null && $date_fin != null){
        $sql = "UPDATE demande SET status = '$status' , date_debut = '$date_debut' , date_fin = '$date_fin' WHERE id_etudiant = $id_etudiant ";
        $resultat = mysqli_query($conn,$sql);
        if($resultat){
            echo '<script>';
            echo 'alert("Vous avez modifié le status,la date de debut et la date de fin");';
            echo '</script>';
        }
    }else{
        echo '<script>';
        echo 'alert("Vous n\'avez pas modifié le status, ni la date de debut et ni la date de fin");';
        echo '</script>';
        exit();
    }

    if ($date_prise != null){
        $sql = "UPDATE demande SET date_prise = '$date_prise' WHERE id_etudiant = $id_etudiant";
        if(mysqli_query($conn,$sql)){
            echo '<script>';
            echo 'alert("Vous avez modifié la date de prise aussi");';
            echo '</script>';
        }

    }

    if ($date_cessation != null){
        $sql = "UPDATE demande SET date_cessation = '$date_cessation' WHERE id_etudiant = $id_etudiant ";
        if(mysqli_query($conn,$sql)){
            echo '<script>';
            echo 'alert("Vous avez modifié la date de cessation aussi");';
            echo '</script>';
        }
    }

}

if (isset($_POST['envoyer'])){

    if(!isset($_FILES['Attestation']) && !isset($_FILES['Note']) && !isset($_FILES['Prise']) && !isset($_FILES['Cessation'])){
        echo '<script>';
        echo 'alert("Vous n\'avez rien envoyer");';
        echo '</script>';
        exit();
    }
        
    if (isset($_FILES['Attestation']) && $_FILES['Attestation']['error'] === UPLOAD_ERR_OK) {
        // Récupérer le chemin temporaire du fichier téléchargé
        $pdfFilePath = $_FILES['Attestation']['tmp_name'];
        $mail->setFrom('abdou.sabo02@gmail.com', 'CHU');
        $mail->addAddress($email);
        $mail->Subject = 'Votre Attestation de stage';
        $mail->Body = 'Votre Attestation de stage';
        $mail->addAttachment($pdfFilePath, 'Attestation_de_stage.pdf');
        if($mail->send()){
            echo '<script>';
            echo 'alert("L\'Attestation de stage est envoyée avec succèe");';
            echo '</script>';
        }else{
            echo '<script>';
            echo 'alert("erreur lors de l\'envoi de l\'Attestation de stage");';
            echo '</script>';
        }
    }

    if (isset($_FILES['Note']) && $_FILES['Note']['error'] === UPLOAD_ERR_OK) {
        // Récupérer le chemin temporaire du fichier téléchargé
        $pdfFilePath = $_FILES['Note']['tmp_name'];
        $mail->setFrom('abdou.sabo02@gmail.com', 'CHU');
        $mail->addAddress($email);
        $mail->Subject = 'Votre Note de stage';
        $mail->Body = 'Votre Note de stage' ;
        $mail->addAttachment($pdfFilePath, 'Note_de_stage.pdf');
        if($mail->send()){
            echo '<script>';
            echo 'alert("La Note de stage est envoyée avec succèe");';
            echo '</script>';
        }else{
            echo '<script>';
            echo 'alert("erreur lors de l\'envoi de la Note de stage");';
            echo '</script>';
        }
    }

    if (isset($_FILES['Prise']) && $_FILES['Prise']['error'] === UPLOAD_ERR_OK) {
        // Récupérer le chemin temporaire du fichier téléchargé
        $pdfFilePath = $_FILES['Prise']['tmp_name'];
        $mail->setFrom('abdou.sabo02@gmail.com', 'CHU');
        $mail->addAddress($email);
        $mail->Subject = 'Votre Prise de stage';
        $mail->Body = 'Votre Prise de stage' ;
        $mail->addAttachment($pdfFilePath, 'Prise_de_stage.pdf');
        if($mail->send()){
            echo '<script>';
            echo 'alert("La Prise de stage est envoyée avec succèe");';
            echo '</script>';
        }else{
            echo '<script>';
            echo 'alert("erreur lors de l\'envoi de la Prise de stage");';
            echo '</script>';
        }
    }

    if (isset($_FILES['Cessation']) && $_FILES['Cessation']['error'] === UPLOAD_ERR_OK) {
        // Récupérer le chemin temporaire du fichier téléchargé
        $pdfFilePath = $_FILES['Cessation']['tmp_name'];
        $mail->setFrom('abdou.sabo02@gmail.com', 'CHU');
        $mail->addAddress($email);
        $mail->Subject = 'Votre Cessation de stage';
        $mail->Body = 'Votre Cessation de stage' ;
        $mail->addAttachment($pdfFilePath, 'Cessation_de_stage.pdf');
        if($mail->send()){
            echo '<script>';
            echo 'alert("La Cessation de stage est envoyée avec succèe");';
            echo '</script>';
        }else{
            echo '<script>';
            echo 'alert("erreur lors de l\'envoi de la Cessation de stage");';
            echo '</script>';
        }
    }


}



?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title>Modifier les demandes</title>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
        body {
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: inline-block;
            text-align: left;
            width: 170px;
        }

        input, select, .form-control-file {
            display: inline-block;
            width: 100px;
        }

        .left-form, .right-form {
            width: 40%; /* Ajustez selon vos besoins */
        }
    </style>
</head>

<body>

    <div class="form-container">
        <div class="left-form">
            <h1>Modifier la Demande :</h1>
            <form method="post" action="" class="needs-validation" novalidate>

                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="prenom">Prenom :</label>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="status">Status :</label>
                    <select name="status" id="status" class="form-control" required>
                        <option selected disabled>Status</option>
                        <option value="En cours">En cours</option>
                        <option value="Traitée">Traitée</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_debut">Date début :</label>
                    <input type="date" id="date_debut" name="date_debut" min="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="date_fin"> Date fin :</label>
                    <input type="date" id="date_fin" name="date_fin" min="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="date_prise">Prise de Stage :</label>
                    <input type="date" id="date_prise" name="date_prise" class="form-control">
                </div>

                <div class="form-group">
                    <label for="date_cessation">Cessation de Stage :</label>
                    <input type="date" id="date_cessation" name="date_cessation" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" name="modifier" id="modifier" value="Modifier" class="btn btn-primary">
                </div>
            </form>
        </div>
    
    
    
        <div class="right-form">
            <h1>Envoyer des Documents :</h1>
            <form method="post" action="" enctype="multipart/form-data" class="needs-validation" novalidate>

                <div class="form-group">
                    <label for="Attestation">Attestation de Stage :</label>
                    <input type="file" name="Attestation" id="Attestation" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="Note">Note de Stage :</label>
                    <input type="file" name="Note" id="Note" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="Prise">Prise de Stage :</label>
                    <input type="file" name="Prise" id="Prise" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="Cessation">Cessation de Stage :</label>
                    <input type="file" name="Cessation" id="Cessation" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="envoyer" id="envoyer" value="Envoyer" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
