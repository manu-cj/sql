<?php

use function PHPSTORM_META\type;

include('./header.php');
include('./engine.php');

if (isset($_POST['submit'])) {
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
         $sql = 'INSERT INTO shows (title, performer, date, showTypesId, firstGenresId, secondGenreId, duration, startTime) VALUES (?, ?, ?, ?, ?,?,?,?)';
         
         $insert = $pdo->prepare($sql);
     
         // Exécution de la requête
         $insert->execute([$titre, $artiste, $date, $typeSpectacle, $genre1, $genre2, $dureeEnTime, $heureDebut]);
         
         echo "Show ajouté avec succès.";
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
            <input type="text" id="titre" name="titre" required>
        </div>
        <div class="form-group">
            <label for="artiste">Artiste</label>
            <input type="text" id="artiste" name="artiste" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="typeSpectacle">Type de Spectacle</label>
            <select id="typeSpectacle" name="typeSpectacle" required>
                <option value="1">Concert</option>
                <option value="2">Théâtre</option>
                <option value="3">Danse</option>
                <option value="4">Comédie</option>
                
            </select>
        </div>
        <div class="form-group">
            <label for="genre1">Genre du spectacle :</label>
            <select class="my-2 form-select w-50" name="genre1" id="genre1">
                <option value="" selected>Sélectionnez une option</option>
                <option value="1">Variété Française</option>
                <option value="2">Variété Internationale</option>
                <option value="3">Pop/Rock</option>
                <option value="4">Électronique</option>
                <option value="5">Folk</option>
                <option value="6">Rap</option>
                <option value="7">HipHop</option>
                <option value="8">Slam</option>
                <option value="9">Reggae</option>
                <option value="10">Clubbing</option>
                <option value="11">RnB</option>
                <option value="12">Soul</option>
                <option value="13">Funk</option>
                <option value="14">Jazz</option>
                <option value="15">Blues</option>
                <option value="16">Country</option>
                <option value="17">Gospel</option>
                <option value="18">Musique du Monde</option>
                <option value="19">Classique</option>
                <option value="20">Opéra</option>
                <option value="21">Autres</option>
                <option value="22">Drame</option>
                <option value="23">Comédie</option>
                <option value="24">Contemporain</option>
                <option value="25">Monologue</option>
                <option value="26">One Man / Woman Show</option>
                <option value="27">Café-Théâtre</option>
                <option value="28">Stand Up</option>
                <option value="29">Autres</option>
                <option value="30">Contemporain</option>
                <option value="31">Classique</option>
                <option value="32">Urbain</option>
            </select>
        </div>
        <div class="form-group">
            <label for="genre2">2éme Genre du spectacle :</label>
            <select class="my-2 form-select w-50" name="genre2" id="genre2">
                <option value="" selected>Sélectionnez une option</option>
                <option value="1">Variété Française</option>
                <option value="2">Variété Internationale</option>
                <option value="3">Pop/Rock</option>
                <option value="4">Électronique</option>
                <option value="5">Folk</option>
                <option value="6">Rap</option>
                <option value="7">HipHop</option>
                <option value="8">Slam</option>
                <option value="9">Reggae</option>
                <option value="10">Clubbing</option>
                <option value="11">RnB</option>
                <option value="12">Soul</option>
                <option value="13">Funk</option>
                <option value="14">Jazz</option>
                <option value="15">Blues</option>
                <option value="16">Country</option>
                <option value="17">Gospel</option>
                <option value="18">Musique du Monde</option>
                <option value="19">Classique</option>
                <option value="20">Opéra</option>
                <option value="21">Autres</option>
                <option value="22">Drame</option>
                <option value="23">Comédie</option>
                <option value="24">Contemporain</option>
                <option value="25">Monologue</option>
                <option value="26">One Man / Woman Show</option>
                <option value="27">Café-Théâtre</option>
                <option value="28">Stand Up</option>
                <option value="29">Autres</option>
                <option value="30">Contemporain</option>
                <option value="31">Classique</option>
                <option value="32">Urbain</option>
            </select>
        </div>
        <div class="form-group">
            <label for="duree">Durée (minutes)</label>
            <input type="number" id="duree" name="duree" required>
        </div>
        <div class="form-group">
            <label for="heureDebut">Heure de Début</label>
            <input type="time" id="heureDebut" name="heureDebut" required>
        </div>
        <button name="submit" type="submit">Ajouter le Spectacle</button>
    </form>
</div>
<?php
include('./footer.php');
?>

