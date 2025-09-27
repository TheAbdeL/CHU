<?php 

include 'bdd.php';

require_once 'mail.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $niveau = $_POST['niveau'];
    $etablissement = $_POST['etablissement'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $service = $_POST['service'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    if ($_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        // Récupérer le contenu du fichier PDF
        $cv = file_get_contents($_FILES['cv']['tmp_name']);

        // Sérialiser le contenu du PDF
        $cvSerialized = serialize($cv);
    
    } else {
        echo '<script>';
        echo 'alert("CV non validé !!");';
        echo 'window.location.href="demande_de_stage.php";';
        echo '</script>';
    }

    if ($_FILES['lm']['error'] === UPLOAD_ERR_OK) {
        // Récupérer le contenu du fichier PDF
        $lm = file_get_contents($_FILES['lm']['tmp_name']);

        // Sérialiser le contenu du PDF
        $lmSerialized = serialize($lm);
        
    } else {
        echo '<script>';
        echo 'alert("LM non validée !!");';
        echo 'window.location.href="demande_de_stage.php";';
        echo '</script>';
    }

    switch($service){
        case 'SI' :
            $id_service = 1;
            break;
        case 'Service 1' :
            $id_service = 1;
            break;
        case 'Service 2' :
            $id_service = 2;
            break;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        echo '<script>'; 
        echo 'alert("Adresse email invalide !");';
        echo 'window.location.href = "demande_de_stage.php";';
        echo '</script>';
        exit;
    } 
    if ( $nom != cleanInput($nom)) {
        echo '<script>'; 
        echo 'alert("Nom invalidé !");';
        echo 'window.location.href = "demande_de_stage.php";';
        echo '</script>';
        exit;
    }
    if ($prenom != cleanInput($prenom)) {
        echo '<script>'; 
        echo 'alert("Prenom invalidé !");';
        echo 'window.location.href = "demande_de_stage.php";';
        echo '</script>';
        exit;
    }
    if ($prenom != cleanInput($prenom)) {
        echo '<script>'; 
        echo 'alert("Prenom invalidé !");';
        echo 'window.location.href = "demande_de_stage.php";';
        echo '</script>';
        exit;
    }
    if ($cin != cleanInput($cin)) {
        echo '<script>'; 
        echo 'alert("CIN invalidé !");';
        echo 'window.location.href = "demande_de_stage.php";';
        echo '</script>';
        exit;
    }
    if ($etablissement != cleanInput($etablissement)) {
        echo '<script>'; 
        echo 'alert("Etablissement invalidé !");';
        echo 'window.location.href = "demande_de_stage.php";';
        echo '</script>';
        exit;
    }
    if (!ChiffresSeulement($tel)) {
        echo '<script>'; 
        echo 'alert("Tel invalidé !");';
        echo 'window.location.href = "demande_de_stage.php";';
        echo '</script>';
        exit;
    }

    $sql = "SELECT * FROM login ;";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            if ($email == $row['login']) {
                echo '<script>'; 
                echo 'alert("email déjà utilisé !");';
                echo 'window.location.href = "demande_de_stage.php";';
                echo '</script>';
                exit;
            }
        }
    }
        
    //? table login 
    $login = $email ;
    $password = 1234 ;
    $profil = 'Et';
    $sql = "INSERT INTO login (nom,prenom,service,login,password,profil,id_service) VALUES ('$nom','$prenom','$service','$login','$password','$profil','$id_service')";
    $resultat = mysqli_query($conn,$sql);
    
    if ($resultat) {
        $id_login =  mysqli_insert_id($conn);
    }
    else{
        echo '<script>';
        echo 'alert("Erreur lors de le login d\'etudiant !!");';
        echo 'window.location.href="demande_de_stage.php";';
        echo '</script>';
    }

    $mail->setFrom('abdou.sabo02@gmail.com', 'CHU');
    $mail->addAddress($email);
    $mail->Subject = 'Votre login';
        $mail->Body = <<<EOT

        <!DOCTYPE html>
        <html lang="fr">
        <head>
        <meta charset="UTF-8">
        <title>Votre demande est bien reçue</title>
        </head>
        <body>
        
        <header>
        <h1>Votre demande est bien reçue</h1>
        </header>
        
        <main>
        <p>Bonjour,</p>
        <p>Votre demande est bien reçue. Voici vos identifiants :</p>
        
        <table>
            <tr>
            <th>Login</th>
            <td>$email</td>
            </tr>
            <tr>
            <th>Mot de passe</th>
            <td>$password</td>
            </tr>
        </table>
        
        <p>Vous pouvez utiliser ces identifiants pour vous connecter à notre site web.</p>
        
        <p>Cordialement,</p>
        <p>CHU</p>
        </main>
        
        <footer>
        <p>Copyright © 2023</p>
        </footer>
        
        </body>
        </html>
        EOT;

    //? Table etudiant

    $query = "INSERT INTO etudiant (nom,prenom,cin,tel,email,niveau,etablissement,service,cv,lm,id_login) VALUES (?,?,?,?,?,?,?,?,?,?,?)"; 

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssss", $nom, $prenom, $cin, $tel, $email, $niveau, $etablissement, $service, $cvSerialized, $lmSerialized, $id_login);


    if ($stmt->execute()) {
        $id_etudiant = mysqli_insert_id($conn);
        $stmt->close();

        //? table demande
        $date_demande = date("Y-m-d");
        $status = 'En cours';

        $stmt = $conn->prepare("INSERT INTO demande (date_demande, status, cv, lm, date_debut, date_fin, id_etudiant, id_service) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $date_demande, $status, $cvSerialized, $lmSerialized, $date_debut, $date_fin, $id_etudiant, $id_service);
        if($stmt->execute()){
            $stmt->close();
            if($mail->send()){
                echo '<script>';
                echo 'alert("La demande est envoyée avec succèe vous recevrez votre login par e-mail");';
                echo 'window.location.href="login.php";';
                echo '</script>';
            }else{
                echo '<script>';
                echo 'alert("erreur lors de l\'envoi d\'e-mail");';
                echo 'window.location.href="demande_de_stage.php";';
                echo '</script>';
            }
        }
        else{
            $stmt->close();
            echo '<script>';
            echo 'alert("Erreur lors de l\'envoi de la demande !!");';
            echo 'window.location.href="demande_de_stage.php";';
            echo '</script>';
        }    


    } else {
        echo '<script>';
        echo 'alert("Erreur lors de l\'insertion d\'etudiant !!");';
        echo 'window.location.href="demande_de_stage.php";';
        echo '</script>';
    }
    
}
else{
    echo '<script>';
    echo 'alert(" !!");';
    echo 'window.location.href="demande_de_stage.php";';
    echo '</script>';
}

//? Fonction pour nettoyer les données
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//? Fonction pour nettoyer le tel
function ChiffresSeulement($chaine) {
    return preg_match('/^[0-9]{10}$/', $chaine);
}


?>