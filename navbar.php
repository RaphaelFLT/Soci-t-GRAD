<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier si le bouton de déconnexion a été soumis
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    $_SESSION['user'] = "not_username";
    header('location: index.php');
    echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
    exit; // Assurez-vous d'arrêter l'exécution du script après la redirection
}

?>
    <!-- Barre de navigation Bootstrap -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./ressources/logo.jpg" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="./index.php">Accueil<span class="sr-only"></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./prestation.php">Nos prestations<span class="sr-only"></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./produit.php">Nos produits<span class="sr-only"></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./realisation.php">Nos réalisations<span class="sr-only"></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./contact.php">Contact<span class="sr-only"></span></a></li>

                    <?php
                    // Vérifier si l'utilisateur est connecté
                    if (isset($_SESSION['user'])) {
                        // Utilisateur connecté, afficher les options du compte
                        echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Votre Compte</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form method="post" action="">
                                            <button type="submit" name="logout" class="dropdown-item">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i> Déconnecter
                                            </button>
                                        </form>
                                    </li>
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                                </ul>
                              </li>';
                    } else {
                        // Utilisateur non connecté, afficher l'option de connexion
                        echo '<li class="nav-item"><a class="nav-link" href="./conex/index.php">Se Connecter<span class="sr-only"></span></a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
