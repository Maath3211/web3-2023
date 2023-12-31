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

<body class="bodyCegep">
    <?php
    if ($_SESSION['connexion'] == true) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $erreur = false;
            if (empty($_POST['event'])) {
                $erreur = true;
                echo "Le nom de l'évenement est requis <br>";
            }
            if (empty($_POST['lieu'])) {
                $erreur = true;
                echo "Le lieu est requis <br>";
            }
            if (empty($_POST['dateEvent'])) {
                $erreur = true;
                echo "La date est requise <br>";
            }
            if (empty($_POST['dep'])) {
                $erreur = true;
                echo "Le département est requis <br>";
            }

            if ($erreur == false) {
                $nom = $_POST['event'];
                $lieu = $_POST['lieu'];
                $dateEvent = $_POST['dateEvent'];
                $dep = $_POST['dep'];

                require("../ConnServeur.php");
                // Create connection
                $conn = new mysqli($servername, $username, $password, $db);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $conn->query('SET NAMES utf8');
                $sql   =   "INSERT INTO `events` (`id`, `date`, `lieu`, `nom`, `departement`, `actif`, `bad`, `neutral`, `good`, `badEmp`, `neutralEmp`, `goodEmp`) 
            VALUES (NULL, '$dateEvent', '$lieu', '$nom', '$dep',0,0,0,0,0,0,0);";

                if (mysqli_query($conn,    $sql)) {
                    header("Location: afficher.php?action=2");
                } else {
                    echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
                }
                $conn->close();
            }
        }
    ?>



        <div id="container" class="container-fluid">
            <div class="row">
            

                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <a href="https://www.cegeptr.qc.ca" target="_blank"><img src="../img/CTR_Logo_BLANC.png" class="logoCegepCon"></a>

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
                                    <a href="" class="nav-link px-0 text-info"> <span class="d-none d-sm-inline">Ajouter</span></a>
                                </li>
                                <li>
                                    <a href="afficher.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Afficher</span></a>
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







                <div class="col-7 offset-1 py-5 text-center">
                    <h2 class="text-white">Ajouter un évenement</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="event" class="text-white">Nom de l'évenement</label>
                            <input type="text" class="form-control" name="event" placeholder="Entrez le nom de l'évenement">
                        </div>
                        <div class="form-group mt-2">
                            <label for="lieu" class="text-white">Lieu</label>
                            <input type="text" class="form-control" name="lieu" placeholder="Entrez le Lieu">
                        </div>
                        <div class="form-group mt-2">
                            <label for="dateEvent" class="text-white">Date</label>
                            <input type="date" class="form-control" name="dateEvent" placeholder="Entrez la date">
                        </div>
                        <div class="form-group mt-2">
                            <div class="form-group">
                                <label for="dep" class="mt-2 text-white">Événement</label>
                                <select name="dep" id="select" class="form-select">
                                    <?php
                                    require("../ConnServeur.php");
                                    // Create connection
                                    $conn = new mysqli($servername, $username, $password, $db);
                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                        echo 'Connexion à la base de donnée impossible';
                                    }
                                    $conn->query('SET NAMES utf8');
                                    $sql2   =   "SELECT id, nom FROM `departement`";
                                    $result2   =   $conn->query($sql2);
                                    if ($result2->num_rows   >   0) {
                                        // selected="selected"
                                        while ($row2   =   $result2->fetch_assoc()) {
                                            echo ' <option value="' . $row2["nom"] . '">' . $row2["nom"] . '</option>';
                                        }
                                    };
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-info">Ajouter un évenement</button>
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