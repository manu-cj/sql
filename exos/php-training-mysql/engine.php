<?php
//Check if credentials are valid

// Paramètres de connexion à la base de données
$host = 'db';
$dbname = 'reunion_island';
$username = 'myuser';
$password = 'mypassword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>