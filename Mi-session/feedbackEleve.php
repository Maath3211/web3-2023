<!DOCTYPE html>
<html lang="fr-ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <title>Feedback</title>
</head>

<body>
    <?php
    $id = $_GET['id'];
    ?>



    <a href="connexion.php" id="btnConn" class="btn btn-primary text-center">Connexion</a>
    <a href="index.php" id="btnRet" class="btn btn-danger text-center">Retour</a>
    <div id="container" class="container-fluid ">
        <div class="row text-center py-5">
            <div class="col-12 ">


                <h2 class="mt-5">Comment était l'événement?</h2>
                <h4>Étudiant</h4>
                <?php
                if (!empty($_GET['action'])) {
                    $action = $_GET['action'];
                    if ($action == 1) {
                        echo '<div class="alert alert-success" id="actionTxt" role="alert">
                            Votre vote a été enregistré.
                          </div>';
                        header("Refresh: 2; url='feedbackEleve.php?id=$id'");
                        echo '<div class="mt-5" id="divFormEl">
                        <img src="img/sad-face.png" alt="sad" class="imgFace" />
    
                        <img src="img/neutral-face.png" alt="neutral" class="imgFace" />
    
                        <img src="img/happiness.png" alt="happy" class="imgFace" />
                    </div>';
                    }
                }
                
                
                else{
                
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $db = "smileyface";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $db);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $conn->query('SET NAMES utf8');
                $sql   =   "SELECT   actif   FROM   events WHERE `events`.`id` = $id;";
                $result   =   $conn->query($sql);
                if (mysqli_query($conn,    $sql)) {
                    if ($result->num_rows   >   0) {
                        while ($row   =   $result->fetch_assoc()) {
                            if ($result->num_rows   >   0) {
                                if ($row["actif"] == 0) {
                                    echo '<div class="alert alert-danger" role="alert">
                            <h1>Les votes sont désactivés</h1>
                         </div>
                                    <div class="mt-5" id="divFormEl">
                                    <img src="img/sad-face.png" alt="sad" class="imgFace" />
                
                                    <img src="img/neutral-face.png" alt="neutral" class="imgFace" />
                
                                    <img src="img/happiness.png" alt="happy" class="imgFace" />
                                </div>';
                                } else {
                                    echo '
                                    <div class="mt-5" id="divFormEl">
                                    <a href="ajoutFeedback/bad.php?id='. $id .'" class="btnFeed"><img src="img/sad-face.png" alt="sad" class="imgFace" /></a>
                
                                    <a href="ajoutFeedback/neutral.php?id='. $id .'" class="btnFeed"><img src="img/neutral-face.png" alt="neutral" class="imgFace" /></a>
                
                                    <a href="ajoutFeedback/good.php?id='. $id .'" class="btnFeed"><img src="img/happiness.png" alt="happy" class="imgFace" /></a>
                                </div>';
                                }
                            }
                        }
                    }
                    $conn->close();
                } else {
                    echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
                }
            }
                ?>


            </div>
        </div>
    </div>
    <?php
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>