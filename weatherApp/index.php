<?php
include('../header.php');

try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=db;dbname=weatherapp;charset=utf8', 'myuser', 'mypassword');

    // Définir le mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Lecture des données
    $query = "SELECT * FROM Météo";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Ajout d'un ville
    if (isset($_POST['addCity'])) {
        $city = htmlentities($_POST['city']);
        $up = htmlentities($_POST['up']);
        $down = htmlentities($_POST['down']);
        $alert = '';

        $query = "INSERT INTO Météo (ville, haut, bas) VALUES (:ville, :haut, :bas)";
        $insert = $bdd->prepare($query);
        $insert->bindValue(':ville', $city);
        $insert->bindValue(':haut', $up);
        $insert->bindValue(':bas', $down);

        if ($insert->execute()) {
            $alert = "Nouvelle ville ajoutée avec succès.";
            if ($alert !== '') {
                $_SESSION['alert'] = $alert;
                header('LOCATION: http://localhost:5001/weatherApp/');
            }
        } else {
            $alert = "Erreur lors de l'ajout de la ville.";
            if ($alert !== '') {
                $_SESSION['alert'] = $alert;
                header('LOCATION: http://localhost:5001/weatherApp/');
            }
        }
    }

    //Supression des datas
    if (isset($_POST['delete'])) {
        $city = htmlentities($_POST['city']);
        $alert = '';

        $query = "DELETE FROM Météo WHERE ville=:ville";
        $delete = $bdd->prepare($query);
        $delete->bindValue(':ville', $city);


        if ($delete->execute()) {
            $alert = "Ville supprimée avec succès.";
            if ($alert !== '') {
                $_SESSION['alert'] = $alert;
                header('LOCATION: http://localhost:5001/weatherApp/');
            }
        } else {
            $alert = "Erreur lors de la suppréssion de la ville.";
            if ($alert !== '') {
                $_SESSION['alert'] = $alert;
                header('LOCATION: http://localhost:5001/weatherApp/');
            }
        }
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
?>
<?php
if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
}
?>
<table class="temperature-table">
    <thead>
        <tr>
            <th>Ville</th>
            <th>Température maximale (°C)</th>
            <th>Température minimale (°C)</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $value): ?>
            <tr>
                <td><?= htmlentities($value['ville']) ?></td>
                <td><?= htmlentities($value['haut']) ?></td>
                <td><?= htmlentities($value['bas']) ?></td>
                <td class="control">
                    <form action="" method="post">
                        <input type="hidden" name="city" value="<?= htmlentities($value['ville']) ?>">
                        <button type="submit" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette ville ?');">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <form class="add-city-form" action="" method="post">
                <td>
                    <label for="ville">Ville :</label>
                    <input type="text" id="ville" name="city" required>
                </td>
                <td>
                    <label for="haut">Température maximale (°C) :</label>
                    <input type="number" id="haut" name="up" required>
                </td>
                <td>
                    <label for="bas">Température minimale (°C) :</label>
                    <input type="number" id="bas" name="down" required>
                </td>
                <td>
                    <button name="addCity"><i class="fas fa-plus" style="color: #3aee7f;"></i></button>
                </td>
            </form>
        </tr>
    </tbody>
</table>




<?= include('../footer.php'); ?>
<style>
    .temperature-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .temperature-table th,
    .temperature-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    .temperature-table th {
        background-color: #f2f2f2;
    }



    button {
        border: none;
        background: none;
    }

    i {
        cursor: pointer;
    }

    .fa-edit {
        color: #45a049;
    }

    .fa-edit:hover {
        color: green;
    }

    .fa-trash-alt {
        color: tomato;
        scale: 1.1;
    }

    .fa-trash-alt:hover {
        color: red;
        scale: 1.1;
    }

    .add-city-form {
        width: 300px;
        margin-bottom: 20px;
    }

    .add-city-form label {
        display: block;
        margin-bottom: 8px;
    }

    .add-city-form input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .add-city-form input[type="number"] {
        width: 20%;
        padding: 8px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .add-city-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .add-city-form input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>