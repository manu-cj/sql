<?php
// Inclusion du fichier engine.php
include('./engine.php');

if (isset($_POST['delete'])) {

    $sql = 'DELETE FROM `hiking` WHERE id=?';
    $delete = $pdo->prepare($sql);
    $delete->execute([$_POST['id']]);

    header('Location: ./read.php');
    exit;
}
?>
