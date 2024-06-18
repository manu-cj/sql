<?php
include('engine.php');

$user = array('Cortex', 'cortex@email.com', 'cortex', 'la street', 'motdepasse');
$sql = "INSERT INTO user (username, email, firstname, lastname, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

$hashed_password = password_hash($user[4], PASSWORD_DEFAULT);

$user[4] = $hashed_password;

$stmt->execute($user);
echo "Utilisateur ajouté avec succès.";