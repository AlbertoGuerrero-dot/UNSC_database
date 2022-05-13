<?php 
    require '../database.php';
    $mysqli = new mysqli("localhost", "root", "", "unsc_database");

    if(isset($_GET['student_id'])) {
        $student_id = $_GET['student_id']; 
        $result = $mysqli->query("SELECT * FROM students_prueba WHERE student_id = $student_id");

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $first_name = $row['student_first_name'];
            $last_name = $row['student_last_name'];
            $degree = $row['student_degree'];

        }

    }

    if(isset($_POST['update'])) {
        $query = "UPDATE students_prueba SET student_first_name = :first_name, student_last_name = :last_name, student_degree = :degree WHERE student_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $_GET['student_id']);
        $stmt->bindParam(':first_name', $_POST['student_first_name']); //variable vinculada con un parametro
        $stmt->bindParam(':last_name', $_POST['student_last_name']);
        $stmt->bindParam( ':degree', $_POST['student_degree']);

        if ($stmt->execute()) {
            header("Location: /UNSC_database/students/students.php");
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
        <form action= "edit.php?student_id=<?php echo $_GET['student_id']?>" method="POST">
        <input type="text" name = "student_first_name" placeholder="Nombre" value="<?php echo $first_name; ?>">
        <input type="text" name = "student_last_name" placeholder="Apellido" value="<?php echo $last_name; ?>">
        <input type="number" name = "student_degree" placeholder="Grado" value="<?php echo $degree; ?>">
        <input type="submit" name= "update" value="Actualizar">
        </form>
</body>
</html>