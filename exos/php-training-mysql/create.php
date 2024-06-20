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
	include('./engine.php');
	if (isset($_POST['button'])) {
		$name = htmlentities($_POST['name']);

		$difficulty = htmlspecialchars($_POST['difficulty'], ENT_QUOTES, 'UTF-8');
		$distance = htmlentities($_POST['distance']);
		$duration = htmlentities($_POST['duration']);
		$height_difference = htmlentities($_POST['height_difference']);
		$errors = [];

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
			$difficulty = strip_tags($difficulty);
		$sql = 'INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (?,?,?,?,?)';
		$insert = $pdo->prepare($sql);

		$insert->execute([$name, $difficulty, $distance, $duration, $height_difference]);

		header('LOCATION: ./read.php');
		}
		else {
			$_SESSION['error'] = $errors;
			header('LOCATION: ./create.php');
		}
	}
	if (isset($_SESSION['error'])) {
		$errors = $_SESSION['error'];
		foreach ($errors as $key => $value) {
			echo $value;
		}
	}
	?>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="number" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="number" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
