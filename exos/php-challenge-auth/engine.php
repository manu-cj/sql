<?php
//Check if credentials are valid

// Paramètres de connexion à la base de données
$host = 'db'; // ou votre hôte MAMP
$dbname = 'reunion_island';
$username = 'myuser';
$password = 'mypassword'; // ou votre mot de passe MySQL

try {
    // Connexion à la base de données MySQL avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Pour afficher les erreurs de PDO en cas de problème
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>