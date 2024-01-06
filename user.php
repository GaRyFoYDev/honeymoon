<?php
require_once 'cosineSimilarity.php';

try {
    // Connexion à la base de données
    $conn = new PDO('sqlite:honeymoon.db');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation et exécution de la requête
    $stmt = $conn->prepare("SELECT * FROM survey");
    $stmt->execute();

    // Récupération et traitement des données
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($datas)

    $matrix = [];
    foreach ($datas as $data) {
        array_shift($data); // Supprime le premier élément (id)
        $matrix[] = array_values($data); // Ajoute le reste des données
    }
    //var_dump($matrix);

    // Définition de la fonction get_reco
    function get_userReco($matrix)
    {
        $theitem = $matrix[count($matrix) - 1];
        $others = array_slice($matrix, 0, -1);


        foreach ($others as $index => $item) {
            $item_similarity = Recommendations::cosine_similarity(array_slice($theitem, 0, -1), array_slice($item, 0, -1));
            $item['similarity'] = $item_similarity;
            $others[$index] = $item;

        }

        // Trier les autres par similarité décroissante
        usort($others, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        // foreach($others as $index => $item){
        //     var_dump($item[19]);
        // }

        $userRecommendations = [];
        foreach ($others as $item) {
            if ($item[19] !== 'Je ne sais pas' && $item[19] !== $theitem[19] && !in_array($item[19], $userRecommendations)) {
                $userRecommendations[] = $item[19];

            }
            if (count($userRecommendations) == 3) {
                break;
            }
        }

        return $userRecommendations;
    }

    // Utiliser get_reco et insérer les recommandations dans la base de données
    $userRecommendations = get_userReco($matrix);

    // Fermeture de la connexion
    $conn = null;

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

?>