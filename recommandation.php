<?php
// Récupérer les données du formulaire ok
// Enregistrer les données dans la bdd pour enrichir les recommandations futures ok
// Récupérer la dernière entrée de la bdd correspondant au formulaire soumie dans le script python
// Récupérer et afficher la recommandation
// Améliorer l'affichage avec css

// Initialisez un tableau pour stocker les données des questions
$data = array();

// Boucle pour récupérer les données POST
for ($i = 1; $i <= 20; $i++) {
    $key = "question" . $i;

    // Vérifiez si la clé existe dans $_POST avant de l'ajouter au tableau
    if (isset($_POST[$key])) {
        $data[$key] = $_POST[$key];
    }
}

try {
    // Connexion à la bb
    $bdd = new SQLite3('honeymoon.db');

    // Préparez la requête SQL d'insertion
    $query = "INSERT INTO survey (";
    $query .= implode(", ", array_keys($data)); // Colonnes
    $query .= ") VALUES (";
    $query .= "'" . implode("', '", $data) . "'"; // Valeurs
    $query .= ")";

    // Exécutez la requête
    $result = $bdd->exec($query);

    if (!$result) {
        die("Une erreur s'est produite lors de l'enregistrement des données dans la base de données.");
    }

    // Fermez la connexion à la base de données
    $database->close();
} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}



?>






?>