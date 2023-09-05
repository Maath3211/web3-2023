<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Ajout Formule 1</title>
</head>

<body>
    <?php
    $id = $_GET['id'];

    $servername    =    "localhost";
    $username    =    "root";
    $password    =    "root";
    $dbname    =    "f1";
    //    Create    connection
    $conn    =    mysqli_connect($servername,    $username,    $password,    $dbname);
    //    Check    connection
    if (!$conn) {
        die("Connection    failed:    "    .    mysqli_connect_error());
    }
    $conn->query('SET NAMES utf8');
    $sql   =   "SELECT   id,   nom, nationalite, equipe, img, numero   FROM   pilote WHERE id = $id";
    $result   =   $conn->query($sql);
    if ($result->num_rows   >   0) {
        $row   =   $result->fetch_assoc();
        $id = $row['id'];
        $nom = $row["nom"];
        $natio = $row["nationalite"];
        $equipe = $row["equipe"];
        $num = $row["numero"];
        $img = $row["img"];
    }

    mysqli_close($conn);
    ?>

    <div id="container" class="container-fluid">
        <div class="row text-center py-5">
            <div class="col-6 offset-3">


                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                    <div class="form-group">
                        <label for="nom">ID</label>
                        <input type="text" readonly class="form-control" name="id" value="<?php echo $id ?>">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom du pilote</label>
                        <input type="text" class="form-control" name="nom" value="<?php echo $nom ?>" placeholder="Entrez le nom">
                    </div>
                    <div class="form-group">
                        <label for="nationalite">Nationalité du pilote</label>
                        <input type="text" class="form-control" name="nationalite" value="<?php echo $natio ?>" placeholder="Entrez la nationalité">
                    </div>
                    <div class="form-group">
                        <label for="equipe">Nom de l'équipe</label>
                        <input type="text" class="form-control" name="equipe" value="<?php echo $equipe ?>" placeholder="Entrez le nom">
                    </div>
                    <div class="form-group">
                        <label for="numero">Numéro du pilote</label>
                        <input type="text" class="form-control" name="numero" value="<?php echo $num ?>" placeholder="Entrez le numéro du pilote">
                    </div>
                    <div class="form-group">
                        <label for="img">Lien de l'image</label>
                        <input type="text" class="form-control" name="img" value="<?php echo $img ?>" placeholder="Entrez le lien de l'image">
                    </div>

                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <a class='btn btn-primary' href='index.php' role='button'>Retour</a>
                </form>
            </div>
        </div>
    </div>



    <?php
    $erreur = false;
    if (empty($_GET['nom'])) {
        $erreur = true;
        echo "Le nom est requis <br>";
    }
    if (empty($_GET['nationalite'])) {
        $erreur = true;
        echo "La nationalité est requise <br>";
    }
    if (empty($_GET['equipe'])) {
        $erreur = true;
        echo "L'équipe est requise <br>";
    }
    if (empty($_GET['numero'])) {
        $erreur = true;
        echo "Le numéro est requis <br>";
    }
    if (empty($_GET['img'])) {
        $erreur = true;
        echo "L'image est requise <br>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && $erreur == false) {
        $servername    =    "localhost";
        $username    =    "root";
        $password    =    "root";
        $dbname    =    "f1";
        //    Create    connection
        $conn    =    mysqli_connect($servername,    $username,    $password,    $dbname);
        //    Check    connection
        if (!$conn) {
            die("Connection    failed:    "    .    mysqli_connect_error());
        }


        $nom = '"' . $_GET['nom'] . '"';
        $natio = '"' . $_GET['nationalite'] . '"';
        $equipe = '"' . $_GET['equipe'] . '"';
        $num = '"' . $_GET['numero'] . '"';
        $img = '"' . $_GET['img'] . '"';


        $sql    =    "UPDATE `pilote` SET `Nom` = $nom , `Nationalite` = $natio, `Equipe` = $equipe,
         `Img` = $img, `Numero` = $num WHERE `pilote`.`id` = $id;";
        if (mysqli_query($conn,    $sql)) {
            header("Location: index.php");
            exit();
        } else {
            echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>