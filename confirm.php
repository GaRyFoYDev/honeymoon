<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 3 - Récupérer la reco user based
// 4 - Récupérer la reco item based
// 5 - Afficher les reco
// Améliorer l'affichage avec css



try {
    // Connexion à la bb
    $bdd = new SQLite3('honeymoon.db');


    // Récupérer les recommandations user based
    $query2 = "SELECT * FROM user_recommendations ORDER BY id DESC LIMIT 1";
    $userReco = $bdd->query($query2);

    if ($userReco) {
        $row = $userReco->fetchArray(SQLITE3_ASSOC); // Récupère la première (et seule) ligne de résultat

        if ($row) {
            $reco1 = $row['reco1'];
            $reco2 = $row['reco2'];
            $reco3 = $row['reco3'];

            echo "<b>Recommendations basées sur les utilisateurs qui partage vos préférences de voyages.</b><br>";
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


    // Récupérer les recommandations user based
    $query3 = "SELECT * FROM item_recommendations ORDER BY id DESC LIMIT 1";
    $itemReco = $bdd->query($query3);

    if ($itemReco) {
        $row = $itemReco->fetchArray(SQLITE3_ASSOC); // Récupère la ligne de résultat

        if ($row) {
            $reco1 = $row['reco1'];
            $reco2 = $row['reco2'];
            $reco3 = $row['reco3'];

            echo "<b>Recommendations basées sur votre destination idéale.</b><br>";
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

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reco.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>HoneyMoon - Recommandations</title>
</head>

<body>
    <!-- <script src="js_scripts/form.js"></script> -->
</body>

</html>
