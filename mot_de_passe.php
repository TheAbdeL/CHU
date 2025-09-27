<?php 
    include 'bdd.php';

    // Vérifiez si l'utilisateur est authentifié
    include 'verifier_auth.php';

    if (isset($_POST['submit'])){
        
        $ancien = mysqli_real_escape_string($conn, $_POST['ancien']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirmation = mysqli_real_escape_string($conn, $_POST['confirmation']);

        if($confirmation != $password){
            $error[] = "Confirmation incorrect";
            exit(1);
        }

        $sql = "SELECT * FROM login WHERE id_login = $id_utilisateur";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)){
                if($ancien != $row['password']){
                    $error[] = 'Password incorrect';
                    exit(1);
                }
            }
        }    
        $query = "UPDATE login SET password = ?, premiere_connexion = 0 WHERE id_login = ?";
        $stmt_update = $conn->prepare($query);
        $stmt_update->bind_param("ss", $password, $id_utilisateur);

        if ($stmt_update->execute()) {
            echo '<script>';
            echo 'alert("Password changé !");';
            echo 'window.location.href = "logout.php";';
            echo '</script>';
        } else {
            $error[] = "Password n'est pas changé";
        }

        $stmt_update->close();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Changement du mot de passe</title>
    
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        h3 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .error-msg {
            color: blueviolet;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group i {
            color: #ced4da;
            font-size: 22px;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .input-text {
            width: calc(100% - 40px);
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 8px;
            margin-bottom: 8px;
            font-size: 14px;
            outline: none;
        }

        .button-submit {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .button-submit:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        function togglePassword(inputId) {
            var x = document.getElementById(inputId);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>

<body>
    <div class="login-form">
        <form method="post" action="">
            <h3>Changer le mot de passe:</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<div class="error-msg">' . $error . '</div>';
                };
            };
            ?>
            <div class="input-group">
                <i class="fa fa-unlock-alt" onclick="togglePassword('ancien')"></i>
                <input type="password" class="input-text" name="ancien" id="ancien" placeholder="Ancien mot de passe" required>
            </div>
            <div class="input-group">
                <i class="fa fa-unlock-alt" onclick="togglePassword('password')"></i>
                <input type="password" class="input-text" name="password" id="password" placeholder="Nouveau mot de passe" required>
            </div>
            <div class="input-group">
                <i class="fa fa-unlock-alt" onclick="togglePassword('confirmation')"></i>
                <input type="password" class="input-text" name="confirmation" id="confirmation" placeholder="Confirmation" required>
            </div>
            <div class="button">
                <button type="submit" class="button-submit" name="submit" id="submit">Changer</button>
            </div>
        </form>
    </div>
</body>
</html>
