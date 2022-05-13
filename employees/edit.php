<?php 
    require '../database.php';
    $mysqli = new mysqli("localhost", "root", "", "unsc_database");

    if(isset($_GET['employee_id'])) {
        $employee_id = $_GET['employee_id']; 
        $result = $mysqli->query("SELECT * FROM employees_prueba WHERE employee_id = $employee_id");

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $first_name = $row['employee_first_name'];
            $last_name = $row['employee_last_name'];
            $salary = $row['salary'];

        }

    }

    if(isset($_POST['update'])) {
        $query = "UPDATE employees_prueba SET employee_first_name = :first_name, employee_last_name = :last_name, salary = :salary WHERE employee_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $_GET['employee_id']);
        $stmt->bindParam(':first_name', $_POST['employee_first_name']); //variable vinculada con un parametro
        $stmt->bindParam(':last_name', $_POST['employee_last_name']);
        $stmt->bindParam( ':salary', $_POST['salary']);

        if ($stmt->execute()) {
            header("Location: /UNSC_database/employees/employees.php");
        } else {
            $message = 'Ha ocurrido un error'; 
        }


    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="icon" href="../assets/imgs/unsc_logo.ico">
    <title>Editar</title>
</head>
<body>  
        <?php require '../partials/header.php'?>

        <h1>Editar</h1>
        <form action= "edit.php?employee_id=<?php echo $_GET['employee_id']?>" method="POST">
        <input type="text" name = "employee_first_name" placeholder="Nombre" value="<?php echo $first_name; ?>">
        <input type="text" name = "employee_last_name" placeholder="Apellido" value="<?php echo $last_name; ?>">
        <input type="number" name = "salary" placeholder="Salario" value="<?php echo $salary; ?>">
        <input type="submit" name= "update" value="Actualizar">
        </form>
</body>
</html>