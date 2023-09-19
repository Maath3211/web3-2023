<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Paramètre</title>
</head>

<body>
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
                $sql   =   "INSERT INTO `events` (`id`, `date`, `lieu`, `nom`, `departement`, `bad`, `neutral`, `good`, `badEmp`, `neutralEmp`, `goodEmp`) 
            VALUES (NULL, '$dateEvent', '$lieu', '$nom', '$dep',0,0,0,0,0,0);";

                if (mysqli_query($conn,    $sql)) {
                    header("Location: afficher.php");
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
                        <!-- <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a> -->
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                            <li class="nav-item">
                                <!-- <a href="#" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a> -->
                            </li>

                            <li>
                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-speedometer2"></i>
                                    <h3 class="ms-1 d-none d-sm-inline">Compte</h3>
                                </a>
                                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="../compte/creerCompte.php" class="nav-link px-0"> <span class="d-none d-sm-inline"> Ajouter</span></a>
                                    </li>

                                    <li>
                                        <a href="../compte/liste.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Modifier</span></a>
                                    </li>
                                </ul>
                            </li>

                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i>
                                <h2 class="ms-1 d-none d-sm-inline">Évenement</h2>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">

                                <li>
                                    <a href="" class="nav-link px-0"> <span class="d-none d-sm-inline">Ajouter</span></a>
                                </li>
                                <li>
                                    <a href="afficher.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Modifier</span></a>
                                </li>
                            </ul>
                            </li>
                            <form action="../deconnexion.php ?>" method="POST">
                                <button type="submit" class="btn btn-primary btnDecon">Se déconnecter</button>
                            </form>
                        </ul>
                        </li>

                    </div>
                </div>







                <div class="col-6 offset-1 py-5 text-center">
                    <h2>Ajouter un évenement</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="event">Nom de l'évenement</label>
                            <input type="text" class="form-control" name="event" placeholder="Entrez le nom de l'évenement">
                        </div>
                        <div class="form-group mt-2">
                            <label for="lieu">Lieu</label>
                            <input type="text" class="form-control" name="lieu" placeholder="Entrez le Lieu">
                        </div>
                        <div class="form-group mt-2">
                            <label for="dateEvent">Date</label>
                            <input type="date" class="form-control" name="dateEvent" placeholder="Entrez la date">
                        </div>
                        <div class="form-group mt-2">
                        <label for="dep">Département</label>
                        <input type="text" class="form-control" name="dep" placeholder="Entrez le département">
                    </div>
                        <br>
                        <button type="submit" class="btn btn-info">Ajouter un évenement</button>
                    </form>

                <?php
                
        }
                ?>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>