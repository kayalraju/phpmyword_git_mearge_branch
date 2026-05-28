<?php
include_once "db.php";

if(isset($_POST['student'])){
     $name = $_POST['name'];
     $email = $_POST['email'];

     $stmt = $pdo->prepare("INSERT INTO students(name,email) VALUES(?,?)");
    $stmt->execute([$name,$email]);

header("Location: course.php");
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4 w-80">
    <h3>Add student</h3>
    <form action="" method="POST">
        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <button type="submit" name="student" class="btn btn-success">Save</button>
    </form>
</div>
</body>
</html>