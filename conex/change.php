<?php 
session_start();
$server = 'localhost';
$user = 'root';
$password = '';
$bdd = 'covoiturage';
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
    <title>Changement de mot de passe</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fapplication-blondel.com%2Fimages%2Ficon-512x512.png" type="image/x-icon">
</head>

<body>
    <div class="header">
    <div style="padding: 25px;"><a href="space.php" style="color: black;"><i class="fa fa-backward" aria-hidden="true">&nbsp&nbsp Retour</i></a></div>
    <h1>Changement de mot de passe</h1>
    <div></div>
    </div>
    <hr>
    <div class="change">
        <form action="" method="post">
            <div class="mb-3">
                <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control" id="change_password_old" name="change_password_old"
                    placeholder="Ancien mot de passe" required>
            </div>
            <div class="mb-3">
                <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control" id="change_password" name="change_password"
                    placeholder="Nouveau mot de passe" required>
            </div>
            <div class="mb-3">
                <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control" id="confirm_change_password" name="confirm_change_password"
                    placeholder="Confirmez le nouveau mot de passe" required>
            </div>
            <button type="submit" name="change" class="btn btn-primary">Changer le mot de passe</button>
        </form>
    </div>
</body>

</html>
<?php
if (isset($_POST['change'])) {
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $bdd = 'covoiturage';
    $le = $_SESSION['mail'];
    $conn = new mysqli($server, $user, $password, $bdd);
    if (!$conn) {
        echo "<script>alert('Une erreur a eu lieu');</script>";
    }

    $mail = $le;
    if (isset($_POST['change_password_old'])) {
        $old = md5(sha1(md5($_POST['change_password_old'])));
    }
    else {
        $old = "";
    }
    if (isset($_POST['change_password'])) {
        $new = md5(sha1(md5($_POST['change_password'])));
    }
    else {
        $new = "";
    }
    if (isset($_POST['confirm_change_password'])) {
        $cnew = md5(sha1(md5($_POST['confirm_change_password'])));
    }
    else {
        $cnew = "";
    }
    if (htmlentities(trim($old)) == "") {
        echo "<script>alert('Veuillez indiquer votre ancien mot de passe')</script>";
    }
    else if (htmlentities(trim($new)) == "") {
        echo "<script>alert('Veuillez indiquer votre nouveau mot de passe')</script>";
    }
    else if (htmlentities(trim($cnew)) == "") {
        echo "<script>alert('Veuillez confirmer votre nouveau mot de passe')</script>";
    }
    else {
        $req = $conn->query("SELECT `mot_de_passe` FROM `utilisateurs` WHERE `email` = '$mail'");
        $row = $req->fetch_assoc();

        if ($row['mot_de_passe'] == $new) {
            echo "<script>alert('Vous ne pouvez pas utiliser votre mot de passe actuel comme nouveau mot de passe.')</script>";
        }
        elseif ($new == $cnew && $row['mot_de_passe'] != $new) {
            $upd = $conn->query("UPDATE `utilisateurs` SET `mot_de_passe` = '$new' WHERE `email` = '$mail'");
            echo "<script>alert('Votre mot de passe a bien été mis à jour');window.location.href = 'space.php';</script>";
        }
        else {
            echo "<script>alert('Une erreur a eu lieu.')</script>";
        }
    }
}
?>