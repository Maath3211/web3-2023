<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Création usager</title>
</head>

<body>
    <?php
    $nom = "";
    $mdp = "";
    $courriel = "";
    $avatar = "";

    $nomErreur = "";

    $erreur = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST";

        if (empty($_POST['nom'])) {
            $nomErreur = "Le nom est requis ";
            $erreur = true;
            echo $nomErreur;
        } else {
            if ($_POST['nom'] != 'SLAY') $nom = test_input($_POST["nom"]);
            else {
                $nomErreur = "Le nom est déja utilisé ";
                $erreur = true;
                echo $nomErreur;
            }
        }

        if (empty($_POST['mdp'])) {
            $nomErreur = "Le mot de passe est requis ";
            $erreur = true;
            echo $nomErreur;
        } else {
            if ($_POST['mdp2'] != $_POST['mdp']) echo "Les mots de passes ne correspondent pas";
            else $nom = test_input($_POST["mdp"]);
        }

        if (empty($_POST['mdp2'])) {
            $nomErreur = "La confirmation de mot de passe est requis ";
            $erreur = true;
            echo $nomErreur;
        } else {
            $nom = test_input($_POST["mdp2"]);
        }

        if (empty($_POST['courriel'])) {
            $nomErreur = "Le courriel est requis ";
            $erreur = true;
            echo $nomErreur;
        } else {
            $nom = test_input($_POST["courriel"]);
        }

        if (empty($_POST['avatar'])) {
            $nomErreur = "L'avatar' est requis ";
            $erreur = true;
            echo $nomErreur;
        } else {
            $nom = test_input($_POST["avatar"]);
        }

        if (empty($_POST['date'])) {
            $nomErreur = "La date est requis ";
            $erreur = true;
            echo $nomErreur;
        } else {
            $nom = test_input($_POST["date"]);
        }
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur présente";
    } 
    else { ?>
        <div class="card" style="width: 18rem;" id="div2">
        <img class="card-img-top" src="<?php echo $avatar; ?>" alt="Card image cap">

        <div class="card-body">
            <h5 class="card-title"><?php echo $nom; ?></h5>
            <p class="card-text"> Votre courriel: <?php echo $courriel; ?><br>
                La date de naissance: <?php echo $date; ?><br>
                Votre moyen de transport: <?php echo $transport; ?><br>
            </p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="submit" value="Créer un autre utilisateur">
            </form>
        </div>
    </div>
   <?php } ?>
    


    <div id="container" class="container-fluid">
        <div class="row text-center py-5">
            <div class="col-12">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    Nom : <input type="text" name="nom"><br>
                    Mot de passe : <input type="password" name="mdp"><br>
                    Confirmation Mot de passe : <input type="password" name="mdp2"><br>
                    Courriel : <input type="email" name="courriel"><br>
                    Avatar : <input type="text" name="avatar"><br>
                    Sexe : Homme<input type="radio" name="sexe" value="homme" checked> Femme<input type="radio" name="sexe" value="femme"> Non genré<input type="radio" name="sexe" value="nongenre"><br>
                    Date de naissance : <input type="date" name="date"><br>
                    Moyen de transport :<select name="transport">
                        <option value="auto">Auto</option>
                        <option value="autobus">Autobus</option>
                        <option value="marche">Marche</option>
                        <option value="velo">Vélo</option>
                    </select><br>

                    <input type="submit" value="Créer l'utilisateur" id="create">
                </form>

            </div>
        </div>
    </div>

    <?php
    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];
    $courriel = $_POST['courriel'];
    $avatar = $_POST['avatar'];
    $date = $_POST['date'];
    $transport = $_POST['transport'];
    ?>




    




    <script src="js/java.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>