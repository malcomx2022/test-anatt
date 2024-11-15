<!-- index.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription Candidats Permis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Inscription des Candidats au Permis</h2>

    <form action="enregistrer.php" method="POST">
        <div class="form-group">
            <label for="npi">NPI:</label>
            <input type="text" id="npi" name="npi" required>
        </div>

        <div class="form-group">
            <label for="nom">Nom:*</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom:*</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>

        <div class="form-group">
            <label for="date_naissance">Date de naissance:</label>
            <input type="date" id="date_naissance" name="date_naissance" required>
        </div>

        <div class="form-group">
            <label for="ville">Ville:</label>
            <input type="text" id="ville" name="ville" required>
        </div>

        <div class="form-group">
            <label for="sexe">Sexe:</label>
            <select id="sexe" name="sexe" required>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="categorie_permis">Catégorie de permis:</label>
            <select id="categorie_permis" name="categorie_permis" required>
                <option value="A">A - Moto</option>
                <option value="B">B - Voiture</option>
                <option value="C">C - Poids lourd</option>
                <option value="D">D - Transport en commun</option>
            </select>
        </div>

        <div class="form-group">
            <label for="auto_ecole">Auto-école:*</label>
            <select id="auto_ecole" name="auto_ecole" required>
                <?php
                require_once 'config.php';
                $sql = "SELECT nomautoecole FROM auto_ecole";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['nomautoecole'] . "'>" . $row['nomautoecole'] . "</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit">Enregistrer</button>
    </form>

    <h3>Rechercher un candidat</h3>
    <form action="rechercher.php" method="GET">
        <div class="form-group">
            <label for="auto_ecole_recherche">Sélectionner une auto-école:</label>
            <select id="auto_ecole_recherche" name="auto_ecole_recherche" required>
                <?php
                $sql = "SELECT nomautoecole FROM auto_ecole";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['nomautoecole'] . "'>" . $row['nomautoecole'] . "</option>";
                }
                $conn->close();
                ?>
            </select>
        </div>
        <button type="submit">Rechercher</button>
    </form>
</body>

</html>