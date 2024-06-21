<?php

include('./header.php');
include('./engine.php');

$sql = 'SELECT * FROM `showTypes`';
$select = $pdo->prepare($sql);

$select->execute();

$results = $select->fetchAll(PDO::FETCH_ASSOC);

?>
 <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Types</th>
            <th class="action">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($results as $value) {
      
          
          ?>
        <tr>
            <td><?=$value['id']?></td>
            <td><?=$value['type']?></td>
            
            <td class="action">
              <form action="./update.php" method="post">
                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                <input type="hidden" name="height_difference" value="<?= $value['height_difference'] ?>">
                <button name="update"><i class="fas fa-pen-square" style="color: #63E6BE;"></i></button>
              </form>
        
              <form action="./delete.php" method="post">
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
