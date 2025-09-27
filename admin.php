<?php
include 'bdd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $service = $_POST['service'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $profil = $_POST['profil'];

    //!! Ajouter Les filtres

    $query = "INSERT INTO login (nom,prenom,service,login,password,profil) VALUES ('$nom','$prenom','$service','$login','$password','$profil')";
    mysqli_query($conn,$query);
    echo '<script>';
    echo 'alert("Création réussie");';
    echo 'window.location.href = "admin.php";';
    echo '</script>';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <form method="post" action="">
        <div class="form-group row">
            <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="service" class="col-sm-2 col-form-label">Service :</label>
            <div class="col-sm-10">
                <select class="form-control" name="service" id="service">
                    <option selected disabled>Service</option>
                    <option value="SI">Service informatique</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="login" class="col-sm-2 col-form-label">Login :</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="login" id="login" placeholder="Login" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="profil" class="col-sm-2 col-form-label">Profil :</label>
            <div class="col-sm-10">
                <select class="form-control" name="profil" id="profil">
                    <option selected disabled>Profil</option>
                    <option value="Et">Etudiant</option>
                    <option value="Ch">Chef</option>
                    <option value="Sc">Secrétaire</option>
                    <option value="Rh">RH</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <input type="submit" class="btn btn-primary" name="ajouter" id="ajouter" value="Ajouter">
            </div>
        </div>
    </form>
</div>

</body>
</html>
