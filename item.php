<?php
require_once 'cosineSimilarity.php';

$conn = new PDO('sqlite:honeymoon.db');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Sélection de la dernière soumission sauvegardé dans la bdd
$stmt = $conn->prepare("SELECT * FROM survey ORDER BY id DESC LIMIT 1");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
//var_dump($result);
$userDestinationChoice = $result['question20'];
//var_dump($userDestinationChoice);

//Sélection de la table destinations
$stmt = $conn->prepare("SELECT * FROM destinations");
$stmt->execute();
$destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($destinations); 

// Suppression de l'id
$matrix = [];
foreach ($destinations as $destination) {
    $matrix[] = array_slice($destination, 1);
}
//var_dump($matrix)

#Récupérer le vecteur correspond à la destination idéla de user
function getItem($matrix, $userDestinationChoice)
{
    foreach ($matrix as $vector) {
        if (trim(strtolower($vector[array_key_first($vector)])) == strtolower($userDestinationChoice)) {
            return $vector;


        }
    }
}

//print_r(getItem($matrix,$userDestinationChoice));

function get_itemReco($matrix, $userDestinationChoice)
{
    $theitem = getItem($matrix, $userDestinationChoice);

    $others = [];
    foreach ($matrix as $item) {
        if ($item !== $theitem) {
            $others[] = $item;
        }
    }
    //var_dump($matrix);
    //var_dump($others);



    foreach ($others as $index => $item) {
        $item_similarity = Recommendations::cosine_similarity(array_slice($theitem, 1), array_slice($item, 1));
        $item['similarity'] = $item_similarity;
        $others[$index] = $item;

    }


    //print_r($others);

    // Trier les autres par similarité décroissante
    usort($others, function ($a, $b) {
        return $b['similarity'] <=> $a['similarity'];
    });
    // print_r($others);



    $itemRecommendations = [];
    foreach ($others as $item) {
        if ($item['destination'] !== $theitem['destination'] && !in_array($item['destination'], $itemRecommendations)) {
            $itemRecommendations[] = $item['destination'];
        }
        if (count($itemRecommendations) == 3) {
            break;
        }
    }
    return $itemRecommendations;
}

$itemRecommendations = get_itemReco($matrix, $userDestinationChoice);
?>