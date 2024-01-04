<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1 - Récupérer les données du formulaire ok
// 2 - Enregistrer les données dans la bdd pour enrichir les recommandations futures ok
// 3 - Récupérer la dernière entrée de la bdd correspondant au formulaire soumis dans le script python
// 4 - Récupérer et afficher la recommandation
// 5 - Refaire étape 3 et 4 pour la deuxième reco item based
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
    $query = "INSERT INTO survey (" . implode(", ", array_keys($data)) . ") VALUES ('" . implode("', '", $data) . "')";

    // Exécutez la requête
    $result = $bdd->exec($query);

    if (!$result) {
        die("Une erreur s'est produite lors de l'enregistrement des données dans la base de données.");
    }

    // Exécuter le script python user based recommendation 
    $command = 'venv/bin/python python_scripts/userRecommendation.py';
    exec($command);

    // Récupérer les recommandations user based
    $query2 = "SELECT * FROM user_recommendations ORDER BY id DESC LIMIT 1";
    $userReco = $bdd->query($query2);

    if ($userReco) {
        $row = $userReco->fetchArray(SQLITE3_ASSOC); // Récupère la première (et seule) ligne de résultat

        if ($row) {
            $reco1 = $row['reco1'];
            $reco2 = $row['reco2'];
            $reco3 = $row['reco3'];

            echo "<b>Recommendation basée sur les utilisateurs qui partage vos préférences de voyages.</b><br>";
            echo "Reco 1: $reco1 <br>";
            echo "Reco 2: $reco2 <br>";
            echo "Reco 3: $reco3 <br>";

            $userReco->finalize();

        } else {
            echo "Aucune donnée trouvée.";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête user reco.";
    }


    // Exécuter le script python user based recommendation 
    $command2 = 'venv/bin/python python_scripts/itemRecommendation.py';
    exec($command2);

    // Récupérer les recommandations user based
    $query3 = "SELECT * FROM item_recommendations ORDER BY id DESC LIMIT 1";
    $itemReco = $bdd->query($query3);

    if ($itemReco) {
        $row = $itemReco->fetchArray(SQLITE3_ASSOC); // Récupère la ligne de résultat

        if ($row) {
            $reco1 = $row['reco1'];
            $reco2 = $row['reco2'];
            $reco3 = $row['reco3'];

            echo "<b>Recommendation basée sur votre destination idéale.</b><br>";
            echo "Reco 1: $reco1 <br>";
            echo "Reco 2: $reco2 <br>";
            echo "Reco 3: $reco3 <br>";

            $itemReco->finalize();

        } else {
            echo "Aucune donnée trouvée.";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête item reco.";
    }
    
    $bdd->close();

} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}

?>