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
        require("../ConnServeur.php");
        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    ?>



        <div id="container" class="container-fluid">
            <div class="row">


                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <img src="../img/CTR_Logo_BLANC.png" class="logoCegepCon">
                            <li>
                                <a href="#submenu1" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-speedometer2"></i>
                                    <h3 class="ms-1 d-none d-sm-inline">Compte</h3>
                                </a>
                                <ul class="show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="" class="nav-link px-0 text-info"> <span class="d-none d-sm-inline"> Ajouter</span></a>
                                    </li>

                                    <li>
                                        <a href="liste.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Afficher</span></a>
                                    </li>
                                </ul>
                            </li>

                            <a href="#submenu2" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i>
                                <h2 class="ms-1 d-none d-sm-inline">Évenement</h2>
                            </a>
                            <ul class="nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">

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




                <div class="col-7 offset-1 py-5 text-center">
                <?php 
                $ident= $_SESSION['ident'];
                $conn->query('SET NAMES utf8');
                $sql   =   "SELECT * FROM   usagers WHERE id='$ident'";

                $result   =   $conn->query($sql);
                if ($result->num_rows   >   0) {
                    $row   =   $result->fetch_assoc();
                    if($row['role'] == 'admin'){
                ?>

                
                    <h2 class="text-white">Ajouter un utilisateur</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="nom" class="text-white">Nom d'utilisateur</label>
                            <input type="text" class="form-control" name="nom" placeholder="Entrez le nom d'utilisateur">
                        </div>
                        <div class="form-group mt-2">
                            <label for="password" class="text-white">Mot de passe</label>
                            <input type="password" class="form-control" name="password" placeholder="Entrez le mot de passe">
                        </div>
                        <div class="form-group mt-2">
                            <label for="passwordConf" class="text-white">Confirmation de mot de passe</label>
                            <input type="password" class="form-control" name="passwordConf" placeholder="Entrez le mot de passe">
                        </div>
                        <!-- <div class="form-group mt-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Entrez l'email">
                    </div> -->
                        <div class="form-group mt-2">
                            <input class="form-check-input" name="admin" type="checkbox" value="admin" id="admin">
                            <label class="form-check-label text-white" for="admin">Admin  <a title="Permet la modification d'usager">&#x1F6C8;</a></label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-info">Créer un compte</button>
                    </form>

                <?php


                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $erreur = false;
                    if (empty($_POST['nom'])) {
                        $erreur = true;
                        echo "<p class=\"requis fw-bold\">Le nom est requis<br>";
                    }
                    if (empty($_POST['password'])) {
                        $erreur = true;
                        echo "Le mot de passe est requis<br>";
                    }
                    if (empty($_POST['passwordConf'])) {
                        $erreur = true;
                        echo "La confirmation de mot de passe est requise</p>";
                    }
                    // if (empty($_POST['email'])) {
                    //     $erreur = true;
                    //     echo "L'email est requis <br>";
                    // }
                    $pass = $_POST['password'];
                    $passConf = $_POST['passwordConf'];
                    if ($pass !== $passConf) {
                        $erreur = true;
                        echo "Les mots de passes ne sont pas les même <br>";
                    }

                    if ($erreur == false) {
                        $nom = $_POST['nom'];
                        $pass = $_POST['password'];
                        $pass = "'" . sha1($pass, false) . "'";
                        $email = NULL; //$_POST['email'];
                        $userIndispo = false;


                        $conn->query('SET NAMES utf8');
                        if (isset($_POST['admin']))
                            $sql   =   "INSERT INTO `usagers` (`id`, `username`, `email`, `password`, `enabled`,`role`) 
                    VALUES (NULL, '$nom', '$email', $pass, 1,'admin');";
                        else $sql   =   "INSERT INTO `usagers` (`id`, `username`, `email`, `password`, `enabled`,`role`) 
                    VALUES (NULL, '$nom', '$email', $pass, 1,'');";

                        $sqlCheck   =   "SELECT   username FROM   usagers";
                        $result   =   $conn->query($sqlCheck);
                        if ($result->num_rows   >   0) {
                            while ($row   =   $result->fetch_assoc()) {
                                if ($nom === $row["username"])
                                    $userIndispo = true;
                            }

                            if ($userIndispo == false) {
                                if (mysqli_query($conn,    $sql)) {
                                    echo '<h5 id="ajoutCompte">Compte ajouté avec succès<h5>';
                                } else {
                                    echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
                                }
                            } else echo '<h4 class="rouge font-weight-bold">Nom d\'utilisateur déja utilisé</h4>';
                        }
                    }
                }
            } else{ ?> 
            <h1 class="text-white"> Vous n'avez pas les permissions pour cette page</h1>
            <?php };
        } 
            } else {
                header('Location: ' . '../connexion.php');
                die();
            }

       
            $conn->close(); ?>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>