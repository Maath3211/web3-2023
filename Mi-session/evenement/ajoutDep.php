<?php session_start(); ?>

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

    ?>

        <div id="container" class="container-fluid">
            <div class="row">

                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">


                            <li>
                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-speedometer2"></i>
                                    <h3 class="ms-1 d-none d-sm-inline">Compte</h3>
                                </a>
                                <ul class="collapse  nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
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
                            <ul class="collapse show nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">

                                <li>
                                    <a href="ajouter.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Ajouter</span></a>
                                </li>
                                <li>
                                    <a href="afficher.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Afficher</span></a>
                                </li>
                                <li>
                                    <a href="" class="nav-link px-0 text-info"> <span class="d-none d-sm-inline">Département</span></a>
                                </li>
                            </ul>
                            </li>
                            <a href="../deconnexion.php"><button type="submit" class="btn btn-primary btnDecon">Se déconnecter</button></a>
                        </ul>
                        </li>

                    </div>
                </div>

                <div class="col-7 offset-1 ">
                    <?php if (!empty($_GET)) {
                        $action = $_GET['action'];
                        switch ($action) {
                            case 1:
                                echo '<div class="alert alert-success alDep" role="alert">
                                        Le département à été supprimer avec succès
                                      </div>';
                                break;
                            case 2:
                                echo '<div class="alert alert-success alDep" role="alert">
                                            Le département à été ajouter avec succès
                                          </div>';
                                break;
                        }
                    } 
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $erreur = false;
                                if (empty($_POST['nom'])) {
                                    $erreur = true;
                                }

                                if ($erreur == false) {
                                    $nom = $_POST['nom'];

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
                                    $sql   =   "INSERT INTO `departement` (`id`, `nom`) 
                    VALUES (NULL, '$nom');";

                                    if (mysqli_query($conn,    $sql)) {
                                        header("Location: ajoutDep.php?action=2");
                                    } else {
                                        echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
                                    }
                                    $conn->close();
                                }
                            }
                    ?>
                    <table class="table table-hover table-striped" id="tableAjoutDep">
                        <thead>
                            <tr>
                                <th scope="col">Nom du département</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
                                $conn->query('SET NAMES utf8');
                                $sql   =   "SELECT   id,nom FROM   departement";
                                $result   =   $conn->query($sql);
                                if ($result->num_rows   >   0) {

                                    while ($row   =   $result->fetch_assoc()) {
                                        echo '
                                <td>' . $row["nom"] . '</td> 
                                <td>  <a href="suppDep.php?id=' . $row["id"] . '" class="btn btn-danger">Supprimer</a> </td>
                                </tr> ';
                                    }
                                }
                                $conn->close();

                                ?>
                        </tbody>
                    </table>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="formAjoutDep" method="POST">
                        <div class="form-group text-center">
                            <label for="nom">Ajouter un département</label>
                            <input type="text" class="form-control" id="creerDep" name="nom" placeholder="Entrez le nom du département">
                            <button type="submit" class="btn btn-info">Créer un département</button>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (empty($_POST['nom'])) {
                                    echo "<p>Le nom du département est requis <br></p>";
                                }
                            }
                            ?>
                        </div>
                    </form>


                </div>
            </div>
        </div>

    <?php

    } else {
        header('Location: ' . '../connexion.php');
        die();
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>