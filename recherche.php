<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'auto_ecole';
$conn = new mysqli($host, $user, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $autoecole = $_GET['autoecole'] ?? '';
    $resultats = [];

    if (!empty($autoecole)) {
        $stmt = $conn->prepare("SELECT * FROM CANDIDAT WHERE nomautoecole = ?");
        $stmt->bind_param("s", $autoecole);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultats[] = $row;
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Recherche de candidats</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Recherche de candidats par auto-école</h1>

    <form method="get" action="">
        <label for="autoecole">Nom de l'auto-école :</label>
        <input type="text" id="autoecole" name="autoecole" required>
        <button type="submit">Rechercher</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($autoecole)): ?>
        <h2>Résultats pour l'auto-école : <?php echo htmlspecialchars($autoecole); ?></h2>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($resultats)): ?>
                    <?php foreach ($resultats as $candidat): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($candidat['Nom']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['Prenom']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['Sexe']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Indiquer la filiere sil vous plait "<?php echo htmlspecialchars($autoecole); ?>"</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>