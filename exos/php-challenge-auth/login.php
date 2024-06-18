<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php
    if (!isset($_SESSION['user'])) {
      
    
    ?>
    <form action="./check_login.php" method="post">
      <div>
        <label for="username">Identifiant</label>
        <input type="text" name="username">
      </div>
      <div>
        <label for="password">Mot de passe </label>
        <input type="password" name="password">
      </div>
      <div>
        <button name="button">Se connecter</button>
      </div>
    </form>
    <div style="background-color: teal; width:300px;">
    <img src="https://play.pokemonshowdown.com/sprites/bw/venusaur.png" alt="">
    </div>
    <?php
    }
    else {
      echo 'hello ' . $_SESSION['user']['username'];
      ?>
      <form action="./logout.php" method="post">
      <div>
        <button name="button">Se déconnecter</button>
      </div>
    </form>

   
      <?php
    }
    ?>
  </body>
</html>
