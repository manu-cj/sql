<?php
include('./header.php');
include('./engine.php');

if (isset($_POST['submit'])) {
    $lastname = htmlspecialchars($_POST['nom']);
    $firstname = htmlspecialchars($_POST['prenom']);
    $bithDate = $_POST['dateNaissance'];
    $fidelityCard = htmlspecialchars($_POST['carteFidelite']);
    $numberCard = htmlspecialchars($_POST['numeroCarte']);
    $cardTypesId = htmlspecialchars($_POST['typeCarte']);

    if ($fidelityCard === 0) {
        $numberCard = null;
        $fidelityCard = 0;
    } else {
        $fidelityCard = 1;
    }

     try {
         // Requête SQL pour insérer un nouveau client
         $sql = 'INSERT INTO clients (lastName, firstName, birthDate, card, cardNumber) VALUES (?, ?, ?, ?, ?)';
         
         $insert = $pdo->prepare($sql);
     
         // Exécution de la requête
         $insert->execute([$lastname, $firstname, $_POST['dateNaissance'], $fidelityCard, $numberCard]);

         if ($fidelityCard === 1) {
            $sql = 'INSERT INTO cards (cardNumber, cardTypesId) VALUES (?, ?)';

            $insertCart = $pdo->prepare($sql);

            $insertCart->execute(([$numberCard, $cardTypesId]));
         }
         

         echo "Client ajouté avec succès.";
     } catch (PDOException $e) {
         echo "Erreur : " . $e->getMessage();
     }
}
?>
<div class="container">
    <h2>Ajouter un Client</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="dateNaissance">Date de Naissance</label>
            <input type="date" id="dateNaissance" name="dateNaissance" required>
        </div>
        <div class="form-group">
            <input type="checkbox" id="carteFidelite" name="carteFidelite">
            <label for="carteFidelite" class="checkbox-label">Carte de Fidélité</label>
        </div>
        <div class="form-group fid-number" id="fidNumber">
            <label for="numeroCarte">Numéro de Carte de Fidélité</label>
            <input type="number" id="numeroCarte" name="numeroCarte" min="1000" max="9999">
        </div>
        <div class="form-group fid-number" id="cardType">
            <label for="typeCarte">Type de Carte</label>
            <select id="typeCarte" name="typeCarte">
                <option value="1">Fidelité</option>
                <option value="2">Famille nombreuse</option>
                <option value="3">Etudiant</option>
                <option value="4">Employé</option>
            </select>
        </div>
        <button name="submit" type="submit">Ajouter le Client</button>
    </form>
</div>

<?php
include('./footer.php');
?>

