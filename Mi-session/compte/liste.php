<?php session_start(); ?>

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
                            <a href="https://www.cegeptr.qc.ca" target="_blank"><img src="../img/CTR_Logo_BLANC.png" class="logoCegepCon"></a>
                            <li>
                                <a href="#submenu1" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-speedometer2"></i>
                                    <h3 class="ms-1 d-none d-sm-inline">Compte</h3>
                                </a>
                                <ul class="show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="creerCompte.php" class="nav-link px-0"> <span class="d-none d-sm-inline"> Ajouter</span></a>
                                    </li>

                                    <li>
                                        <a href="liste.php" class="nav-link px-0 text-info"> <span class="d-none d-sm-inline">Afficher</span></a>
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
                    $ident = $_SESSION['ident'];
                    $conn->query('SET NAMES utf8');
                    $sql   =   "SELECT * FROM   usagers WHERE id='$ident'";

                    $result   =   $conn->query($sql);
                    if ($result->num_rows   >   0) {
                        $row   =   $result->fetch_assoc();
                        if ($row['role'] == 'admin') {
                            $conn->close();
                    ?>


                            <?php if (!empty($_GET)) {
                                $action = $_GET['action'];
                                switch ($action) {
                                    case 1:
                                        echo '<div class="alert alert-success" role="alert">
                                        Le compte à été supprimer avec succès
                                      </div>';
                                        break;
                                    case 2:
                                        echo '<div class="alert alert-success" role="alert">
                                        Le compte à été désactiver avec succès
                                     </div>';
                                        break;
                                    case 3:
                                        echo '<div class="alert alert-success" role="alert">
                                            Le compte à été activer avec succès
                                         </div>';
                                        break;
                                }
                            } ?>
                            <table class="table table-hover table-striped">

                                <tr>
                                    <th scope="col" class="bg-th text-white">Nom d'utilisateur</th>
                                    <th scope="col" class="bg-th text-white">Admin</th>
                                    <th scope="col" class="bg-th text-white"></th>
                                    <th scope="col" class="bg-th text-white"></th>
                                    <th scope="col" class="bg-th text-white"></th>
                                </tr>

                                <tr>
                                    <?php
                                    require("../ConnServeur.php");
                                    // Create connection
                                    $conn = new mysqli($servername, $username, $password, $db);
                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }
                                    $conn->query('SET NAMES utf8');
                                    $sql   =   "SELECT   username, id, enabled, role   FROM   usagers";
                                    $result   =   $conn->query($sql);
                                    if ($result->num_rows   >   0) {
                                        while ($row   =   $result->fetch_assoc()) {
// L'utilisateur avec le nom root n'apparait pas dans la liste sur le site
// L'utilisateur peut exister en tant que backup s'il y a un probleme avec les autres comptes
                                            if ($row['username'] != 'root') {
                                                echo '
                                <td class="bg-th text-white">' . $row["username"] . '</td> 
                                <td class="bg-th text-white">' . ($row["role"] == 'admin' ? 'Oui' : 'Non') . '</td> 
                                <td class="bg-th text-white">  <a href="modifier.php?id=' . $row["id"] . '" class="btn btn-primary">Modifier</a> </td>
                                <td class="bg-th text-white">  <a href="desactiver.php?id=' . $row["id"] . '" class="btn ' . ($row["enabled"] == 1 ? 'btn-info' : 'btn-warning') . '">' .
                                                    ($row["enabled"] == 1 ? 'Actif' : 'Inactif') . '</a> </td>
                                <td class="bg-th text-white">  <a href="supprimer.php?id=' . $row["id"] . '"  class="btn btn-danger">Supprimer</a> </td>
                                </tr> ';
                                            }
                                        }
                                    }
                                    $conn->close();

                                    ?>

                            </table>

                </div>
            </div>
        </div>

    <?php
                        } else { ?>
        <h1 class="text-white"> Vous n'avez pas les permissions nécessaires pour cette page</h1>
<?php };
                    }
                } else {
                    header('Location: ' . '../connexion.php');
                    die();
                } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>