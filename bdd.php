<?php 
$host = "localhost";
$dbName = "stage";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbName);
if (mysqli_connect_errno()) {
    echo "Erreur de connexion à la base de données : " . mysqli_connect_error();
    exit();
}

?>