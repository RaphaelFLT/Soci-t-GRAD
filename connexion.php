<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dsn = 'mysql:host=localhost:8889;dbname=gradu';
        $user = 'root'; // Utilisateur par défaut de PHPMyAdmin
        $pass = 'root'; // Pas de mot de passe par défaut
        
        try {
            $pdo = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
?>