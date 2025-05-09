<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifie si le formulaire d'inscription a été soumis
if (isset($_POST['register'])) {
    $showAlert = false;
    $showError = false;
    $exists = false;

    // Vérifie que la requête est de type POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Informations de connexion à la base de données
        $dsn = "mysql:host=localhost:8889;dbname=gradu";
        $username = "root";
        $password = "root";

        try {
            // Tente d'établir une connexion à la base de données
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        // Récupération des données du formulaire
        $age = isset($_POST["age"]) ? $_POST["age"] : "";
        $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
        $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
        $email = isset($_POST["mail"]) ? filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL) : "";
        $telephone = isset($_POST["tel"]) ? $_POST["tel"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $cpassword = isset($_POST["cpassword"]) ? $_POST["cpassword"] : "";

        // Génération d'un token unique basé sur l'email et le nom
        $token = md5(crypt($email, $nom));
        $token = substr($token, 0, 6);

        // Requête SQL pour vérifier l'existence de l'email dans la base de données
        $sql = "SELECT * FROM `utilisateurs` WHERE `identifiant`=:token";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $num = $stmt->rowCount();

        // Vérifie si l'email n'existe pas et tous les champs sont remplis
        if ($num == 0) {
            if (empty($age) || empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($password)) {
                echo "<script>alert('Veuillez remplir tous les champs du formulaire')</script>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Veuillez indiquer une adresse e-mail valide')</script>";
            } elseif ($password != $cpassword) {
                echo "<script>alert('Les mots de passe ne correspondent pas')</script>";
            } else {
                try {
                    // Hashage du mot de passe et insertion des données dans la base de données
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `utilisateurs`(`identifiant`, `prenom`, `nom`, `email`, `mot_de_passe`, `age`, `telephone`, `grade`) VALUES (:token, :prenom, :nom, :email, :hash, :age, :telephone, '1')";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':token', $token);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':hash', $hash);
                    $stmt->bindParam(':age', $age);
                    $stmt->bindParam(':telephone', $telephone);
                    $stmt->execute();

                    // Vérifie si l'insertion a réussi
                    if ($stmt->rowCount() > 0) {
                        $showAlert = true;
                    }
                } catch (Exception $e) {
                    echo 'Exception reçue : ', $e->getMessage(), "\n";
                }
            }
        } else {
            $exists = "Cet email est déjà utilisé";
        }
        
        // Empêche la soumission multiple du formulaire en actualisant la page
        echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
    }
}

// Traitement de la connexion
if (isset($_POST['login'])) {
    // Informations de connexion à la base de données
    $dsn = "mysql:host=localhost:8889;dbname=gradu";
    $username = "root";
    $password = "root";

    try {
        // Tente d'établir une connexion à la base de données
        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    // Récupération des données du formulaire de connexion
    $le = isset($_POST["login_email"]) ? $_POST["login_email"] : "";
    $lp = isset($_POST["login_password"]) ? md5(sha1(md5($_POST["login_password"]))) : "";

    // Vérification des champs du formulaire de connexion
    if (htmlentities(trim($le)) == "") {
        echo "<script>alert('Veuillez indiquer votre adresse e-mail')</script>";
    } else if (htmlentities(trim($lp)) == "") {
        echo "<script>alert('Veuillez indiquer votre mot de passe')</script>";
    } else {
        $_SESSION['email'] = $le;
        // Requête SQL pour vérifier l'existence de l'utilisateur dans la base de données
        $stmt = $connection->prepare("SELECT * FROM `utilisateurs` WHERE `mot_de_passe`=:lp AND `email`=:le");
        $stmt->bindParam(':lp', $lp);
        $stmt->bindParam(':le', $le);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $num_row = $stmt->rowCount();

        // Vérifie si l'utilisateur existe et redirige vers l'espace utilisateur
        if ($num_row > 0) {
            $_SESSION['user'] = $le;
            header('location: ../index.php');
        } else {
            echo "<script>alert('Identifiants invalides')</script>";
            echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
        }
    }
    // Empêche la soumission multiple du formulaire en actualisant la page
    echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Métadonnées du document -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <!-- Liens vers les feuilles de style et scripts externes -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon"
        href="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fapplication-blondel.com%2Fimages%2Ficon-512x512.png"
        type="image/x-icon">
</head>

<body>
    <!-- Barre de navigation Bootstrap -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./ressources/logo.jpg" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
                <!-- Liens de navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" href="../index.php">Accueil<span
                                class="sr-only">*</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../conex/index.php">Connexion<span
                                class="sr-only">*</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../prestation.php">Nos prestations<span
                                class="sr-only"></span></a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../produit.php">Nos produits<span
                                class="sr-only"></span></a> </li>
                    <li class="nav-item"> <a class="nav-link" href="../realisation.php">Nos réalisations<span
                                class="sr-only"></span></a> </li>
                    <li class="nav-item"> <a class="nav-link" href="./contact.php">Contact<span
                                class="sr-only"></span></a> </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>joyeux NOEL  ☃ 
    </h1>
    <h1></h1>
    <hr>
    <div class="container">
        <!-- Formulaire de Connexion -->
        <div class="login">
            <h2>Connexion</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <input type="email" class="form-control" id="login_email" name="login_email"
                        placeholder="EMail" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="login_password"
                        name="login_password" placeholder="Mot de passe" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Connexion</button>
            </form>
            <a href="forgot.php">Mot de passe oublié</a>
        </div>
        <div class="trait"></div>
        <!-- Formulaire d'Inscription -->
        <div class="signin">
            <h2>Inscription</h2>
            <?php
            // Affichage des alertes JavaScript après l'inscription
            if (isset($_POST['register'])) {
                if ($showAlert) {
                    echo "<script>alert('Merci de vous connecter')</script>";
                }
                if ($showError) {
                    echo "<script>alert('" . $showError . "')</script>";
                }
                if ($exists) {
                    echo "<script>alert('" . $exists . "')</script>";
                }
            }
            ?>
            <div>
                <form action="" method="post">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" class="form-control" id="age" name="age" placeholder="Âge" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="tel" class="form-control" id="tel" name="tel" placeholder="Téléphone" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" id="cpassword" name="cpassword"
                            placeholder="Confirmer le mot de passe" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary">
                        S'enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
