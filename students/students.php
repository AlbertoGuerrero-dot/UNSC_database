<?php
    require '../database.php';
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
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="icon" href="../assets/imgs/unsc_logo.ico">
    <img class="home_logo" src ="../assets/imgs/unsc_logo.png">  
    <title>Home</title>
</head>
<body>

    <?php require '../partials/header.php'?>
    
    <?php if(!empty($user)): ?>
        <h1>Hola, bienvenido</h1>
        <?php endif; ?>
        
    
    
    

    <form action="search.php" method="GET" class="search">
        <input type="search" name="search" placeholder="Buscar"></input>
        <input type="submit" value="Buscar"></input>
        <a class = "log" href="add.php"><input type="button" value="Agregar" href="add.php"></input> </a>
        <a class = "log" href="../logout.php"><input type="button" value="Salir" href="logout.php"></input></a>
    </form>
    <div>
        <table class="student_table">
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
                $student_result = $mysqli->query("SELECT * FROM students_prueba");
                while($row = mysqli_fetch_array($student_result)) { ?>
                    <tr>
                        <td><?php echo $row['student_id'] ?></td>
                        <td><?php echo $row['student_first_name'] ?></td>
                        <td><?php echo $row['student_last_name'] ?></td>
                        <td><?php echo $row['student_degree'] ?></td>
                        <td>
                            <a href="edit.php?student_id=<?php echo $row['student_id']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete.php?student_id=<?php echo $row['student_id']?>"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>