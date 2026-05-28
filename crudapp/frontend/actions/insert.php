<?php
session_start();
require "../config/db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$status = $_POST['status'];
$hobbies = $_POST['hobbies'];
$gender = $_POST['gender'];
// FILE
$image = $_FILES['image'];



// Image validation
$allowedTypes = ['image/jpeg','image/png','image/jpg'];
if(!in_array($image['type'], $allowedTypes)){
    die("Only JPG, JPEG, PNG allowed");
}

// Unique filename
$filename = time() . "_" . basename($image['name']);
$targetPath = "../uploads/" . $filename;

// Move file
if(!move_uploaded_file($image['tmp_name'], $targetPath)){
    die("Image upload failed");
}


$stmt = $pdo->prepare("INSERT INTO employees(name,email,status,image,hobbies,gender) VALUES(?,?,?,?,?,?)");
$stmt->execute([$name,$email,$status,$filename,json_encode($hobbies),$gender]);

header("Location: ../index.php");
?>