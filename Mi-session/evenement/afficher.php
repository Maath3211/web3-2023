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
                                    <a href="" class="nav-link px-0 text-info"> <span class="d-none d-sm-inline">Afficher</span></a>
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








                <div class="col-9 ">
                    <div id="divAcAff" class="m-2 m">
                    <?php if (!empty($_GET)) {
                        $action = $_GET['action'];
                        switch ($action) {
                            case 1:
                                echo '<div class="alert alert-success" role="alert">
                                        L\'évenement à été supprimer avec succès
                                      </div>';
                                break;
                            case 2:
                                echo '<div class="alert alert-success" role="alert">
                                            L\'évenement à été ajouter avec succès
                                          </div>';
                                break;
                            case 3:
                                echo '<div class="alert alert-success" role="alert">
                                L\'évenement à été désactiver avec succès
                                              </div>';
                                break;
                            case 4:
                                echo '<div class="alert alert-success" role="alert">
                                L\'évenement à été activé avec succès
                                                  </div>';
                                break;
                            case 5:
                                echo '<div class="alert alert-success" role="alert">
                                    L\'évenement à été modifier avec succès
                                                      </div>';
                                break;
                        }
                    } ?>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nom de l'évenement</th>
                                <th scope="col">Département</th>
                                <th scope="col">Date</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
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
                                $sql   =   "SELECT   id,nom, lieu,departement,date,actif FROM   events ORDER BY date DESC, actif DESC";
                                $result   =   $conn->query($sql);
                                if ($result->num_rows   >   0) {

                                    while ($row   =   $result->fetch_assoc()) {
                                        echo '
                                <td>' . $row["nom"] . '</td> 
                                <td>' . $row["departement"] . '</td> 
                                <td>' . $row["date"] . '</td> 
                                <td>  <a href="plusInfo.php?id=' . $row["id"] . '" class="btn btn-primary">Plus d\'information</a> </td>
                                <td>  <a href="modifier.php?id=' . $row["id"] . '" class="btn btn-primary">Modifier</a> </td>
                                <td>  <a href="supprimer.php?id=' . $row["id"] . '" class="btn btn-danger">Supprimer</a> </td>
                                <td>  <a href="actif.php?id=' . $row["id"] . '" class="btn ' . ($row["actif"] == 0 ? 'btn-warning' : 'btn-info') . '">' .
                                            ($row["actif"] == 0 ? 'Inactif' : 'Actif') . '</a> </td>
                                </tr> ';
                                    }
                                }
                                $conn->close();

                                ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    <?php } else {
        header('Location: ' . '../connexion.php');
        die();
    } ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>