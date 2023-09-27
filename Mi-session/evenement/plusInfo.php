<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <title>Plus d'information</title>
</head>

<body>
    <?php
    if ($_SESSION['connexion'] == true) {
        if (!empty($_GET["id"])) $id = $_GET['id'];
        
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





                <div class="col-9">
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
                    $sql   =   "SELECT   * FROM   events WHERE `events`.`id` = $id;";
                    $result   =   $conn->query($sql);
                    if ($result->num_rows   >   0) {

                        while ($row   =   $result->fetch_assoc()) {
                            $nom = $row['nom'];
                            $date = $row['date'];
                            $lieu = $row['lieu'];
                            $dep = $row['departement'];
                            $good = $row['good'];
                            $neutral = $row['neutral'];
                            $bad = $row['bad'];
                            $goodEmp = $row['goodEmp'];
                            $neutralEmp = $row['neutralEmp'];
                            $badEmp = $row['badEmp'];
                        }
                    }
                    $conn->close();
                    ?>

                    <table class="table table-borderless text-center" id="tblInfo">
                        <thead>
                            <tr>
                                <th scope="col" class="font-weight-bold">Nom de l'évenement</th>
                                <th>Date de l'évenement</th>
                                <th>Lieu de l'évenement</th>
                                <th>Département</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><?php echo $nom ?></td> 
                            <td><?php echo $date ?></td> 
                            <td><?php echo $lieu ?></td> 
                            <td><?php echo $dep ?></td> 
                            </tr>
                        </tbody>
                    </table>
                
                               

                                <?php
                                   
                                $dataPoints = array(
                                    array("y" => $good, "label" => "Bon"),
                                    array("y" => $neutral, "label" => "Neutre"),
                                    array("y" => $bad, "label" => "Mauvais"),
                                    array("y" => 0, "label" => " "),
                                    array("y" => $goodEmp, "label" => "Bon"),
                                    array("y" => $neutralEmp, "label" => "Neutre"),
                                    array("y" => $badEmp, "label" => "Mauvais")
                                );

                                ?>
                                <script>
                                    window.onload = function() {

                                        var chart = new CanvasJS.Chart("chartContainer", {
                                            animationEnabled: true,
                                            theme: "light2",
                                            title: {
                                                text: "Avis des Participants"
                                            },
                                            axisY: {
                                                title: ""
                                            },
                                            data: [{
                                                type: "column",
                                                yValueFormatString: "#,##0.## vote",
                                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                            }]
                                        });
                                        chart.render();

                                    }
                                </script>
                                <div id="chartContainer"></div>
                                <div class="col-12">
                                    <h3><span class="tab1"></span>Étudiant<span class="tab2"></span>Entreprise</h3>
                                </div>




                </div>
            </div>
        </div>

    <?php } else {
        header('Location: ' . '../connexion.php');
        die();
    } ?>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>