<!-- config.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "permis_db";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>