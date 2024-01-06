<?php

// // 1 - Récupérer les données du formulaire ok
// // 2 - Enregistrer les données dans la bdd pour enrichir les recommandations futures ok

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupération des données du formulaire
$data = array();

for ($i = 1; $i <= 20; $i++) {
    $key = "question" . $i;
    if (isset($_POST[$key])) {
        $data[$key] = $_POST[$key];
    }
}

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO('sqlite:honeymoon.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête d'insertion
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $query = "INSERT INTO survey (" . implode(", ", array_keys($data)) . ") VALUES ($placeholders)";
    $stmt = $pdo->prepare($query);

    // Exécution de la requête
    if (!$stmt->execute(array_values($data))) {
        throw new Exception("Une erreur s'est produite lors de l'enregistrement des données.");
    }

    // Redirection pour éviter nouvelle soumission du form
    header("Location: confirm.php");

} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}





//Trouver comment éviter soumission formulaire avec rechargement = redirection ok
//Terminer la mise en page de la recommandation ok
//Prévoir un bouton  de retour à la page d'accueil
// Si assez de temps offrir la possibilité aux users de télécharger sa reco en fichier txt
?>

