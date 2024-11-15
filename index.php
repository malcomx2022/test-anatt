<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'auto_ecole';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $autoecole = $_POST['autoecole'];
    $npi = $_POST['npi'] ?? null;
    $datnais = $_POST['datnais'] ?? null;
    $ville = $_POST['ville'] ?? null;
    $sexe = $_POST['sexe'] ?? null;
    $categoriepermis = $_POST['categoriepermis'] ?? null;

    if (!empty($nom) && !empty($prenom) && !empty($autoecole)) {
        $stmt = $conn->prepare("INSERT INTO CANDIDAT (NPI, Nom, Prenom, Datnais, Ville, Sexe, categoriepermis, nomautoecole) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $npi, $nom, $prenom, $datnais, $ville, $sexe, $categoriepermis, $autoecole);
        if ($stmt->execute()) {
            echo "enregistrement effectué avec succès.";
        } else {
            echo "Erreur : " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Veuillez remplir tous les champs obligatoires (Nom, Prénom, Auto-école).";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos coordonnées</title>
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        .button-group {
            margin-top: 20px;
        }

        button {
            padding: 8px 15px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h1>Inscription des candidats</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="nom">Nom* :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom* :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="autoecole">Nom de l'auto-école* :</label>
            <input type="text" id="autoecole" name="autoecole" required>
        </div>
        <div class="form-group">
            <label for="npi">NPI :</label>
            <input type="text" id="npi" name="npi">
        </div>
        <div class="form-group">
            <label for="datnais">Date de naissance :</label>
            <input type="date" id="datnais" name="datnais">
        </div>
        <div class="form-group">
            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville">
        </div>
        <div class="form-group">
            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe">
                <option value="">--Choisir--</option>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="categoriepermis">Catégorie de permis :</label>
            <input type="text" id="categoriepermis" name="categoriepermis">
        </div>
        <div class="button-group">
            <button type="submit">Enregistrer</button>
            <button type="reset">Effacer</button>
        </div>
    </form>
</body>

</html>