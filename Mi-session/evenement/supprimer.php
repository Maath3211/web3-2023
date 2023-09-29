<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <title>Supprimer</title>
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        $id = $_GET['id']; ?>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require("../ConnServeur.php");
            // Create connection
            $conn = new mysqli($servername, $username, $password, $db);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $conn->query('SET NAMES utf8');
            $sql   =   "DELETE FROM `events` WHERE `events`.`id` = $id";

            if ($conn->query($sql) === TRUE) {
                header("Location: afficher.php?action=1");
                exit();
            }

            $conn->close();
        }
        ?>

        </tbody>
        </table>
        <div class=" text-center">
        <?php
    } ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>