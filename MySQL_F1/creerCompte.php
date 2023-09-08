<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Créer un compte</title>
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
                    <div class="form-group">
                        <label for="passwordConf">Confirmation de mot de passe</label>
                        <input type="password" class="form-control" name="passwordConf" placeholder="Entrez le mot de passe">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Entrez l'email">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info">Créer un compte</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $erreur = false;
                    if (empty($_POST['nom'])) {
                        $erreur = true;
                        echo "Le nom est requis <br>";
                    }
                    if (empty($_POST['password'])) {
                        $erreur = true;
                        echo "Le mot de passe est requis <br>";
                    }
                    if (empty($_POST['passwordConf'])) {
                        $erreur = true;
                        echo "La confirmation de mot de passe est requise <br>";
                    }
                    if (empty($_POST['email'])) {
                        $erreur = true;
                        echo "L'email est requis <br>";
                    }
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
                        $email = $_POST['email'];


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
                        $sql   =   "INSERT INTO `usagers` (`id`, `username`, `email`, `password`, `ip`, `machine`) 
                    VALUES (NULL, '$nom', '$email', $pass, '', '');";

                        if (mysqli_query($conn,    $sql)) {
                            $_SESSION['connexion'] = true;
                            header("Location: index.php");
                            exit();
                        }else {
                            echo    "Error:    "    .    $sql    .    "<br>"    .    mysqli_error($conn);
                        }
                        $conn->close();
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>