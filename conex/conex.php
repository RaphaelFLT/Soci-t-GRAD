<?php
// Informations de connexion à la base de données
    $dsn = "mysql:lo;dbname=gradu";
    $username = "mysql";
    $password = "mysql";

    try {
        // Tente d'établir une connexion à la base de données
        $connection = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
?>