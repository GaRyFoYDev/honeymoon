<?php
require 'user.php';
require 'item.php';

// Le contenu des recommandations
$contenuReco = "Recommandations basées sur les utilisateurs qui partagent vos préférences de voyages:\n";
$contenuReco .= "1. " . $userRecommendations[0] . "\n";
$contenuReco .= "2. " . $userRecommendations[1] . "\n";
$contenuReco .= "3. " . $userRecommendations[2] . "\n\n";
$contenuReco .= "Recommandations basées sur votre destination de lune de miel idéale:\n";
$contenuReco .= "1. " . $itemRecommendations[0] . "\n";
$contenuReco .= "2. " . $itemRecommendations[1] . "\n";
$contenuReco .= "3. " . $itemRecommendations[2] . "\n";

$nomFichier = "recommandations.txt";


header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $nomFichier . '"');


echo $contenuReco;

