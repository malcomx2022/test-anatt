<?php
$host = 'localhost';
$user = 'root'; // Remplacez par votre nom d'utilisateur MySQL
$password = ''; // Remplacez par votre mot de passe MySQL
$dbname = 'auto_ecole';

$conn = new mysqli($host, $user, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $autoecole = $_GET['autoecole'] ?? '';

    if (!empty($autoecole)) {
        $stmt = $conn->prepare("SELECT * FROM CANDIDAT WHERE nomautoecole = ?");
        $stmt->bind_param("s", $autoecole);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h2>Résultats pour l'auto-école : $autoecole</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "Nom : " . $row['Nom'] . ", Prénom : " . $row['Prenom'] . "<br>";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Recherche de candidats</title>
</head>

<body>
    <h1>Recherche de candidats par auto-école</h1>
    <form method="get" action="">
        <label for="autoecole">Nom de l'auto-école :</label>
        <input type="text" id="autoecole" name="autoecole" required>
        <button type="submit">Rechercher</button>
    </form>
</body>

</html>