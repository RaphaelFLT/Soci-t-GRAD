<?php 
session_start();
$server = '127.0.0.1';
$user = 'mysql';
$password = 'mysql';
$bdd = 'gradu';
$le = $_SESSION['user'];
$connection = new mysqli($server, $user, $password, $bdd);
if (!$connection) {
    echo "<script>alert('Une erreur a eu lieu');</script>";
}
$query = mysqli_query($connection, "SELECT * FROM `utilisateurs` WHERE `email`='$le'");
$num_row = mysqli_num_rows($query);
if ($num_row == 0) {
    header('Location: ./');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fapplication-blondel.com%2Fimages%2Ficon-512x512.png" type="image/x-icon">
</head>

<body>
    <div class="header">
        <div style="padding: 25px;"><a href="../"><i class="fa fa-home" style="color: black;" aria-hidden="true">&nbsp&nbsp&nbspAccueil</i></a></div>
        <h1>Espace utilisateur</h1>
        <div class="right" style="padding-right: 25px;">
            <form action="" method="post">
                <button type="submit" name="logout" style="border: none; background-color: transparent; margin-left: -5px"><i class="fa fa-sign-out" aria-hidden="true">&nbsp&nbspDéconnexion</i></button><br>
            </form>
        </div>
    </div>
    <?php
        if (isset($_POST['logout'])) {
            session_start();
            session_unset();
            session_destroy();
            unset($_SESSION["id"]);
            unset($_SESSION["name"]);
            unset($_SESSION['user']);
            $_SESSION['user'] = "not_username";
            header('location: index.php');
            echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
        }
    ?>

</body>

</html>