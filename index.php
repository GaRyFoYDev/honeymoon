<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Yellowtail&display=swap"
        rel="stylesheet">
    <title>HoneyMoon - Accueil</title>
</head>

<body>
    <div class="welcome-message">
        <div id=neon>
            <h2 id='honey'>HoneyMoon</h2>
            <h3 id="welcome">Recommandation de lune de miel</h3>
        </div>
        <h3>Comment ça marche ?</h3>
        <ol>
            <li>Répondez à 20 questions permettant d'évaluer vos préférences de voyages.</li>
            <li>Recevez des recommandations personnalisées pour votre lune de miel.</li>
        </ol>
        <h3>Respect de la vie privée</h3>
        <p>Votre vie privée est importante pour nous. Conformément au RGPD,<br>
            nous utilisons vos choix pour améliorer nos services et aider d'autres utilisateurs.</p>
        <p>Vos données ne seront utilisées qu'avec votre consentement.
        </p>
        <p>Afin d'accéder au site, veuillez accepter nos conditions d'utilisation.</p>
        <label>
            <input type="checkbox" id="rgpdconsentement">
            J'accepte que mes choix soient conservés et utilisés pour aider de futurs utilisateurs.
        </label>
        <button id="enterButton">Entrez</button>
    </div>

    <script src="js_scripts/index.js"></script>
</body>

</html>