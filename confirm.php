<?php
// 3 - Récupérer la reco user based
// 4 - Récupérer la reco item based
// 5 - Afficher les reco
// Améliorer l'affichage avec css

require 'user.php';
require 'item.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$reco1 = $userRecommendations[0];
$reco2 = $userRecommendations[1];
$reco3 = $userRecommendations[2];

$reco4 = $itemRecommendations[0];
$reco5 = $itemRecommendations[1];
$reco6 = $itemRecommendations[2];

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
            <a href='download_reco.php'>Télécharger votre recommandation</a>
            <a href="index.php">Recommencer</a>
        </div>
    </div>
</body>

</html>