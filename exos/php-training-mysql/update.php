<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>

	<?php 

	session_start();
	include('./header.php');
	include('./engine.php'); // Assurez-vous que ce fichier inclut la configuration de $pdo
	
	if(isset($_POST['button'])) {
		// Assurez-vous que les valeurs POST existent avant de les utiliser
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$name = isset($_POST['name']) ? htmlentities($_POST['name']) : '';
		$difficulty = isset($_POST['difficulty']) ? htmlspecialchars($_POST['difficulty'], ENT_QUOTES, 'UTF-8') : '';
		$distance = isset($_POST['distance']) ? htmlentities($_POST['distance']) : '';
		$duration = isset($_POST['duration']) ? htmlentities($_POST['duration']) : '';
		$height_difference = isset($_POST['height_difference']) ? htmlentities($_POST['height_difference']) : '';
		$errors = [];
	
		// Validation des données
		if (empty($name)) {
			$errors[] = "Le nom est requis.";
		}
	
		$valid_difficulties = ['très facile', 'facile', 'moyen', 'difficile', 'très difficile'];
		if (!in_array($difficulty, $valid_difficulties)) {
			$errors[] = "La difficulté n'est pas valide.";
		}
	
		if (!is_numeric($distance) || $distance <= 0) {
			$errors[] = "La distance doit être un nombre positif.";
		}
	
		if (!preg_match('/^\d{2}:\d{2}$/', $duration)) {
			$errors[] = "La durée doit être au format HH:MM.";
		} else {
			list($hours, $minutes) = explode(':', $duration);
			if ($hours < 0 || $hours > 23 || $minutes < 0 || $minutes > 59) {
				$errors[] = "Les heures doivent être entre 00 et 23 et les minutes entre 00 et 59.";
			}
		}
	
		if (!is_numeric($height_difference) || $height_difference < 0) {
			$errors[] = "La différence de hauteur doit être un nombre positif ou nul.";
		}
	
		if (empty($errors)) {
			// Effectuer la mise à jour dans la base de données
			$difficulty = htmlspecialchars($difficulty, ENT_QUOTES, 'UTF-8'); // Sécurisation supplémentaire
			$sql = 'UPDATE hiking 
					SET name=:name, difficulty=:difficulty, distance=:distance, duration=:duration, height_difference=:height_difference 
					WHERE id=:id';
			$update = $pdo->prepare($sql);
	
			$update->execute([
				':name' => $name,
				':difficulty' => $difficulty,
				':distance' => $distance,
				':duration' => $duration,
				':height_difference' => $height_difference,
				':id' => $id
			]);
	
			// Redirection vers la page de lecture après la mise à jour
			header('LOCATION: ./read.php');
			exit;
		} else {
			// En cas d'erreurs, stocker les erreurs dans la session et rediriger vers la page de mise à jour
			$_SESSION['error'] = $errors;
			header('LOCATION: ./update.php');
			exit;
		}
	}
	
	// Si des erreurs sont présentes dans la session, les afficher
	if (isset($_SESSION['error'])) {
		$errors = $_SESSION['error'];
		foreach ($errors as $error) {
			echo $error . '<br>';
		}
		unset($_SESSION['error']); // Nettoyer les erreurs après affichage
	}
	?>
	
	

	
	?>
	<h1>Update</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?= $_POST['name']; ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile" <?php if ($_POST['difficulty'] === "très facile") {
					?>selected<?php
				} ?>>Très facile</option>
				<option value="facile" <?php if ($_POST['difficulty'] === "facile") {
					?>selected
					<?php } ?> >Facile</option>
				<option value="moyen" <?php if ($_POST['difficulty'] === "moyen") {
					?>selected
					<?php } ?>>Moyen</option>
				<option value="difficile" <?php if ($_POST['difficulty'] === "difficile") {
					?>selected
					<?php } ?>>Difficile</option>
				<option value="très difficile" <?php if ($_POST['difficulty'] === "très difficile") {
					?>selected
					<?php } ?>>Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?= $_POST['distance']; ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?= $_POST['duration']; ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?= $_POST['height_difference']; ?>">
		</div>
		<input type="hidden" name="id" value="<?= $_POST['id']; ?>">
		<button type="submit" name="button">Envoyer</button>
	</form>
	
</body>
</html>
