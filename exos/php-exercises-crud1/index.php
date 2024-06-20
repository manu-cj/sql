<?php

include('./header.php');
include('./engine.php');

$sql = 'SELECT * FROM `clients`';
$select = $pdo->prepare($sql);

$select->execute();

$allDataClients = $select->fetchAll(PDO::FETCH_ASSOC);

?>


<?php
include('./footer.php');
?>
