<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    $query = "INSERT INTO survey (" . implode(", ", array_keys($data)) . ") VALUES ('" . implode("', '", $data) . "')";

    // Exécutez la requête
    $result = $bdd->exec($query);

    if (!$result) {
        die("Une erreur s'est produite lors de l'enregistrement des données dans la base de données.");
    }

    // Exécuter le script python user based recommendation 
    $command = 'venv/bin/python python_scripts/userRecommendation.py';
    exec($command);

    // // Exécuter le script python item based recommendation 
    // $command2 = 'venv/bin/python itemRecommendation.py';
    // exec($command);


    // Récupérer les recommandations user based
    $query2 = "SELECT * FROM user_recommendations ORDER BY id DESC LIMIT 1";
    $result2 = $bdd->query($query2);

    if ($result2) {
        $row = $result2->fetchArray(SQLITE3_ASSOC); // Récupère la première (et seule) ligne de résultat

        if ($row) {
            $reco1 = $row['reco1'];
            $reco2 = $row['reco2'];
            $reco3 = $row['reco3'];

            echo "<b>Reco user based</b><br>";
            echo "Reco 1: $reco1 <br>";
            echo "Reco 2: $reco2 <br>";
            echo "Reco 3: $reco3 <br>";

        } else {
            echo "Aucune donnée trouvée.";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête.";
    }

    $result2->finalize();
    $bdd->close();

} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}


?>