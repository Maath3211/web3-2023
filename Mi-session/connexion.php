<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <title>Connexion</title>
</head>

<body class="bodyCegep">

    
    <div id="container" class="container-fluid">
    <div class="row text-center">
    <div class="col-6 offset-3">
    <img src="img/CTR_Logo_BLANC.png" class="logoCegepCon">
    <?php
    if (!empty($_GET)) {
        $action = $_GET['action'];
        switch ($action) {
            case 1:
                echo '<br><div class="alert alert-success" role="alert">
                        <h4>Déconnexion réussi</h4>
                      </div>';
                break;
        }
    }

                $_SESSION['connexion'] = false;
                if (!empty($_POST["nom"])) $nom = test_input($_POST["nom"]);
                if (!empty($_POST["password"])) $pass = test_input($_POST["password"]);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nom = $_POST['nom'];
                    $pass = $_POST['password'];
                    $pass = sha1($pass, false);

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
                    $sql   =   "SELECT * FROM   usagers WHERE username = '$nom' AND password='$pass' AND enabled='1'";

                    $result   =   $conn->query($sql);
                    if ($result->num_rows   >   0) {
                        $row   =   $result->fetch_assoc();
                        if ($nom == $row["username"] && $pass == $row["password"] && $row["enabled"] == 1)
                            echo '<h1>Connexion reussi</h1>';
                        $_SESSION['connexion'] = true;
                        header('Location: ' . 'evenement/afficher.php');
                        die();
                    } else echo '<br><div class="alert alert-danger" role="alert">
                    <h4>Nom d\'utilisateur ou mot de passe erroné</h4>
                  </div>';


                    $conn->close();
                }
    ?>
    </div>
    </div>
        <div class="row text-center">
            <div class="col-6 offset-3">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label for="nom" class="text-white">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="nom" placeholder="Entrez le nom d'utilisateur">
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-white">Mot de passe</label>
                        <input type="password" class="form-control" name="password" placeholder="Entrez le mot de passe">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info">Connexion</button>
                    <a href="index.php"><button type="button" class="btn btn-success">Retour</button></a>
                </form>

                <?php
                function test_input($data)
                {
                    $data = trim($data);
                    $data = addslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                ?>



            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>