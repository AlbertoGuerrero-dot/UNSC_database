<?php
  session_start();

  if(isset($_SESSION['user_id'])) {
    header('Location: /UNSC_database/home.php');
  }
  require 'database.php';

  if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
    $records = $conn->prepare('SELECT user_id, user_name, user_password FROM users WHERE user_name = :user_name');
    $records->bindParam(':user_name', $_POST['user_name']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';
    
      if (count($results) > 0 && ($_POST['user_password'] == $results['user_password'])) {
        $_SESSION['user_id'] = $results['user_id'];
        header("Location: /UNSC_database/home.php");
      } 
      else {
        $message = 'La credenciales no coinciden';
      } 
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <script src="https://kit.fontawesome.com/2385ce6cbc.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>UNSC Base de datos</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="icon" href="assets/imgs/unsc_logo.ico">
  </head>
  <body>
      <header>
      <a href="/UNSC_database/">Home</a>
      </header>

        <img src ="assets/imgs/unsc_logo.png" width = "150">
        <h3>Iniciar</h3>

        <?php if(!empty($message)): ?>
          <p><?= $message ?></p>
        <?php endif;?>

        <form action= "login.php" method="POST">
          <input type="text" name = "user_name" placeholder="Usuario">
          <input type="password" name = "user_password" placeholder="Contraseña">
          <input type="submit" value="Enviar">
        </form>

  </body>
</html>