<?php
// Récupérer les données du formulaire
// Enregistrer les données dans la bdd pour enrichir les recommandations futures
// Récupérer la dernière entrée de la bdd correspondant au formulaire soumie dans le script python
// Récupérer et afficher la recommandation
// Améliorer l'affichage avec css

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}



?>