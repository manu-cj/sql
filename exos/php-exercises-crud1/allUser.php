<?php

include('./header.php');
include('./engine.php');

$sql = 'SELECT * FROM `clients`';
$select = $pdo->prepare($sql);

$select->execute();

$results = $select->fetchAll(PDO::FETCH_ASSOC);



?>
 <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Lastname</th>
            <th>firstName</th>
            <th>Birth date</th>
            <th>Card</th>
            <th>Card Number</th>
            <th class="action">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($results as $value) {
            $card = '';
            $numberCard = '';
            if ($value['card'] === 1) {
                $card = 'yes';
                $numberCard = $value['cardNumber'];
            }else {
                $card = 'no';
                $numberCard = '/';
            }
          
          ?>
        <tr>
            <td><?=$value['id']?></td>
            <td><?=$value['lastName']?></td>
            <td><?=$value['firstName']?></td>
            <td><?=$value['birthDate']?></td>
            <td><?=$card?></td>
            <td><?=$numberCard?></td>
            <td class="action">
              <form action="./controlClient.php" method="post">
                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                <input type="hidden" name="lastname" value="<?= $value['lastName'] ?>">
                <input type="hidden" name="firstname" value="<?= $value['firstName'] ?>">
                <input type="hidden" name="birthDate" value="<?= $value['birthDate'] ?>">
                <input type="hidden" name="card" value="<?= $card ?>">
                <input type="hidden" name="numberCard" value="<?= $numberCard ?>">
                <button name="update"><i class="fas fa-pen-square" style="color: #39F9AF;"></i></button>
              </form>
        
              <form action="./controlClient.php" method="post">
                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                <button name="delete"><i class="fas fa-trash-alt" style="color: #f56e00;"></i></button>
              </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table> 

<?php
include('./footer.php');
?>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        .action {
          width: 50px;
        }
    </style>