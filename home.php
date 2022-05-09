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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <title>Home</title>
</head>
<body>

    <?php require 'partials/header.php'?>
    
    <?php if(!empty($user)): ?>
        <h1>Hola, bienvenido</h1>
    <?php endif; ?>

    <a class = "log" href="add.php">Agregar </a>
    <a class = "log" href="logout.php">Logout</a>

    <div>
        <table>
            <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Grado</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $result = $mysqli->query("SELECT * FROM students_prueba");
                while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['student_id'] ?></td>
                        <td><?php echo $row['student_first_name'] ?></td>
                        <td><?php echo $row['student_last_name'] ?></td>
                        <td><?php echo $row['student_degree'] ?></td>
                        <td>
                            <a href="edit.php?student_id=<?php echo $row['student_id']?>">editar</a>
                            <a href="delete.php?student_id=<?php echo $row['student_id']?>">eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>