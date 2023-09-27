<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <title>Paramètre</title>
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        if (!empty($_GET["id"])) $id = $_GET['id'];
        if (!empty($_POST["id"])) $id = $_POST['id'];
    ?>



        <div id="container" class="container-fluid">
            <div class="row">

                <!-- navigation bar -->
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                            <li class="nav-item">
                            </li>

                            <li>
                                <a href="#submenu1" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-speedometer2"></i>
                                    <h3 class="ms-1 d-none d-sm-inline">Compte</h3>
                                </a>
                                <ul class="nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="../compte/creerCompte.php" class="nav-link px-0"> <span class="d-none d-sm-inline"> Ajouter</span></a>
                                    </li>

                                    <li>
                                        <a href="../compte/liste.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Afficher</span></a>
                                    </li>
                                </ul>
                            </li>

                            <a href="#submenu2" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i>
                                <h2 class="ms-1 d-none d-sm-inline">Évenement</h2>
                            </a>
                            <ul class="show nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">

                                <li>
                                    <a href="ajouter.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Ajouter</span></a>
                                </li>
                                <li>
                                    <a href="afficher.php" class="nav-link px-0 text-info"> <span class="d-none d-sm-inline">Afficher</span></a>
                                </li>
                                <li>
                                    <a href="ajoutDep.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Département</span></a>
                                </li>
                            </ul>
                            </li>
                            <a href="../deconnexion.php"><button type="submit" class="btn btn-primary btnDecon">Se déconnecter</button></a>
                        </ul>
                        </li>

                    </div>
                </div>


                <div class="col-6 offset-1 py-5 text-center">
                    
<!-- PHP modifier -->
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
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $erreur = false;
                        if (empty($_POST['event'])) {
                            $erreur = true;
                        }
                        if (empty($_POST['lieu'])) {
                            $erreur = true;
                        }
                        if (empty($_POST['dateEvent'])) {
                            $erreur = true;
                        }
                        if (empty($_POST['dep'])) {
                            $erreur = true;
                        }

                        if ($erreur == false) {
                            $nom = $_POST['event'];
                            $lieu = $_POST['lieu'];
                            $dateEvent = $_POST['dateEvent'];
                            $dep = $_POST['dep'];
                            $id = $_POST['id'];


                            $conn->query('SET NAMES utf8');
                            $sql   =   "UPDATE `events` SET `nom` = '$nom', `lieu` = '$lieu', `date` = '$dateEvent', `departement` = '$dep' WHERE `events`.`id` = $id;";
                            if (mysqli_query($conn,    $sql)) {
                                header("Location: afficher.php?action=5");
                            } else {
                                echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
                            }
                        }
                    }
                    $conn->close();
                    ?>


                    <!-- Afficher info -->


                    <h2>Modifier un évenement</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                        $sql   =   "SELECT id, nom,date,lieu,departement FROM `events` WHERE `id`=$id";
                        $result   =   $conn->query($sql);
                        if ($result->num_rows   >   0) {

                            while ($row   =   $result->fetch_assoc()) {
                                echo '
                                <div class="form-group">
                    <input type="text" hidden class="form-control" name="id" value="' . $row['id'] . '">
                </div>
                                            <div class="form-group">
                            <label for="event">Nom de l\'évenement</label>
                            <input type="text" class="form-control" name="event" value="' . $row['nom'] . '" placeholder="Entrez le nom de l\'évenement">
                        </div>
                        <div class="form-group mt-2">
                            <label for="lieu">Lieu</label>
                            <input type="text" class="form-control" name="lieu" value="' . $row['lieu'] . '" placeholder="Entrez le Lieu">
                        </div>
                        <div class="form-group mt-2">
                            <label for="dateEvent">Date</label>
                            <input type="date" class="form-control" name="dateEvent" value="' . $row['date'] . '" placeholder="Entrez la date">
                        </div>
                        <div class="form-group mt-2">
                            <div class="form-group">
                                <label for="dep" class="mt-2">Événement</label>
                                <select name="dep" id="select" class="form-select">
                                ';
                                $sql2   =   "SELECT id, nom FROM `departement`";
                                $result2   =   $conn->query($sql2);
                                if ($result2->num_rows   >   0) {
                                    // selected="selected"
                                    while ($row2   =   $result2->fetch_assoc()) {
                                        echo '
                                <option '; if ($row['departement'] == $row2['nom']) 
                                echo 'selected="selected"'; 
                                echo ' value="' . $row2["nom"] . '">' . $row2["nom"] . '</option>';
                                    }
                                };
                            }
                            
                        }

                        $conn->close();
                        ?>
                        </select>
                </div>
                
               
            </div>
            <br>
            <button type="submit" class="btn btn-info">Modifier l'évenement</button>
            <br>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
             if (empty($_POST['event'])) {
                echo "Le nom de l'évenement est requis <br>";
            }
            if (empty($_POST['lieu'])) {
                echo "Le lieu est requis <br>";
            }
            if (empty($_POST['dateEvent'])) {
                echo "La date est requise <br>";
            }
            if (empty($_POST['dep'])) {
                echo "Le département est requis <br>";
            }
        }
            ?>
             
            </form>

        <?php

    } else {
        header('Location: ' . '../connexion.php');
        die();
    }
        ?>
        </div>
        </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>