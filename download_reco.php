<?php

session_start();

// Le contenu des recommandations
$contenuReco = "Recommendations basées sur les utilisateurs qui partagent vos préférences de voyages:\n";
$contenuReco .= "1. " . $_SESSION['reco1'] . "\n";
$contenuReco .= "2. " . $_SESSION['reco2'] . "\n";
$contenuReco .= "3. " . $_SESSION['reco3'] . "\n\n";
$contenuReco .= "Recommendations basées sur votre destination de lune de miel idéale:\n";
$contenuReco .= "1. " . $_SESSION['reco4'] . "\n";
$contenuReco .= "2. " . $_SESSION['reco5'] . "\n";
$contenuReco .= "3. " . $_SESSION['reco6'] . "\n";

$nomFichier = "recommandations.txt";


header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $nomFichier . '"');


echo $contenuReco;

session_unset();
session_destroy();
