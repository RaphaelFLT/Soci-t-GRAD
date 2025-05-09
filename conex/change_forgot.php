<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fapplication-blondel.com%2Fimages%2Ficon-512x512.png" type="image/x-icon">
</head>

<body>
    <div class="header">
        <div style="padding: 25px;"><a href="./" style="color: black;"><i class="fa fa-home" aria-hidden="true">&nbsp&nbsp Accueil</i></a></div>
        <h1>Mot de passe oublié</h1>
        <div></div>
    </div>
    <hr>
    <form action="" method="post" class="cf">
        <div class="mb-3">
        <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control" name="new_pass" placeholder="Entrez votre nouveau mot de passe" required>
        </div>
        <div class="mb-3">
        <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control" name="cnew_pass" placeholder="Confirmez votre nouveau mot de passe" required>
        </div>
        <div class="mb-3">
        <input type="submit" class="btn btn-primary cf_btn" value="Changer le mot de passe" name="change_forgot">
        </div>
    </form>
</body>
</html>

<?php
$url = $_SERVER['REQUEST_URI'];
$pos = strrpos($url, '/');
$id = $pos === false ? $url : substr($url, $pos + 19);
$token = $id;
$server = 'localhost';
$user = 'root';
$password = '';
$bdd = 'covoiturage';
$conn = new mysqli($server, $user, $password, $bdd);
if (!$conn) {
    echo "<script>alert('Une erreur a eu lieu');</script>";
}

if (isset($_POST['new_pass'])) {
    $new_pass = md5(sha1(md5($_POST['new_pass'])));
}
else {
    $new_pass = "";
}
if (isset($_POST['cnew_pass'])) {
    $cnew_pass = md5(sha1(md5($_POST['cnew_pass'])));
}
else {
    $cnew_pass = "";
}

if (isset($_POST['change_forgot'])) {
    if (htmlentities(trim($new_pass)) == "") {
        echo "<script>alert('Veuillez indiquer votre mot de passe')</script>";
    }
    else if ($new_pass != $cnew_pass) {
        echo "<script>alert('Les mots de passe ne correspondent pas')</script>";
    }
    else {
        $req = $conn->query("UPDATE `utilisateurs` SET `mot_de_passe` = '$new_pass' WHERE `identifiant` = '$token'");
        echo "<script>alert('Votre mot de passe a bien été changé');window.location.href = './';</script>";
    }
}

?>