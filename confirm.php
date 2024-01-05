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
            $reco4 = $row['reco1'];
            $reco5 = $row['reco2'];
            $reco6 = $row['reco3'];
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


// Sauvegarde des variables pour téléchargement
session_start();
$_SESSION['reco1'] = $reco1;
$_SESSION['reco2'] = $reco2;
$_SESSION['reco3'] = $reco3;
$_SESSION['reco4'] = $reco4;
$_SESSION['reco5'] = $reco5;
$_SESSION['reco6'] = $reco6;


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
    <div class="container">
        <div class="reco">
            <h3>Recommandations basées sur les utilisateurs qui partage vos préférences de voyages.</h3>
            <ol>
                <li>
                    <?php echo $reco1; ?>
                </li>
                <li>
                    <?php echo $reco2; ?>
                </li>
                <li>
                    <?php echo $reco3; ?>
                </li>
            </ol>
        </div>
        <div class="reco">
            <h3>Recommandations basées votre destination de lune de miel idéale.</h3>
            <ol>
                <li>
                    <?php echo $reco4; ?>
                </li>
                <li>
                    <?php echo $reco5; ?>
                </li>
                <li>
                    <?php echo $reco6; ?>
                </li>
            </ol>
        </div>
        <div class="button-container">
            <a href='download_reco.php'>Télécharger votre recommandations</a>
            <a href="index.php">Recommencer</a>
        </div>
    </div>
</body>

</html>