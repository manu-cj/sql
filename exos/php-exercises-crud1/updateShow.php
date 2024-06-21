<?php

use function PHPSTORM_META\type;

include('./header.php');
include('./engine.php');
if (isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $titre = htmlspecialchars($_POST['title']);
    $artiste = htmlspecialchars($_POST['performer']);
    $date = $_POST['date'];
    $typeSpectacle = htmlspecialchars($_POST['showTypesId']);
    $genre1 = htmlspecialchars($_POST['firstGenresId']);
    $genre2 = htmlspecialchars($_POST['secondGenreId']);
    $duree =  ($_POST['duration']);
    $heureDebut = ($_POST['startTime']);
    
     $temps = explode(':', $duree);
     $heures = $temps[0];
     $minutes = $temps[1];
     $secondes = $temps[2] ?? 0;
    
     $total_minutes = $heures * 60 + $minutes + $secondes / 60;

     echo$typeSpectacle;
}

if (isset($_POST['submit'])) {
    $id = htmlspecialchars($_POST['id']);
    $titre = htmlspecialchars($_POST['titre']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $date = $_POST['date'];
    $typeSpectacle = htmlspecialchars($_POST['typeSpectacle']);
    $genre1 = htmlspecialchars($_POST['genre1']);
    $genre2 = htmlspecialchars($_POST['genre2']);
    $duree =  ($_POST['duree']);
    $heureDebut = ($_POST['heureDebut']);

    function minutesToTime($minutes) {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        return sprintf("%02d:%02d:00", $hours, $remainingMinutes);
    }

    $dureeEnTime = minutesToTime($duree);


     try {
         // Requête SQL pour insérer un nouveau client
         $sql = 'UPDATE  shows 
         SET title=:title, performer=:performer, date=:date, showTypesId=:showTypesId, firstGenresId=:firstGenresId, secondGenreId=:secondGenreId, duration=:duration, startTime=:startTime 
         WHERE id=:id';
        
        $insert = $pdo->prepare($sql);
        
        $insert->execute([
            ':title' => $titre,
            ':performer' => $artiste,
            ':date' => $date,
            ':showTypesId' => $typeSpectacle,
            ':firstGenresId' => $genre1,
            ':secondGenreId' => $genre2,
            ':duration' => $dureeEnTime,
            ':startTime' => $heureDebut,
            ':id' => $id
        ]);
        
         echo "Show mis à jour avec succès.";
     } catch (PDOException $e) {
         echo "Erreur : " . $e->getMessage();
     }
}
?>
<div class="container">
    <h2>Ajouter un Spectacle</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="<?= $titre ?>" required>
        </div>
        <div class="form-group">
            <label for="artiste">Artiste</label>
            <input type="text" id="artiste" name="artiste" value="<?= $artiste ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="<?= $date ?>" required>
        </div>
        <div class="form-group">
            <label for="typeSpectacle">Type de Spectacle</label>
            <select id="typeSpectacle" name="typeSpectacle" required>
            <option value="1" <?php if ($_POST['showTypesId'] === "1") { ?>selected<?php } ?>>Concert</option>
        <option value="2" <?php if ($_POST['showTypesId'] === "2") { ?>selected<?php } ?>>Théâtre</option>
        <option value="3" <?php if ($_POST['showTypesId'] === "3") { ?>selected<?php } ?>>Humour</option>
        <option value="4" <?php if ($_POST['showTypesId'] === "4") { ?>selected<?php } ?>>Danse</option>
                
            </select>
        </div>
        <div class="form-group">
            <label for="genre1">Genre du spectacle :</label>
            <select class="my-2 form-select w-50" name="genre1" id="genre1">
            <option value="1" <?php if ($genre1 === "1") { ?>selected<?php } ?>>Variété Française</option>
            <option value="2" <?php if ($genre1 === "2") { ?>selected<?php } ?>>Variété Internationale</option>
            <option value="3" <?php if ($genre1 === "3") { ?>selected<?php } ?>>Pop/Rock</option>
            <option value="4" <?php if ($genre1 === "4") { ?>selected<?php } ?>>Électronique</option>
            <option value="5" <?php if ($genre1 === "5") { ?>selected<?php } ?>>Folk</option>
            <option value="6" <?php if ($genre1 === "6") { ?>selected<?php } ?>>Rap</option>
            <option value="7" <?php if ($genre1 === "7") { ?>selected<?php } ?>>HipHop</option>
            <option value="8" <?php if ($genre1 === "8") { ?>selected<?php } ?>>Slam</option>
            <option value="9" <?php if ($genre1 === "9") { ?>selected<?php } ?>>Reggae</option>
            <option value="10" <?php if ($genre1 === "10") { ?>selected<?php } ?>>Clubbing</option>
            <option value="11" <?php if ($genre1 === "11") { ?>selected<?php } ?>>RnB</option>
            <option value="12" <?php if ($genre1 === "12") { ?>selected<?php } ?>>Soul</option>
            <option value="13" <?php if ($genre1 === "13") { ?>selected<?php } ?>>Funk</option>
            <option value="14" <?php if ($genre1 === "14") { ?>selected<?php } ?>>Jazz</option>
            <option value="15" <?php if ($genre1 === "15") { ?>selected<?php } ?>>Blues</option>
            <option value="16" <?php if ($genre1 === "16") { ?>selected<?php } ?>>Country</option>
            <option value="17" <?php if ($genre1 === "17") { ?>selected<?php } ?>>Gospel</option>
            <option value="18" <?php if ($genre1 === "18") { ?>selected<?php } ?>>Musique du Monde</option>
            <option value="19" <?php if ($genre1 === "19") { ?>selected<?php } ?>>Classique</option>
            <option value="20" <?php if ($genre1 === "20") { ?>selected<?php } ?>>Opéra</option>
            <option value="21" <?php if ($genre1 === "21") { ?>selected<?php } ?>>Autres</option>
            <option value="22" <?php if ($genre1 === "22") { ?>selected<?php } ?>>Drame</option>
            <option value="23" <?php if ($genre1 === "23") { ?>selected<?php } ?>>Comédie</option>
            <option value="24" <?php if ($genre1 === "24") { ?>selected<?php } ?>>Contemporain</option>
            <option value="25" <?php if ($genre1 === "25") { ?>selected<?php } ?>>Monologue</option>
            <option value="26" <?php if ($genre1 === "26") { ?>selected<?php } ?>>One Man / Woman Show</option>
            <option value="27" <?php if ($genre1 === "27") { ?>selected<?php } ?>>Café-Théâtre</option>
            <option value="28" <?php if ($genre1 === "28") { ?>selected<?php } ?>>Stand Up</option>
            <option value="29" <?php if ($genre1 === "29") { ?>selected<?php } ?>>Autres</option>
            <option value="30" <?php if ($genre1 === "30") { ?>selected<?php } ?>>Contemporain</option>
            <option value="31" <?php if ($genre1 === "31") { ?>selected<?php } ?>>Classique</option>
            <option value="32" <?php if ($genre1 === "32") { ?>selected<?php } ?>>Urbain</option>

            </select>
        </div>
        <div class="form-group">
            <label for="genre2">2éme Genre du spectacle :</label>
            <select class="my-2 form-select w-50" name="genre2" id="genre2">
            <option value="1" <?php if ($genre2 === "1") { ?>selected<?php } ?>>Variété Française</option>
            <option value="2" <?php if ($genre2 === "2") { ?>selected<?php } ?>>Variété Internationale</option>
            <option value="3" <?php if ($genre2 === "3") { ?>selected<?php } ?>>Pop/Rock</option>
            <option value="4" <?php if ($genre2 === "4") { ?>selected<?php } ?>>Électronique</option>
            <option value="5" <?php if ($genre2 === "5") { ?>selected<?php } ?>>Folk</option>
            <option value="6" <?php if ($genre2 === "6") { ?>selected<?php } ?>>Rap</option>
            <option value="7" <?php if ($genre2 === "7") { ?>selected<?php } ?>>HipHop</option>
            <option value="8" <?php if ($genre2 === "8") { ?>selected<?php } ?>>Slam</option>
            <option value="9" <?php if ($genre2 === "9") { ?>selected<?php } ?>>Reggae</option>
            <option value="10" <?php if ($genre2 === "10") { ?>selected<?php } ?>>Clubbing</option>
            <option value="11" <?php if ($genre2 === "11") { ?>selected<?php } ?>>RnB</option>
            <option value="12" <?php if ($genre2 === "12") { ?>selected<?php } ?>>Soul</option>
            <option value="13" <?php if ($genre2 === "13") { ?>selected<?php } ?>>Funk</option>
            <option value="14" <?php if ($genre2 === "14") { ?>selected<?php } ?>>Jazz</option>
            <option value="15" <?php if ($genre2 === "15") { ?>selected<?php } ?>>Blues</option>
            <option value="16" <?php if ($genre2 === "16") { ?>selected<?php } ?>>Country</option>
            <option value="17" <?php if ($genre2 === "17") { ?>selected<?php } ?>>Gospel</option>
            <option value="18" <?php if ($genre2 === "18") { ?>selected<?php } ?>>Musique du Monde</option>
            <option value="19" <?php if ($genre2 === "19") { ?>selected<?php } ?>>Classique</option>
            <option value="20" <?php if ($genre2 === "20") { ?>selected<?php } ?>>Opéra</option>
            <option value="21" <?php if ($genre2 === "21") { ?>selected<?php } ?>>Autres</option>
            <option value="22" <?php if ($genre2 === "22") { ?>selected<?php } ?>>Drame</option>
            <option value="23" <?php if ($genre2 === "23") { ?>selected<?php } ?>>Comédie</option>
            <option value="24" <?php if ($genre2 === "24") { ?>selected<?php } ?>>Contemporain</option>
            <option value="25" <?php if ($genre2 === "25") { ?>selected<?php } ?>>Monologue</option>
            <option value="26" <?php if ($genre2 === "26") { ?>selected<?php } ?>>One Man / Woman Show</option>
            <option value="27" <?php if ($genre2 === "27") { ?>selected<?php } ?>>Café-Théâtre</option>
            <option value="28" <?php if ($genre2 === "28") { ?>selected<?php } ?>>Stand Up</option>
            <option value="29" <?php if ($genre2 === "29") { ?>selected<?php } ?>>Autres</option>
            <option value="30" <?php if ($genre2 === "30") { ?>selected<?php } ?>>Contemporain</option>
            <option value="31" <?php if ($genre2 === "31") { ?>selected<?php } ?>>Classique</option>
            <option value="32" <?php if ($genre2 === "32") { ?>selected<?php } ?>>Urbain</option>

            </select>
        </div>
        <div class="form-group">
            <label for="duree">Durée (minutes)</label>
            <input type="number" id="duree" name="duree" value="<?= $total_minutes ?>" required>
        </div>
        <div class="form-group">
            <label for="heureDebut">Heure de Début</label>
            <input type="time" id="heureDebut" name="heureDebut" value="<?= $heureDebut ?>" required>
        </div>
        <input type="hidden" name="id" value="<?= $id ?>">
        <button name="submit" type="submit">Ajouter le Spectacle</button>
    </form>
</div>
<?php
include('./footer.php');
?>

