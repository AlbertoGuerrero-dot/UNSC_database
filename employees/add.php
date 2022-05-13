
<?php

require '../database.php';

$message = '';

if (!empty($_POST['employee_first_name']) && !empty($_POST['employee_last_name']) && !empty($_POST['salary'])) { //En el post va el atributo del form
    $sql = "INSERT INTO employees_prueba (employee_first_name, employee_last_name, salary) VALUES (:first_name, :last_name, :salary)"; //Nombres de variables para pasarle los datos
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $_POST['employee_first_name']); //variable vinculada con un parametro
    $stmt->bindParam(':last_name', $_POST['employee_last_name']);
    $stmt->bindParam( ':salary', $_POST['salary']);

    if ($stmt->execute()) {
        $message = 'Se ha añadido un profesor';
    } else {
        $message = 'Ha ocurrido un error'; 
    }
} 


?>

<!DOCTYPE html>
<html>
<head>
<script src="https://kit.fontawesome.com/2385ce6cbc.js" crossorigin="anonymous"></script>
<meta charset="utf-8">
<title>UNSC Base de datos</title>
<link rel="stylesheet" href="../assets/styles/styles.css">
<link rel="icon" href="../assets/imgs/unsc_logo.ico">
</head>
<body>
    <?php require '../partials/header.php'?>

    <?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
    <?php endif; ?>
    
    <h1>Agregar</h1>

    <form action= "add.php" method="POST">
    <input type="text" name = "employee_first_name" placeholder="Nombre">
    <input type="text" name = "employee_last_name" placeholder="Apellido">
    <input type="number" name = "salary" placeholder="Salario">
    <input type="submit" name= "" value="Enviar">
    </form>

</body>
</html>