<?php
include 'config-db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $datnais = $_POST['datnais'];
    $ville = $_POST['ville'];
    $sexe = $_POST['sexe'];
    $categoriepermis = $_POST['categoriepermis'];
    $autoecole = $_POST['autoecole'];

    try {
        $stmt = $pdo->prepare("INSERT INTO CANDIDAT (Nom, Prenom, Datnais, Ville, Sexe, categoriepermis, nomautoecole) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $datnais, $ville, $sexe, $categoriepermis, $autoecole]);
        echo "Candidat enregistré avec succès.";
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
