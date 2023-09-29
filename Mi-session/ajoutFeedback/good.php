<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title></title>
</head>

<body>
    <?php
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require("../ConnServeur.php");
        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->query('SET NAMES utf8');
        
        $sql   =   "UPDATE `events` SET `good` = `good` + '1' WHERE `events`.`id` = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../feedbackEleve.php?id=". $id . "&action=1");
            exit();
        }

        $conn->close();
    }
    ?>
</body>

</html>