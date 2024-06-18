<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
    <script defer src="https://kit.fontawesome.com/d8438e7f2f.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php
    session_start();
    include('./header.php');
    include('./engine.php');

    $sql = 'SELECT * FROM `hiking`';
    $read = $pdo->prepare($sql);

    $read->execute();
    $results = $read->fetchAll(PDO::FETCH_ASSOC);

    


    ?>
    <h1>Liste des randonnées</h1>
  <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Difficulté</th>
            <th>Distance (m)</th>
            <th>Durée (heure)</th>
            <th>Dénivelé (m)</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($results as $value) {
          $duration = $value['duration'];
          list($hour, $minute, $second) = explode(':', $duration);
          $formatted_duration = "$hour:$minute";
          
          ?>
        <tr>
            <td><?=$value['id']?></td>
            <td><?=$value['name']?></td>
            <td><?=$value['difficulty']?></td>
            <td><?=$value['distance']?></td>
            <td><?=$formatted_duration?></td>
            <td><?=$value['height_difference']?></td>
            <td>
              <form action="./update.php" method="post">
                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                <input type="hidden" name="name" value="<?= $value['name'] ?>">
                <input type="hidden" name="difficulty" value="<?= $value['difficulty'] ?>">
                <input type="hidden" name="distance" value="<?= $value['distance'] ?>">
                <input type="hidden" name="duration" value="<?= $formatted_duration ?>">
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
  </body>
</html>
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
    </style>