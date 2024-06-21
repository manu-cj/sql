<?php

include('./header.php');
include('./engine.php');

$sql = 'SELECT * FROM `shows` ORDER BY title ASC';
$select = $pdo->prepare($sql);

$select->execute();

$results = $select->fetchAll(PDO::FETCH_ASSOC);
?>
 <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Performer</th>
            <th>Date</th>
            <th>Start Time</th>
            <th class="action">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($results as $value) {
      
          
          ?>
        <tr>
            <td><?=$value['id']?></td>
            <td><?=$value['title']?></td>
            <td><?=$value['performer']?></td>
            <td><?=$value['date']?></td>
            <td><?=$value['startTime']?></td>
            <td class="action">
              <form action="./updateShow.php" method="post">
                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                <input type="hidden" name="title" value="<?= $value['title'] ?>">
                <input type="hidden" name="performer" value="<?= $value['performer'] ?>">
                <input type="hidden" name="date" value="<?= $value['date'] ?>">
                <input type="hidden" name="showTypesId" value="<?= $value['showTypesId'] ?>">
                <input type="hidden" name="firstGenresId" value="<?= $value['firstGenresId'] ?>">
                <input type="hidden" name="secondGenreId" value="<?= $value['secondGenreId'] ?>">
                <input type="hidden" name="duration" value="<?= $value['duration'] ?>">
                <input type="hidden" name="startTime" value="<?= $value['startTime'] ?>">
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