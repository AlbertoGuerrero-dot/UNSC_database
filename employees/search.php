<?php
    require '../database.php';
    session_start();

    $mysqli = new mysqli("localhost", "root", "", "unsc_database");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/2385ce6cbc.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="icon" href="../assets/imgs/unsc_logo.ico">
    <title>Home</title>
</head>
<body>

    <?php require '../partials/header.php'?>
    
    <?php 
    
    $search = strtolower($_REQUEST['search']);
    if(empty($search)) {
        header("Location: /UNSC_database/employees/employees.php");
    } 

    ?>


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
                <th>Salario</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $employee_result = $mysqli->query("SELECT * FROM employees_prueba WHERE employee_id LIKE '%$search%' OR employee_first_name LIKE '%$search%' OR employee_last_name LIKE '%$search%' OR salary LIKE '%$search%'");
                while($row = mysqli_fetch_array($employee_result)) { ?>
                    <tr>
                        <td><?php echo $row['employee_id'] ?></td>
                        <td><?php echo $row['employee_first_name'] ?></td>
                        <td><?php echo $row['employee_last_name'] ?></td>
                        <td> $ <?php echo $row['salary'] ?></td>
                        <td>
                        <a href="edit.php?employee_id=<?php echo $row['employee_id']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete.php?employee_id=<?php echo $row['employee_id']?>"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>