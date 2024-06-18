<?php
// Inclusion du fichier engine.php
include('./engine.php');

// Vérification si le formulaire a été soumis
if (isset($_POST['delete'])) {
    // Préparation de la requête SQL pour supprimer une ligne de la table `hiking`
    $sql = 'DELETE FROM `hiking` WHERE id=?';
    $delete = $pdo->prepare($sql);

    // Exécution de la requête en passant l'id à supprimer
    $delete->execute([$_POST['id']]);

    // Redirection vers une autre page après la suppression
    header('Location: ./read.php');
    exit; // Assurez-vous d'arrêter l'exécution du script après la redirection
}
?>
