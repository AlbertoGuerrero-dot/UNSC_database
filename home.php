<?php
    require 'database.php';
    session_start();

    $mysqli = new mysqli("localhost", "root", "", "unsc_database");

    
    

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT user_id, user_name, user_password FROM users WHERE user_id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute(); 
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;
        if(count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/2385ce6cbc.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="icon" href="assets/imgs/unsc_logo.ico">
    <img class="home_logo" src ="assets/imgs/unsc_logo.png">  
    <title>Home</title>
</head>
<body>

    <?php require 'partials/header.php'?>
    
    <?php if(!empty($user)): ?>
        <h1>Hola, bienvenido</h1>
        <?php endif; ?>
        
        <img src ="assets/imgs/unsc_logo.png" width = "200">
        <h1>Bienvenido a UNSC Database</h1>

        <a href="students/students.php">Estudientes</a>
        <a href="employees/employees.php">Docentes</a>
    
</body>
</html>