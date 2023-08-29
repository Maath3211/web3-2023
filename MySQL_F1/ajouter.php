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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nom = "";
        $natio = "";
        $equipe = "";
        $num = "";
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
    ?>

        <div id="container" class="container-fluid">
            <div class="row text-center py-5">
                <div class="col-6 offset-3">

                    
                    <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?> "method="post">
                        <div class="form-group">
                            <label for="nom">Nom du pilote</label>
                            <input type="text" class="form-control" name="nom" placeholder="Entrez le nom">
                        </div>
                        <div class="form-group">
                            <label for="nationalite">Nationalité du pilote</label>
                            <input type="text" class="form-control" name="nationalite" placeholder="Entrez la nationalité">
                        </div>
                        <div class="form-group">
                            <label for="equipe">Nom de l'équipe</label>
                            <input type="text" class="form-control" name="equipe" placeholder="Entrez le nom">
                        </div>
                        <div class="form-group">
                            <label for="numero">Numéro du pilote</label>
                            <input type="text" class="form-control" name="numero" placeholder="Entrez le numéro du pilote">
                        </div>
                        <div class="form-group">
                            <label for="img">Lien de l'image</label>
                            <input type="text" class="form-control" name="img" placeholder="Entrez le lien de l'image">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>


        
    <?php
        $nom = '"' . $_POST['nom'] . '"';
        $natio = '"' . $_POST['nationalite'] . '"';
        $equipe = '"' . $_POST['equipe'] . '"';
        $num = '"' . $_POST['numero'] . '"';
        $img = '"' . $_POST['img'] . '"';


        $sql    =    "INSERT    INTO    pilote    (id, nom, nationalite, equipe, numero, img)
        VALUES    (NULL, $nom, $natio, $equipe, $num, $img)";
        echo $sql;
        /*if (mysqli_query($conn,    $sql)) {
            echo    "Enregistrement    réussi";
        } else {
            echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
        }*/

        mysqli_close($conn);
    } else {
        echo "<h1>Retournez à la page précédente</h1> <a class='btn btn-primary' href='index.php' role='button'>Retour</a>";
    }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>