<?php
session_start();
// Inclusion du fichier pour la connexion à la base de données
include('engine.php');

if (isset($_POST['button'])) {
    // Récupération des données du formulaire
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    // Mettre la première lettre du nom d'utilisateur en majuscule
    $username = ucfirst($username);

    // Requête SQL pour récupérer les informations de l'utilisateur
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    // Vérification si l'utilisateur existe
    if ($stmt->rowCount() > 0) {
        // Récupération des données de l'utilisateur
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if (password_verify($password, $user['password'])) {
            echo "Connexion réussie !";
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname']
            ];
            header('location: /exos/php-challenge-auth/login.php');
            // Ici, vous pouvez démarrer une session, rediriger l'utilisateur, etc.
        } else {
            echo "Mot de passe incorrect.";
            header('location:  /exos/php-challenge-auth/login.php');
        }
    } else {
        echo "Nom d'utilisateur incorrect.";
        header('location: /exos/php-challenge-auth/login.php');
    }
}
?>






