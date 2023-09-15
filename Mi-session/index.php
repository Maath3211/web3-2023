<!DOCTYPE html>
<html lang="fr-ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <title>Feedback</title>
</head>

<body>
    <a href="connexion.php" id="btnConn" class="btn btn-primary text-center">Connexion</a>

    <div id="container" class="container-fluid ">
        <div class="row text-center py-5">
            <div class="col-6 offset-3">

                <h1>Choix de l'événement</h1>
                <div class="form-group">
                    <label for="event" class="mt-2">Événement</label>
                    <select name="event" id="select" class="form-select">

                        <?php 
                        $servername = "localhost";
                        $username = "root";
                        $password = "root";
                        $db = "smileyface";
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $db);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                            echo 'Connexion à la base de donnée impossible';
                        }
                        $conn->query('SET NAMES utf8');
                        $sql   =   "SELECT id, nom FROM `events`";
                        $result   =   $conn->query($sql);
                        if ($result->num_rows   >   0) {

                            while ($row   =   $result->fetch_assoc()) {
                                echo '
                                <option value="' . $row["id"] . '">' . $row["nom"] . '</option>';
                            }
                        }
                        $conn->close();


                        ?>


                    </select>
                </div>
                <button type="button" id="btnFeedEl" class="btn btn-info">Continuer(Étudiant)</button>
                <button type="button" id="btnFeedEmp" class="btn btn-success">Continuer(Employeur)</button>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>