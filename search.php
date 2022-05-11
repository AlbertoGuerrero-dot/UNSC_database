<?php
    require 'database.php';
    session_start();

    $mysqli = new mysqli("localhost", "root", "", "unsc_database");
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
    
    <?php 
    
    $search = strtolower($_REQUEST['search']);
    if(empty($search)) {
        header("Location: /UNSC_database/home.php");
    } 

    ?>


    <a class = "log" href="add.php">Agregar </a>
    <a class = "log" href="logout.php">Logout</a>

    <form action="search.php" method="GET">
        <input type="search" name="search" placeholder="Buscar" value="<?php echo $search; ?>"></input>
        <input type="submit" value="Buscar"></input>
    </form>
    
    
    
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
                $result = $mysqli->query("SELECT * FROM students_prueba WHERE student_id LIKE '%$search%' OR student_first_name LIKE '%$search%' OR student_last_name LIKE '%$search%' OR student_degree LIKE '%$search%'");
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