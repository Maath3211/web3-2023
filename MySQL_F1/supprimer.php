<?php session_start()?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Supprimer</title>
</head>

<body>
    <?php 
    if ($_SESSION['connexion'] == true) {

    $id = $_GET['id']; ?>

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Nationalité</th>
                <th scope="col">Équipe</th>
                <th scope="col">Numéro</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET"){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $db = "f1";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $db);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $conn->query('SET NAMES utf8');
                $sql   =   "SELECT   id,   nom, nationalite, equipe, img, numero   FROM   pilote WHERE id=$id";
                $sqlDelete = "DELETE FROM `pilote` WHERE `pilote`.`id` = $id";
                $result   =   $conn->query($sql);
                while ($row   =   $result->fetch_assoc()) {
                    echo '
        <td>' . $row["id"] . '</td>
        <td>' . $row["nom"] . '</td> 
        <td>' . $row["nationalite"] . '</td>
        <td>' . $row["equipe"] . '</td>
        <td>' . $row["numero"] . '</td>
        <td>' . '<img src="' . $row["img"] . '" alt="$row["nom"]">' . '</td>
        </tr> ';
                }

                
                    
                if ($conn->query($sqlDelete) === TRUE) {
                        header("Location: index.php?action=1");
                        exit();
                }
            
                $conn->close();
            }
                ?>

        </tbody>
    </table>
    <div class=" text-center">
    <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_unset();
        session_destroy();
        header('Location: ' . 'conn.php');
        die();
     }
    } else {
        header('Location: ' . 'conn.php');
        die();
    } ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>