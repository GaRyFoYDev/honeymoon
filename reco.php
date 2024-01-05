<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1 - Récupérer les données du formulaire ok
// 2 - Enregistrer les données dans la bdd pour enrichir les recommandations futures ok
// 3 - Exécuter les scripts python pour obtenir les reco


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
    // Connexion à la bdd
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

    // Exécuter le script python item based recommendation 
    $command2 = 'venv/bin/python python_scripts/itemRecommendation.py';
    exec($command2);

    $bdd->close();

    //Redirection vers la confirmation.php pour afficher les reco
    header("Location: confirm.php");

} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}

//Trouver comment éviter soumission formulaire avec rechargement = redirection ok
//Terminer la mise en page de la recommandation ok
//Prévoir un bouton  de retour à la page d'accueil
// Si assez de temps offrir la possibilité aux users de télécharger sa reco en fichier txt
?>

