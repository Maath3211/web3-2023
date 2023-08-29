<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Formule 1</title>
</head>

<body>

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Nationalité</th>
                <th scope="col">Équipe</th>
                <th scope="col">Numéro</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
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
                $sql   =   "SELECT   id,   nom, nationalite, equipe, img, numero   FROM   pilote";
                $result   =   $conn->query($sql);
                if ($result->num_rows   >   0) {

                    while ($row   =   $result->fetch_assoc()) {
                        echo '<td>' . $row["nom"] . '</td> 
        <td>' . $row["nationalite"] . '</td>
        <td>' . $row["equipe"] . '</td>
        <td>' . $row["numero"] . '</td>
        <td>' . '<img src="' . $row["img"] . '" alt="$row["nom"]">' . '</td>
        </tr>';
                    }
                } else {
                    echo   "0   results";
                }
                $conn->close();
                ?>
        </tbody>
    </table>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>