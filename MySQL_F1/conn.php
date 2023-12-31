<?php session_start()?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Connexion</title>
</head>

<body>

    <div id="container" class="container-fluid">
        <div class="row text-center py-5">
            <div class="col-4 offset-4">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="nom" placeholder="Entrez le nom d'utilisateur">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" placeholder="Entrez le mot de passe">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info">Connexion</button>
                    <a href="creerCompte.php"><button type="button" class="btn btn-success">Créer un compte</button></a>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nom = $_POST['nom'];
                    $pass = $_POST['password'];
                    $pass = sha1($pass, false);

                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $db = "f1";
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $db);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $conn->query('SET NAMES utf8');
                    $sql   =   "SELECT * FROM   usagers WHERE username = '$nom' AND password='$pass'";

                    $result   =   $conn->query($sql);
                    if ($result->num_rows   >   0) {
                        $row   =   $result->fetch_assoc();
                        if ($nom == $row["username"] && $pass == $row["password"])
                            echo '<h1>Connexion reussi</h1>';
                        $_SESSION['connexion'] = true;
                        header('Location: ' . 'index.php');
                        die();
                    } else echo '<br><br><h2>nope</h2>';


                    $conn->close();
                }
                ?>



            </div>
        </div>
    </div>



















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>