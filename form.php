<?php
session_start();
if (!isset($_SESSION['consent'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/form.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>HoneyMoon - Formulaire</title>
</head>

<body>
    <form id="form" action="submit.php" method="post">
    </form>
    <script src="js_scripts/form.js"></script>
</body>

</html>