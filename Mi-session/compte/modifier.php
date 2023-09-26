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

                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                            <li class="nav-item">
                            </li>

                            <li>
                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-speedometer2"></i>
                                    <h3 class="ms-1 d-none d-sm-inline">Compte</h3>
                                </a>
                                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="" class="nav-link px-0"> <span class="d-none d-sm-inline"> Ajouter</span></a>
                                    </li>

                                    <li>
                                        <a href="liste.php" class="nav-link px-0 text-info"> <span class="d-none d-sm-inline">Afficher</span></a>
                                    </li>
                                </ul>
                            </li>

                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i>
                                <h2 class="ms-1 d-none d-sm-inline">Évenement</h2>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">

                                <li>
                                    <a href="../evenement/ajouter.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Ajouter</span></a>
                                </li>
                                <li>
                                    <a href="../evenement/afficher.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Afficher</span></a>
                                </li>
                                <li>
                                    <a href="../evenement/ajoutDep.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Département</span></a>
                                </li>
                            </ul>
                            </li>
                            <a href="../deconnexion.php"><button type="submit" class="btn btn-primary btnDecon">Se déconnecter</button></a>
                        </ul>
                        </li>

                    </div>
                </div>








                <div class="col-6 offset-1">
                    <div class="row align-items-center" id="row1Mod">

                        <?php
                        
                        $servername    =    "localhost";
                        $username    =    "root";
                        $password    =    "root";
                        $dbname    =    "smileyface";
                        //    Create    connection
                        $conn    =    mysqli_connect($servername,    $username,    $password,    $dbname);
                        //    Check    connection
                        if (!$conn) {
                            die("Connection    failed:    "    .    mysqli_connect_error());
                        }
                        $conn->query('SET NAMES utf8');
                        $sql   =   "SELECT   id,   username FROM   usagers WHERE id = $id";
                        $result   =   $conn->query($sql);
                        if ($result->num_rows   >   0) {
                            $row   =   $result->fetch_assoc();
                            $nomUser = $row["username"];
                            $id = $row["id"];
                        }
                        mysqli_close($conn);

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $erreur = false;
                        if (empty($_POST['username'])) {
                            $erreur = true;
                            echo "Le nom est requis <br>";
                        }
                        if (empty($_POST['pass'])) {
                            $erreur = true;
                            echo "Le mot de passe est requis <br>";
                        }
                        if (empty($_POST['passConf'])) {
                            $erreur = true;
                            echo "La confirmation de mot de passe est requise <br><br>";
                        }
                            $servername    =    "localhost";
                            $username    =    "root";
                            $password    =    "root";
                            $dbname    =    "smileyface";
                            //    Create    connection
                            $conn    =    mysqli_connect($servername,    $username,    $password,    $dbname);
                            //    Check    connection
                            if (!$conn) {
                                die("Connection    failed:    "    .    mysqli_connect_error());
                            }
                            if($erreur == false){
                            $nom = '"' . $_POST['username'] . '"';
                            $pass = $_POST['pass'];
                            $passConf = $_POST['passConf'];

                            if ($pass == $passConf) {
                                $pass = "'" . sha1($pass, false) . "'";

                                $sql    =    "UPDATE `usagers` SET `username` = $nom, `password` = $pass WHERE `usagers`.`id` = $id;";
                                if (mysqli_query($conn,    $sql)) {
                                    header("Location: liste.php");
                                    exit();
                                } else {
                                    echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
                                }
                            } else echo 'Les mots de passe ne correspondent pas<br><br>';
                            $conn->close();
                        }
                        }
                        ?>
                    </div>
                    <div class="row">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $nomUser ?>" placeholder="Entrez le nom d'utilisateur">
                            </div>
                            <div class="form-group">
                                <label for="pass">Mot de passe</label>
                                <input type="password" class="form-control" name="pass" placeholder="Entrez le mot de passe">
                            </div>
                            <div class="form-group">
                                <label for="passConf">Confirmation du Mot de passe</label>
                                <input type="password" class="form-control" name="passConf" placeholder="Entrez la confirmation de mot de passe">
                            </div>
                            <div class="form-group">
                                <input type="text" hidden class="form-control" name="id" value="<?php echo $id ?>">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <a class='btn btn-secondary' href='liste.php' role='button'>Retour</a>
                        </form>
                    </div>



                <?php

            } else {
                header('Location: ' . 'conn.php');
                die();
            } ?>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>