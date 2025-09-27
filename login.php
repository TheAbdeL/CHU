<?php 

    include 'bdd.php';


    session_start();

    if (isset($_POST['submit'])){
        
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        $select = "SELECT * FROM login WHERE login='$username' && password='$password' limit 1";

        $resul = mysqli_query($conn,$select);

        if(mysqli_num_rows($resul) > 0){
            while($row = mysqli_fetch_array($resul)){
                $_SESSION['utilisateur_id'] = $row['id_login'];
                $premiere_connexion = $row['premiere_connexion'];
                if($premiere_connexion == 1){
                    header('Location:mot_de_passe.php');
                    exit();
                }
                switch($row['profil']){
                    case 'Et' :
                        header('location:page_etudiant.php');
                        break;
                    case 'Ch' :
                        header('location:page_chef.php');
                        break; 
                    case 'Rh' :
                        header('location:page_rh.php');
                        break;
                    case 'Se' :
                        header('location:page_secretaire.php');
                        break;        
                }
            }
        }
        else{
            $error[] = 'Incorrect username or password!';
        }
    
    }


?>






<!DOCTYPE html>
<html >
    <head>
        <meta name="viewport" content="width=device-width, initial- scale=1 " />    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Login</title>
        
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

            h1 {
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

            .input-group i:hover {
                background-color: #007bff;
                color: #fff;
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
            <form action="" method="post">
            <div class="login_form">
                <h1>Login</h1>
                <?php
                
                if(isset($error)){
                    foreach($error as $error){
                        echo '<div class="error-msg">' . $error . '</div>';
                    };
                };
                
                ?>
                <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="username" placeholder="Username" class="input-text"/>
                </div>
                <div class="input-group">
                <i class="fa fa-unlock-alt" onclick="togglePassword('password')"></i>
                <input type="password" name="password" id="password" placeholder="Password" class="input-text" />
                </div>
                <div class="button">
                    <input type="submit" name="submit" value="Login" class="button-submit" />
                </div>
            </div>
            </form>
        </div>
    </body>

</html>




