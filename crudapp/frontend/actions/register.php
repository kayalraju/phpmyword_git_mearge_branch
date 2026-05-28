<?php
session_start();
require "../config/db.php";

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';

//  Validation
if(empty($name) || empty($email) || empty($password)){
    $_SESSION['error'] = "All fields are required";
    header("Location: ../register.php");
    exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION['error'] = "Invalid email";
    header("Location: ../register.php");
    exit;
}

// Check duplicate email
$stmt = $pdo->prepare("SELECT id FROM users WHERE email=?");
$stmt->execute([$email]);

if($stmt->fetch()){
    $_SESSION['error'] = "Email already exists";
    header("Location: ../register.php");
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("
        INSERT INTO users(name,email,phone,password) 
        VALUES(?,?,?,?)
    ");

    $stmt->execute([$name,$email,$phone,$hashedPassword]);

    $_SESSION['success'] = "Registration successful. Please login.";
    header("Location: ../login.php");
    exit;

} catch(PDOException $e){
    error_log($e->getMessage());
    $_SESSION['error'] = "Something went wrong";
    header("Location: ../register.php");
    exit;
}