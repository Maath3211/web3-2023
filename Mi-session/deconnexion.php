<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_unset();
    session_destroy();
    header('Location: ' . 'connexion.php');
    die();
}
 else {
header('Location: ' . 'connexion.php?action=1');
die();
} ?>
</body>
</html>