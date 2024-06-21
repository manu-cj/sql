<?php
include('./header.php');
include('./engine.php');

if (isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $bithDate = $_POST['birthDate'];
    $fidelityCard = htmlspecialchars($_POST['card']);
    $numberCard = htmlspecialchars($_POST['numberCard']);
    $_SESSION['cardNumber'] = $numberCard;
    
}
if (isset($_POST['submit'])) {
    $id = htmlspecialchars($_POST['id']);
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

         $sql = 'UPDATE clients 
         SET lastName=:lastName, firstName=:firstName, birthDate=:birthDate, card=:card, cardNumber=:cardNumber 
         WHERE id=:id';

         $update = $pdo->prepare($sql);
         
        $update->execute([
            ':lastName' => $lastname,
            ':firstName' => $firstname,
            ':birthDate' => $_POST['dateNaissance'],
            ':card' => $fidelityCard,
            ':cardNumber' => $numberCard,
            ':id' => $id
        ]);

         if ($fidelityCard === 0) {
            $sql = 'DELETE FROM cards WHERE cardNumber=:cardNumber';

            $deleteCard = $pdo->prepare($sql);

            $deleteCard->execute(([':cardNumber' => $numberCard]));
         } else {
            $sql = 'UPDATE  cards 
            SET cardNumber=:cardNumber 
            WHERE cardNumber=:cardNumber';
   
            $update = $pdo->prepare($sql);
   
           $update->execute([
               ':cardNumber' => $_SESSION['cardNumber']
           ]);
         }
         

         echo "Client mis à jour avec succès.";
     } catch (PDOException $e) {
         echo "Erreur : " . $e->getMessage();
     }
}

if (isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);
    try {
 
   
    $sql = 'DELETE FROM clients WHERE id = :id';
    $deleteClient = $pdo->prepare($sql);
    $deleteClient->execute([':id' => $id]);

    $sql = 'SELECT * FROM bookings WHERE clientId = :clientId';
    $selectBooking = $pdo->prepare($sql);
    $selectBooking->execute([':clientId' => $id]);

    $bookings = $selectBooking->fetchAll(PDO::FETCH_ASSOC);

    foreach ($bookings as $booking) {
        $bookingId = $booking['id'];
        
        $sql = 'DELETE FROM tickets WHERE id = :id';
        $deleteTicket = $pdo->prepare($sql);
        $deleteTicket->execute([':id' => $bookingId]);

        $sql = 'DELETE FROM bookings WHERE clientId = :clientId';
        $deleteBooking = $pdo->prepare($sql);
        $deleteBooking->execute([':clientId' => $id]);
    }




       
        

        echo "Client mis à jour avec succès.";
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
            <input type="text" id="nom" name="nom" value="<?= $lastname ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?= $firstname ?>" required>
        </div>
        <div class="form-group">
            <label for="dateNaissance">Date de Naissance</label>
            <input type="date" id="dateNaissance" name="dateNaissance" value="<?= $bithDate ?>" required>
        </div>
        <div class="form-group">
        <input type="checkbox" id="carteFidelite" name="carteFidelite" <?php if ($fidelityCard === "yes") {?> checked <?php } ?>>
            <label for="carteFidelite" class="checkbox-label">Carte de Fidélité</label>
        </div>
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-group fid-number" id="fidNumber">
            <label for="numeroCarte">Numéro de Carte de Fidélité</label>
            <input type="number" id="numeroCarte" name="numeroCarte" min="1000" max="9999" value="<?= $numberCard ?>">
        </div>
        <button name="submit" type="submit">Modifier le Client</button>
        <button name="delete" style="background: tomato;" type="submit">Supprimer le Client</button>
    </form>
</div>

<?php
include('./footer.php');
?>

