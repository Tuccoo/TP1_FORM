<?php
define("DB_HOST", "localhost");
define("DB_PORT", "3306");
define("DB_DATABASE", "hospitale2n"); // CHANGER LE NOM POUR CHAQUE EXO
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

try {
    $database = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $database->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    echo "Connexion error : " . $e->getMessage() . "<br />";
    echo "Number : " . $e->getCode();
    exit();
}